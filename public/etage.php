<?php
include "vue.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cartes interactives</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="script/jquery.maphilight.js"></script>
	<script type="text/javascript">$(function() {
		$('.map').maphilight({fade: false});
	});</script>
	<link rel="stylesheet" type="text/css" href="etage1.css">
	<link rel="stylesheet" type="text/css" href="style/style_menu.css">

	<style>
	href
	{
		target:"_blank";
	}

</style>
</head>
<body>

	<?php
	create_nav();
	?>

	<script>
		function myFunction1(entier)
		{
			document.getElementById("change1").innerHTML = entier;
		}
		function myFunction2(entier)
		{
			document.getElementById("change2").innerHTML = entier;
		}
	</script> 


	<h1>Etage1</h1>
	<img class="map" src="image/etage1.svg" width="1052" height="744" usemap="#map1">

	

	<map name="map1">
		<area shape="poly" coords="287,91,287,171,392,169,392,92,393,92" href="#" onclick="myFunction1(102)" />
		<area shape="poly" coords="287,170,287,263,393,261,393,170"   href="#"  onclick="myFunction1(101)" />
		<area shape="poly" coords="298,261,301,321,392,321,392,262"   href="#" onclick="myFunction1(139)" />
		<area shape="poly" coords="407,283,496,284,495,336,407,336"   href="#" onclick="myFunction1(138)" />
		<area shape="poly" coords="524,364,577,364,577,351,612,316,630,315,630,262,575,263,525,313"   href="#" onclick="myFunction1(130)" />
		<area shape="poly" coords="630,262,630,315,669,356,701,325,701,262"  href="#" onclick="myFunction1(127)" />
		<area shape="poly" coords="627,414,578,366,525,366,524,460,581,460"   href="#" onclick="myFunction1(131)" />
		<area shape="poly" coords="620,407,654,441,701,397,701,357,670,357"   href="#" onclick="myFunction1(126)" />
		<area shape="poly" coords="716,355,762,355,761,442,747,457,709,418,715,409"   href="#" onclick="myFunction1(121)" />
		<area shape="poly" coords="648,478,708,419,747,457,687,516"   href="#" onclick="myFunction1(122)" />
		<area shape="poly" coords="627,489,680,538,632,589,622,587,581,545,581,534"   href="#" onclick="myFunction1(123)" />
		<area shape="poly" coords="524,496,581,496,580,587,528,587"   href="#" onclick="myFunction1(133)" />
		<area shape="poly" coords="495,591,495,546,397,546,397,595"   href="#" onclick="myFunction1(135)" />
		<area shape="poly" coords="396,492,396,595,375,595,348,567,346,493"   href="#" onclick="myFunction1(148)" />
		<area shape="poly" coords="369,407,396,408,396,491,347,492,347,428"   href="#" onclick="myFunction1(149)" />
		<area shape="poly" coords="495,407,397,407,397,453,495,453"   href="#" onclick="myFunction1(136)" />
		<area shape="poly" coords="290,335,311,336,360,386,329,417,291,417"   href="#" onclick="myFunction1(140)" />

		<p id="change1">Blabla</p>

	</map>


	<h1>Etage2</h1>
	<img class="map" src="image/etage2.svg" width="1488" height="2105" usemap="#map2">

	<map name="map2">

		<area shape="poly" coords="131,359,232,358,233,382,209,383,208,492,233,492,233,506,131,505" onclick="myFunction2(201)"  href="#" />
		<area shape="poly" coords="92,570,92,655,176,655,173,571" onclick="myFunction2(237)"  href="#" />
		<area shape="poly" coords="251,655,251,571,173,571,177,655" onclick="myFunction2(236)"  href="#" />
		<area shape="poly" coords="198,691,146,690,146,821,209,821,209,800,198,799" onclick="myFunction2(248)"  href="#" />
		<area shape="poly" coords="315,800,315,737,199,737,199,800" onclick="myFunction2(233)"  href="#" />
		<area shape="poly" coords="351,630,351,683,422,683,467,638,467,568,414,568" onclick="myFunction2(227)"  href="#" />
		<area shape="poly" coords="560,566,469,567,467,636,513,683,531,684,559,710" onclick="myFunction2(225)"  href="#" />
		<area shape="poly" coords="425,790,411,776,351,776,351,684,422,684,466,728,467,747" onclick="myFunction2(228)"  href="#" />
		<area shape="poly" coords="566,737,568,738,567,740,632,806,577,860,510,793" onclick="myFunction2(221)"  href="#" />
		<area shape="poly" coords="524,913,457,847,510,794,576,859" onclick="myFunction2(222)"  href="#" />
		<area shape="poly" coords="435,868,436,932,471,966,524,913,457,847" onclick="myFunction2(223)"  href="#" />
		<area shape="poly" coords="315,570,251,570,252,654,316,655,315,654" onclick="myFunction2(235)"  href="#" />
		<area shape="poly" coords="471,1116,471,1126,489,1125,488,1143,499,1154,468,1186,472,1191,475,1191,520,1236,626,1133,581,1088,581,1063,479,960,465,973,562,1073,522,1116" onclick="myFunction2(235)"  href="#" />
		<area shape="poly" coords="432,1088,453,1108,453,1191,421,1222,405,1222,404,1117,414,1116,414,1106" onclick="myFunction2(251)"  href="#" />
		<area shape="poly" coords="191,1325,149,1283,148,1272,158,1272,205,1227,251,1272,244,1272" onclick="myFunction2(266)"  href="#" />
		<area shape="poly" coords="347,1211,404,1212,403,1220,411,1220,412,1230,397,1244,407,1253,397,1260,376,1260,346,1231" onclick="myFunction2(258)"  href="#" />
		<area shape="poly" coords="170,1399,216,1355,236,1378,252,1376,307,1432,254,1487,246,1475" onclick="myFunction2(269)"  href="#"  />

	</map>

	<p id="change2">Blabla</p>

    <?php
    create_footer();
    ?>


</body>
</html>
