<?php
/**
 * Created by PhpStorm.
 * User: kodra
 * Date: 24/04/18
 * Time: 14:51
 */
include "../vue.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>carte</title>
	<meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"/>
	<!--<style type="text/css">


	nav {
		margin: 20px auto;
		position: relative;
		width: 1000px;
		height: 120px;
		background-color: #34495e;
		border-radius: 8px;
		font-size: 0;
	}
	nav a {
		line-height: 50px;
		height: 100%;
		font-size: 15px;
		display: inline-block;
		position: relative;
		z-index: 1;
		text-decoration: none;
		text-transform: uppercase;
		text-align: center;
		color: white;
		cursor: pointer;
	}
	nav .animation {
		position: absolute;
		height: 100%;
		top: 0;
		z-index: 0;
		transition: all .5s ease 0s;
		border-radius: 8px;
	}
	a:nth-child(1) {
		width: 200px;
	}
	a:nth-child(2) {
		width: 110px;
	}
	a:nth-child(3) {
		width: 100px;
	}
	a:nth-child(4) {
		width: 160px;
	}
	a:nth-child(5) {
		width: 120px;
	}
	a:nth-child(6) {
		width: 120px;
	}
	a:nth-child(7) {
		width: 140px;
	}


	nav .start-about, a:nth-child(2):hover~.animation {
		width: 110px;
		left: 200px;
		background-color: #E37E33;
	}
	nav .start-blog, a:nth-child(3):hover~.animation {
		width: 100px;
		left: 310px;
		background-color: #DE5E2D;
	}
	nav .start-portefolio, a:nth-child(4):hover~.animation {
		width: 160px;
		left: 410px;
		background-color: #DD3728;
	}
	nav .start-contact, a:nth-child(5):hover~.animation {
		width: 120px;
		left: 570px;
		background-color: #D91E3C;
	}
	nav .start-contact, a:nth-child(6):hover~.animation {
		width: 120px;
		left:690px;
		background-color: #BF2865;
	}
	nav .start-contact, a:nth-child(7):hover~.animation {
		width: 190px;
		left:810px;
		background-color: #B62A6B;
	}

	body {
		font-size: 12px;
		font-family: sans-serif;
	}
	h1 {
		text-align: center;
		margin: 40px 0 40px;
		text-align: center;
		font-size: 30px;
		color: #ecf0f1;
		text-shadow: 2px 2px 4px #000000;
		font-family: 'Cherry Swash', cursive;
	}

	p {
		bottom: 20px;
		width: 100%;
		text-align: center;
		color: #ecf0f1;
		font-family: 'Cherry Swash',cursive;
		font-size: 16px;
	}

	span {
		color: #2BD6B4;
	}

	.cbx 
	{
		visibility:hidden;
	}

	label 
	{
		background-color: #E37E33FF;
		border:1px solid #ccc;
		padding:20px;
		display:block; 
	}

	input:checked + label {
		background-color: #1DA1F2FF;
	}

	label:hover 
	{
		background:#eee;
		cursor:pointer;
	}

	ul {
		background-color: #f3f3f3;
		border: 1px solid #e7e7e7;
		list-style-type: none;
		margin: 0;
		overflow: hidden;
		padding: 0;		
	}

	li {
		float: left;
	}

	li a {
		color: #666;
		display: block;		
		padding: 14px 16px;
		text-align: center;
		text-decoration: none;
	}

	li a:hover:not(.active) {
		background-color: #ddd;
	}

	li a.active {
		background-color: #4CAF50;
		color: white;

	}

</style>-->


</head>

<body>

	<?php
    	create_nav();
    ?>


	<script src="fibo_heap.js">	</script>

	<div color="blue">

		<form name="form" action="javascript:initialisation(champ_dep.value,champ_arr.value);">

			<input class="cbx" type="checkbox" id="cbx1" name="cbx1" value="1" />
			<label for="cbx1">Départ<input id="champ_dep" type="text" name="dep" onfocus="addMouseChecker('ima',this.id,'xy',canvas,'on')" autofocus required=""></label>
			<input class="cbx" type="checkbox" id="cbx2" name="cbx2" value="2"/>
			<label for="cbx2">Arrivée<input id="champ_arr" type="text" name="arr" onfocus="addMouseChecker('ima',this.id,'xy',canvas,'on')" required=""></label>
			<br><br>
			<input id="resultat" class="bt btn btn-lg btn-primary btn-block" type="submit" name="Effectuer" >
			<input type="button" class="bt btn btn-lg btn-primary btn-block" onclick='window.location.reload(false)' value="Relancer"/>
		</form> 
	</div>

	<script>
		function addMouseChecker(imgId, id_champ, valueToShow,canvas,on_off) {
			if (on_off == 'on' )
			{
				imgId = document.getElementById(imgId);
				id_champ = document.getElementById(id_champ);

				if (imgId.addEventListener) {
					imgId.addEventListener('click', function(e){checkMousePos(imgId, id_champ, valueToShow, e,canvas);}, false);
				} else if (imgId.attachEvent) {
					imgId.attachEvent('onclick', function(e){checkMousePos(imgId, id_champ, valueToShow, e,canvas);});
				}
			}
			
		}

		function checkMousePos(imgId, id_champ, valueToShow, e,canvas) {
			var pos = [];
			var path = imgId.src.replace(/^.*[\\\/]/, '').split('.')[0];
			pos.x = e.pageX - imgId.offsetLeft;
			pos.y = e.pageY - imgId.offsetTop;
			pos.xy = pos.x +','+ pos.y ;
			var pixelData = canvas.getContext('2d').getImageData(pos.x, pos.y, 1, 1).data;

			if(document.getElementById("cbx1").checked == true)
			{
				console.log("ok");
				champ_dep.value = pos[valueToShow];
			}
			if(document.getElementById("cbx2").checked == true)
			{
				console.log("hell");
				champ_arr.value = pos[valueToShow];
			}	
			
		}


		function changeImage(ind) {

			if (ind == 1) 
			{
				document.getElementById('ima').src = "../image/etage1.svg";

			}
			if (ind == 2) 
			{
				document.getElementById('ima').src = "../image/etage2.svg";
			}
		}

		function off() 
		{
			document.getElementById("canvas").style.display = "none";
		}

		function on() 
		{
			document.getElementById("canvas").style.display = "block";
		}

	</script>
	<canvas id="canvas" height="0" width="0"></canvas>
	<img id='ima' src="totale.svg" >
	


	<script type="text/javascript">
		
	</script>

	
</body>
</html>