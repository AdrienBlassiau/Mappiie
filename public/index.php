<?php  
/**
 * @file index.php
 * 
 * Ce fichier affiche le logo Mappiie qui disparaît progressivement pour ensuite arriver sur le site                                                 
 * 
 */
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="style/index.css"/>
    <title>
        MappIIE
    </title>
</head>

<body>
    <img id="idim" src="image/logo.png" style="-moz-opacity:0;filter:alpha(opacity=0)">
    <script>
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
        var max = 100;
        var min = 0;
        var opacite=min;
        var up=true;
        var IsIE=!!document.all;
        var ThePic=document.getElementById("idim");

        function fadePic(){
            if (opacite<max && up){opacite+=6;}
            if (opacite>=max){up=false;}
            if (opacite<=min){up=true;}

            IsIE?ThePic.filters[0].opacity=opacite:document.getElementById("idim").style.opacity=opacite/100;
        //document.getElementById('result').value=opacite+"%";
        }

        setInterval(function(){fadePic();},100);
        sleep(2000).then(() => {
            window.location.replace("main_menu.php");
        });
    </script>

</body>
</html>
