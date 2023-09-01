<h1 class="h3 mb-3 font-weight-normal">Espace Reservation</h1>
<br>
<div class="text-center formulaire">
    <h1 class="h3 mb-3 font-weight-normal">Réserver une salle</h1><br>

    <form action="" method="post">
        <select name="etage" id="et" onchange="changeImage(this.value)">
            <option value="">Choisir votre Etage:</option>
            <option value="">Aucun salle</option>
            <option value="0">Rez-de-Chaussez</option>
            <option value="1">Etage 1</option>
            <option value="2">Etage 2</option>
        </select>
        <input type="submit" name="submit" value="Go"/>
    </form>



</div>

<script>
    function myFunction1(entier)
    {
        document.getElementById("salle_choisie_1").value = entier;
    }
    function myFunction2(entier)
    {
        document.getElementById("salle_choisie_2").value = entier;
    }

    function changeImage(val){

        if (val==0 || val ==1)
        {
            document.getElementById('div1').style.display='block';
            document.getElementById('div2').style.display='none';
        }
        else if (val == 2)
        {
            document.getElementById('div2').style.display='block';
            document.getElementById('div1').style.display='none';

        }

    }

</script>


<canvas id="canvas"></canvas>
<canvas id="canvas2"></canvas>

<div id='div1' style="display:none">
    <?php
    $salle_choisie = 'salle_choisie_1';
    include("formstar2.php");
    ?>


    <center>
        <img id='ima1' class='map' src='image/etage1.svg' width='1052' height='744' usemap='#map1'/>;
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
        $tab_coords_1=["101" => "287,91,287,171,392,169,392,92","287,170,287,263,393,261,393,170","139" =>"298,261,301,321,392,321,392,262","138" =>"407,283,496,284,495,336,407,336","130" =>"524,364,577,364,577,351,612,316,630,315,630,262,575,263,525,313","127" =>"630,262,630,315,669,356,701,325,701,262","131" =>"627,414,578,366,525,366,524,460,581,460","126" =>"620,407,654,441,701,397,701,357,670,357","121" =>"716,355,762,355,761,442,747,457,709,418,715,409","122" =>"648,478,708,419,747,457,687,516","123" =>"627,489,680,538,632,589,622,587,581,545,581,534","133" =>"524,496,581,496,580,587,528,587","135" =>"495,591,495,546,397,546,397,595","148" =>"396,492,396,595,375,595,348,567,346,493","149" =>"369,407,396,408,396,491,347,492,347,428","136" =>"495,407,397,407,397,453,495,453","140" =>"290,335,311,336,360,386,329,417,291,417"];
        foreach ($tab_coords_1 as $key => $value) 
        {
            echo "<area shape=\"poly\" coords=\"{$value}\" onclick=\"myFunction1({$key})\" href=\"#\" onmouseover=\"tracage('{$value}','ima1')\" onmouseout=\"effacage()\"/>";

            echo "<script type='text/javascript'>tracage2(\"{$value}\",'ima1');</script>" ;        
        }
        ?>
    </map>

</div>


<div id='div2' style="display:none">

    <?php
    $salle_choisie = 'salle_choisie_2';
    include("formstar2.php");
    ?>

    <center> 
        <img id='ima2' class='map' src='image/etage2.svg' width='1488' height='2105' usemap='#map2'/>"
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
        $tab_coords_2=["201"=>"131,359,232,358,233,382,209,383,208,492,233,492,233,506,131,505","237"=>"92,570,92,655,176,655,173,571","236"=>"251,655,251,571,173,571,177,655","248"=>"198,691,146,690,146,821,209,821,209,800,198,799","233"=>"315,800,315,737,199,737,199,800","227"=>"351,630,351,683,422,683,467,638,467,568,414,568","225"=>"560,566,469,567,467,636,513,683,531,684,559,710","228"=>"425,790,411,776,351,776,351,684,422,684,466,728,467,747","221"=>"566,737,568,738,567,740,632,806,577,860,510,793","222"=>"524,913,457,847,510,794,576,859","223"=>"435,868,436,932,471,966,524,913,457,847","235"=>"315,570,251,570,252,654,316,655,315,654","253"=>"471,1116,471,1126,489,1125,488,1143,499,1154,468,1186,472,1191,475,1191,520,1236,626,1133,581,1088,581,1063,479,960,465,973,562,1073,522,1116","251"=>"432,1088,453,1108,453,1191,421,1222,405,1222,404,1117,414,1116,414,1106","266"=>"191,1325,149,1283,148,1272,158,1272,205,1227,251,1272,244,1272","258"=>"347,1211,404,1212,403,1220,411,1220,412,1230,397,1244,407,1253,397,1260,376,1260,346,1231","269"=>"170,1399,216,1355,236,1378,252,1376,307,1432,254,1487,246,1475"];
        foreach ($tab_coords_2 as $key => $value) {
            echo "<area shape=\"poly\" coords=\"{$value}\" onclick=\"myFunction1({$key})\" href=\"#\" onmouseover=\"tracage('{$value}','ima2')\" onmouseout=\"effacage()\"/>";

            echo "<script type='text/javascript'>tracage2(\"{$value}\",'ima2');</script>" ;
        }
        ?>

    </map>
</div>



