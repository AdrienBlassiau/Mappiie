<?php  
/**
 * @file map2.php
 * 
 * Ce fichier contient l'affichage de la carte du deuxième étage de l'école avec surbrillance des salles non accessibles                                                       
 * 
 */
?>

<div id='div2'>
    <center> 
        <img id='ima2' class='map' src='image/etage2.svg' width='1488' height='1417' usemap='#map2'/>
    </center>
    <script type="text/javascript">
        var img = document.getElementById('ima2');
        canvas2.height = img.height;
        canvas2.width = img.width;
        canvas2.style.left = img.offsetLeft+"px";
        canvas2.style.top = img.offsetTop+"px";
    </script>

    <script src="script/mapinteractive.js"></script>


    <map name="map2">
        <?
        $tab_coords_2=["201"=>"212,63,106,64,106,199,212,202","237"=>"56,262,152,262,156,350,56,351","236"=>"151,263,230,262,230,350,156,350","248"=>"124,387,176,386,177,495,187,496,188,517,124,516","233"=>"177,433,293,432,294,495,177,496","227"=>"329,326,392,263,447,263,446,333,400,378,329,378","225"=>"446,263,538,263,538,407,510,379,492,379,447,333","228"=>"329,471,389,471,403,485,445,443,446,425,400,379,330,379","221"=>"612,500,545,433,489,488,555,555","222"=>"489,489,436,541,503,609,556,556","223"=>"435,542,503,609,450,661,415,627,414,562","235"=>"230,262,294,262,293,350,230,350","253"=>"443,669,541,768,499,811,449,811,450,822,467,821,468,840,478,850,446,882,500,933,605,829,559,782,559,758,457,656","251"=>"383,811,393,811,393,799,410,784,432,804,432,885,400,917,383,917","266"=>"128,968,127,976,169,1019,223,967,230,967,185,922,139,967","258"=>"326,907,326,928,353,956,378,956,385,949,376,939,389,924,389,917,383,917,382,907","269"=>"149,1094,194,1052,215,1073,229,1074,283,1127,283,1133,234,1182,226,1176,226,1171"];
        foreach ($tab_coords_2 as $key => $value) /*Affiche toutes les zones cliquables de la carte*/
        {
            
            if ($test == 0 && $_SESSION['statut'] != "Administrateur")
            {
                $ret = est_presente($key,$date,$place);/*Si la salle ne vérifie pas les critères entrés par l'utilisateur ou est déjà reservée*/
                if ($ret > 0)
                {
                    echo "<script type='text/javascript'>tracage2(\"{$value}\",'ima2');</script>" ; 
                }
                else
                {
                    echo "<area shape=\"poly\" coords=\"{$value}\" onclick=\"myFunction({$key})\" href=\"#\" onmouseover=\"tracage('{$value}','ima2')\" onmouseout=\"effacage()\"/>";
                } 
            }
            else
            {
                echo "<area shape=\"poly\" coords=\"{$value}\" onclick=\"myFunction({$key})\" href=\"#\" onmouseover=\"tracage('{$value}','ima2')\" onmouseout=\"effacage()\"/>";
            }           
            
        }
        ?>

    </map>
</div>