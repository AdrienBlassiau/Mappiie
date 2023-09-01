<?php  
/**
 * @file map1.php
 * 
 * Ce fichier contient l'affichage de la carte du premier étage de l'école avec surbrillance des salles non accessibles                                                          
 * 
 */
?>

<div id='div1'>
    <center>
        <img id='ima1' class='map' src='image/etage1.svg' width='1052' height='744' usemap='#map1'/>
    </center>

    <script type="text/javascript">
        var img = document.getElementById('ima1');
        canvas2.height = img.height;
        canvas2.width = img.width;
        canvas2.style.left = img.offsetLeft+"px";
        canvas2.style.top = img.offsetTop+"px";
    </script>
    <script src="script/mapinteractive.js"></script>

    <map name="map1">
        <?
        $tab_coords_1=["102" => "287,91,287,171,392,169,392,92","101"=>"287,170,287,263,393,261,393,170","139" =>"298,261,301,321,392,321,392,262","138" =>"407,283,496,284,495,336,407,336","130" =>"524,364,577,364,577,351,612,316,630,315,630,262,575,263,525,313","127" =>"630,262,630,315,669,356,701,325,701,262","131" =>"627,414,578,366,525,366,524,460,581,460","126" =>"620,407,654,441,701,397,701,357,670,357","121" =>"716,355,762,355,761,442,747,457,709,418,715,409","122" =>"648,478,708,419,747,457,687,516","123" =>"627,489,680,538,632,589,622,587,581,545,581,534","133" =>"524,496,581,496,580,587,528,587","135" =>"495,591,495,546,397,546,397,595","148" =>"396,492,396,595,375,595,348,567,346,493","149" =>"369,407,396,408,396,491,347,492,347,428","136" =>"495,407,397,407,397,453,495,453","140" =>"290,335,311,336,360,386,329,417,291,417"];
        foreach ($tab_coords_1 as $key => $value) /*Affiche toutes les zones cliquables de la carte*/
        {
            if ($test == 0 && $_SESSION['statut'] != "Administrateur")
            {
                $ret = est_presente($key,$date,$place);/*Si la salle ne vérifie pas les critères entrés par l'utilisateur ou est déjà reservée*/
                if ($ret > 0)
                {
                    echo "<script type='text/javascript'>tracage2(\"{$value}\",'ima1');</script>" ; 
                }
                else
                {
                    echo "<area shape=\"poly\" coords=\"{$value}\" onclick=\"myFunction({$key})\" href=\"#\" onmouseover=\"tracage('{$value}','ima1')\" onmouseout=\"effacage()\"/>";
                } 
            }
            else
            {
                echo "<area shape=\"poly\" coords=\"{$value}\" onclick=\"myFunction({$key})\" href=\"#\" onmouseover=\"tracage('{$value}','ima1')\" onmouseout=\"effacage()\"/>";
            }       
        }
        ?>
    </map>

</div>