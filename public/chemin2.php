<?php
/**
 * @file chemin2.php
 * 
 * Ce fichier contient l'affichage de la carte d'itinéraire interactive pour la recherche de chemin d'un utilisateur connecté
 *  
 */
 ?>


<div class="text-center formulaire-haut">
	<h1 class="h1 mb-3 font-weight-normal">Chercher son chemin</h1>
</div>

<script src="script/binary_heap.js">	</script>

<div color="blue" class="margin">

	<form name="form" action="javascript:initialisation();">

		<input class="cbx" type="checkbox" id="cbx1" name="cbx1" value="1" />
		<label class="digital" for="cbx1"><span style="position: relative; left: 20px"> Départ : </span><input class="coord" placeholder="x,y" id="champ_dep" type="text" name="dep" onfocus="addMouseChecker('canvas',this.id,'xy',canvas,'on')" autofocus="" required="" readonly><span style="position: relative; left: 20%">Cliquez ici puis sélectionnez un point de départ sur la carte</span></label>
		<input class="cbx" type="checkbox" id="cbx2" name="cbx2" value="2"/>
		<label class="digital" for="cbx2"><span style="position: relative; left: 20px">Arrivée : </span><input class="coord" placeholder="x,y" id="champ_arr" type="text" name="arr" onfocus="addMouseChecker('canvas',this.id,'xy',canvas,'on')" required="" readonly><span style="position: relative; left: 20%"> Cliquez ici puis sélectionnez un point d'arrivée sur la carte</span></label>
		<br><br>
		<input id="resultat" class="bt btn btn-lg btn-primary" style="position:relative; left: 5%; width: 200px" type="submit" name="Effectuer" value="Tracer" >
	</form> 
</div>


<!--Différentes fonctions qui s'occupent de la récupération des coordonnées de la zone de la map cliquée -->
<script>
	
	function addMouseChecker(imgId, id_champ, valueToShow,canvas,on_off) 
	{
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
		pos.x = e.pageX - imgId.offsetLeft;
		pos.y = e.pageY - imgId.offsetTop;
		pos.xy = pos.x +','+ pos.y ;

		if(document.getElementById("cbx1").checked == true)
		{
			xdep =pos.x;
			ydep =pos.y;
			console.log("ok :");
			make_base(pos.x ,pos.y ,0);
			champ_dep.value = pos[valueToShow];

		}
		if(document.getElementById("cbx2").checked == true)
		{
			xarr = pos.x;
			yarr = pos.y;
			console.log("no");
			make_base(pos.x ,pos.y ,1);
			champ_arr.value = pos[valueToShow];
		}	

	}


	function changeImage(ind) {

		if (ind == 1) 
		{
			document.getElementById(base_image.id).src = "../image/etage1.svg";

		}
		if (ind == 2) 
		{
			document.getElementById(base_image.id).src = "../image/etage2.svg";
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

<!--canvas sur lequel s'affiche la carte -->
<center>
	<canvas id="canvas">
	</canvas>	
</center>


<!--Script JavaScript qui s'occupe de l'affichage de la map et des curseurs -->
<script type="text/javascript">

	var canvas = document.getElementById('canvas');
	canvas.width = 1587;
	canvas.height = 1512;
	var context = canvas.getContext('2d');
	var xdep =0;
	var ydep =0;
	var xarr =0;
	var yarr =0;
	make_base(-1);

	function make_base(posx,posy,valide)
	{	

		base_image = new Image();
		base_image.src = '../image/totale.svg';
		logo = new Image();
		logo.src = '../image/logo_map.png';
		base_image.id= 'ima';
		base_image.onload = function()
		{
			context.clearRect(0,0,canvas.width, canvas.height);
			context.drawImage(base_image, 0, 0,base_image.width, base_image.height);
			if(valide == 0)
			{
				context.beginPath();
				var radius = 6;
				context.arc(xdep, ydep, radius, 0, 2 * Math.PI, false);
				context.fillStyle = 'white';
				context.fill();
				context.lineWidth = 3;
				context.strokeStyle = 'black';
				context.stroke();
				if(xarr != 0)
				{

					context.beginPath();
					context.arc(xarr, yarr, 6, 0, 2 * Math.PI, false);
					context.fillStyle = 'white';
					context.fill();
					context.lineWidth = 2;
					context.strokeStyle = 'black';
					context.stroke();
					context.beginPath();
					context.arc(xarr, yarr, 2, 0, 2 * Math.PI, false);
					context.fillStyle = 'black';
					context.fill();
					context.drawImage(logo, xarr-9, yarr-24,logo.width/10, logo.height/10);

				}

			}
			else if (valide == 1)
			{
				context.beginPath();
				context.arc(xarr, yarr, 6, 0, 2 * Math.PI, false);
				context.fillStyle = 'white';
				context.fill();
				context.lineWidth = 2;
				context.strokeStyle = 'black';
				context.stroke();
				context.beginPath();
				context.arc(xarr, yarr, 2, 0, 2 * Math.PI, false);
				context.fillStyle = 'black';
				context.fill();

				context.drawImage(logo, xarr-9, yarr-24,logo.width/10, logo.height/10);
				if(xdep != 0)
				{
					context.beginPath();
					context.arc(xdep, ydep, 6, 0, 2 * Math.PI, false);
					context.fillStyle = 'white';
					context.fill();
					context.lineWidth = 3;
					context.strokeStyle = 'black';
					context.stroke();
				}

			}

		};
	}
</script>
