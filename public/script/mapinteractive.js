/**
 * @file mapinteractive.js
 * 
 * Ce fichier décrit les fonctions liées au traçage des polygones semi-transparent au dessus des salles choisies lors de la réservation, de la notation ou de la création
 * Il contient 3 fonctions.
 * 
 * - tracage(coords,img_id)          
 * - tracage2(coords,img_id)
 * - effacage()                                            
 * 
 */


var ctx=0;
var ctx2=0;

/**
 * Fonction qui trace un polygone semi-transparent au dessus de la salle survolée à la souris
 * @param   coords les coordonnées de la salle
 * @param   img_id l'identifiant de la carte
 * @return         rien
 */
function tracage(coords,img_id)
{
    console.log("Sortie");
    console.log(img_id);
    var img = document.getElementById(img_id);
    var canvas = document.getElementById("canvas");
    canvas.height = img.height;
    canvas.width = img.width;
    canvas.style.left = img.offsetLeft+"px";
    canvas.style.top = img.offsetTop+"px";


    ctx = canvas.getContext('2d');
    ctx.globalAlpha = 0.6;
    console.log(coords);
    var poly=coords.split(",");
    console.log(poly[0],poly.length);

    var shape = poly.slice(0);


    ctx.beginPath();
    ctx.moveTo(shape.shift(), shape.shift());
    while(shape.length) {
        ctx.lineTo(shape.shift(), shape.shift());
    }
    ctx.closePath();
    ctx.fill();
}

/**
 * fonction qui trace un polygone semi-transparent au dessus des salles non valide (pas assez de places ou déjà réservée)
 * @param   coords les coordonnées de la salle
 * @param   img_id l'identifiant de la carte
 * @return         rien
 */
function tracage2(coords,img_id)
{
    console.log("Entrée");
    var canvas2 = document.getElementById("canvas2");

    ctx2 = canvas2.getContext('2d');
    ctx2.globalAlpha = 0.6;
    console.log(coords);
    var poly=coords.split(",");
    console.log(poly[0],poly.length);

    var shape = poly.slice(0);


    ctx2.beginPath();
    ctx2.moveTo(shape.shift(), shape.shift());
    while(shape.length) {
        ctx2.lineTo(shape.shift(), shape.shift());
    }
    ctx2.closePath();
    ctx2.fill();
}

/**
 * fonction qui efface la zone semi-transparente tracée au dessus de la salle une fois son survole terminé
 * @return  rien
 */
function effacage()
{
    var ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}