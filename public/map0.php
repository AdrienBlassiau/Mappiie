<?php  
/**
 * @file map0.php
 * 
 * Ce fichier contient l'affichage de la carte du Rez-de-chaussée de l'école avec surbrillance des salles non accessibles
 * 
 */
?>

<div id='div1'>
    <center>
        <img id='ima0' class='map' src='image/etage0.svg' width='1052' height='744' usemap='#map1'/>
    </center>

    <script type="text/javascript">
        var img = document.getElementById('ima0');
        canvas2.height = img.height;
        canvas2.width = img.width;
        canvas2.style.left = img.offsetLeft+"px";
        canvas2.style.top = img.offsetTop+"px";
    </script>
    <script src="script/mapinteractive.js"></script>

    <map name="map1">

        <?
        $tab_coords_0=["31"=>"90,99,195,99,195,162,103,162,103,113,90,113","32"=>"247,99,266,99,265,112,298,114,299,161,246,162","30"=>"104,296,155,297,156,345,90,345,91,331,103,331","26"=>"213,296,155,296,156,346,214,345,214,338","29"=>"213,296,246,296,246,345,214,345","27"=>"246,296,305,296,305,345,246,345","25"=>"90,373,168,372,168,422,91,422","23"=>"90,499,90,466,168,466,168,499","24"=>"91,422,91,465,168,465,169,422","22"=>"78,500,169,500,169,549,84,549,84,534,77,535","17"=>"194,374,239,374,240,407,194,407","18"=>"194,444,239,443,240,408,194,408","19"=>"195,478,194,445,240,444,240,478","20"=>"195,478,240,478,241,514,194,514","21"=>"169,514,240,515,240,549,169,550","16"=>"240,374,266,374,266,428,298,429,299,548,240,549","14"=>"415,373,435,374,435,421,467,422,467,465,474,465,474,548,416,548","15"=>"298,430,415,429,416,548,299,548","2"=>"553,92,792,93,792,295,552,295,553,253,584,254,585,156,552,156"];
        foreach ($tab_coords_0 as $key => $value) /*Affiche toutes les zones cliquables de la carte*/
        {
            if ($test == 0 && $_SESSION['statut'] != "Administrateur")
            {
                $ret = est_presente($key,$date,$place);/*Si la salle ne vérifie pas les critères entrés par l'utilisateur ou est déjà reservée*/
                if ($ret > 0)
                {
                    echo "<script type='text/javascript'>tracage2(\"{$value}\",'ima0');</script>" ; 
                }
                else
                {
                    echo "<area shape=\"poly\" coords=\"{$value}\" onclick=\"myFunction({$key})\" href=\"#\" onmouseover=\"tracage('{$value}','ima0')\" onmouseout=\"effacage()\"/>";
                } 
            }
            else
            {
                echo "<area shape=\"poly\" coords=\"{$value}\" onclick=\"myFunction({$key})\" href=\"#\" onmouseover=\"tracage('{$value}','ima0')\" onmouseout=\"effacage()\"/>";
            }

        }
        ?>
    </map>
</div>