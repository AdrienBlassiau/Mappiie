/**
 * @file binary_heap.js
 * 
 * Ce fichier décrit les fonctions liées au pathfinding
 * Il contient 15 fonctions et 2 types.
 *
 * - BinaryHeap   le tas binaire à la base de l'algorithme A*
 * - Node         le nœud de l'arbre binaire implémenté en tas
 * 
 * - BinaryHeap.prototype.calcul_distance = function(x1,y1, x2,y2,choix_heuristique)          
 * - BinaryHeap.prototype.insertion_tas = function(x,y)
 * - BinaryHeap.prototype.extraction_tas = function()
 * - BinaryHeap.prototype.modification_tas = function(pos_fils)
 * - BinaryHeap.prototype.recherche_tas = function(x,y,xp,yp)
 * - BinaryHeap.prototype.afficher_tas = function()
 * - BinaryHeap.prototype.afficher_node = function(node)
 * - 
 * - detection_couleur(context,x,y,copieData,width,height)
 * - chemin(x2,y2,x1,y1,tas,ctx)
 * - estPaire(x,pas)
 * - detectImage(x,y)
 * - mini(chem1,chem2,chem3,chem4)
 * - escalier(x,y,map1,map2)
 * - a_etoile(choix,nb_noeud,context,data,width,height,xa,ya,xb,yb)                          
 * - initialisation(a,b)
 */

/**
 * Le type tas binaire qui contient l'ensemble des informations utiles au tris
 * @param  nb_noeud le nombre de nœud maximum qu'il peut contenir
 */
var BinaryHeap = function (nb_noeud) {
  this.minNode = undefined;
  this.taille = 0;
  this.cout_mini = 0;
  this.cout_choix = 0;
  this.heuri_choix = 0;
  this.fp = new Array(nb_noeud*nb_noeud);
  this.tab_pred = new Array(2000);
  this.tab_visite = new Array(2000);
  for (var i = 0; i < 2000; i++) {
    this.tab_pred[i] = new Array(2000);
    this.tab_visite[i] = new Array(2000);
    for (var j = 0; j < 2000; j++) {
      this.tab_pred[i][j] = {x:0,y:0};
      this.tab_visite[i][j] = 0;
    }  
  }
};

/**
 * fonction qui calcule la distance heuristique 
 * @param   x1                la coordonnée x du nœud courant
 * @param   y1                le coordonnée y du nœud courant
 * @param   x2                la coordonnée x du nœud d'arrivé
 * @param   y2                la coordonnée y du nœud d'arrivé
 * @param   choix_heuristique le type d'heuristique choisi (0 =  Dijkstra et 1 = A * (utilisé ici))
 * @return                    rien
 */
BinaryHeap.prototype.calcul_distance = function(x1,y1, x2,y2,choix_heuristique)
{
  this.cout_choix = this.cout_mini + 1 ;
  if (choix_heuristique == 1) /* Si parcours en largeur*/
  {
    this.heuri_choix = 0;
  }
  else /*Si A * */
  {
    this.heuri_choix = Math.round(Math.sqrt(Math.abs(x1 - x2)*Math.abs(x1 - x2) + Math.abs(y1 - y2)*Math.abs(y1 - y2)));
  }
};

/**
 * fonctioon d'insertion d'un nœud dans le tas
 * @param   x la coordonnée x du nœud
 * @param   y la coordonnée y du nœud
 * @return    rien
 */
BinaryHeap.prototype.insertion_tas = function(x,y)
{   
  //this.afficher_tas();
  var largeur = this.taille;
  var poids = this.heuri_choix + this.cout_choix;

  this.taille +=1;
  while (largeur > 0 && this.fp[Math.floor((largeur-1)/2)].cout_heuri >= poids)/*Tant que le noeud à remonter est plus petit que son père on le remonte*/
  {
    this.fp[largeur] = this.fp[Math.floor((largeur-1)/2)];
    largeur = Math.floor((largeur-1)/2);
  }

  var node = new Node(x,y,this.cout_choix,this.heuri_choix);
  this.fp[largeur] = node;
  //this.afficher_tas();
};

/**
 * fonction qui extraie un nœud du tas
 * @return  rien
 */
BinaryHeap.prototype.extraction_tas = function()
{

  //console.log("début extraction");
  //this.afficher_tas();
  this.minNode = (this.fp[0]); /*On enlève le dernier nœud du tas et on le met à la place du premier que l'on retire du tas*/
  this.cout_mini = (this.fp[0]).cout; 

  var v = this.fp[this.taille-1].cout_heuri;
  var ancien = this.taille-1;

  this.fp[0] = this.fp[this.taille-1];
  this.taille --;

  var i = 0;

  while (2*i+1 < this.taille)/*Tant que le père est plus petit que l'un de ses deux fils */
  {
    var j = 2*i+1;
    if ( (j +1 < this.taille) && ( this.fp[j+1].cout_heuri < this.fp[j].cout_heuri) )/*Si l'un des deux fils est plus petit*/
    {
      j++;
    } 
    if ( v < this.fp[j].cout_heuri)/*Si le père est plus petit que ses deux fils*/
      break;

    this.fp[i] = this.fp[j];
    i = j;           
  }

  this.fp[i] = this.fp[ancien];/*On place l'ancienne racine à sa nouvelle place*/
  //console.log("fin extraction");
  //this.afficher_tas();
};

/**
 * fonction qui modifie la valeur d'un nœud du tas et donc sa position
 * @param   pos_fils la position précédente du nœud dans le tas
 * @return           rien
 */
BinaryHeap.prototype.modification_tas = function(pos_fils)
{
  var largeur = pos_fils;
  var ret = this.fp[largeur];
  var poids = this.fp[largeur].cout_heuri;

  while (largeur > 0 && this.fp[Math.floor((largeur-1)/2)].cout_heuri >= poids)/*Tant que le nœud à remonter est plus petit que son père on le remonte*/
  {     
    this.fp[largeur] = this.fp[Math.floor((largeur-1)/2)];
    largeur = Math.floor((largeur-1)/2);
  }

  (this.fp[largeur]) = ret;
};

/**
 * fonction qui recherche si un nœud est présent dans le tas ou non et qui applique une insertion de ce nœud dans le tas si il n'est pas présent ou déjà présent mais avec une valeur plus élevée
 * @param   x  la coordonnée x du nœud à insérer
 * @param   y  la coordonnée y du nœud à insérer
 * @param   xp la coordonnée x du nœud précédent 
 * @param   yp la coordonnée y du nœud précédent
 * @return     rien
 */
BinaryHeap.prototype.recherche_tas = function(x,y,xp,yp)
{
  var suc_pot = x+','+y;
  var present = 0;
  var ind_courant = this.fp.map(function(e){ return e.valeur;}).indexOf(suc_pot);
  //console.log("ind_courant rec :"+ind_courant);
  if (ind_courant != -1) /*Si le nœud est déjà présent dans le tas ...*/
  {
    //console.log("déjà près :");
    if ( (this.fp[ind_courant]).cout >= this.cout_choix)/*... et si il a un coût plus petit*/
    {
      /*On met à jour*/
      (this.fp[ind_courant]).cout = this.cout_choix;
      (this.fp[ind_courant]).heuri = this.heuri_choix;
      (this.fp[ind_courant]).cout_heuri = this.heuri_choix + this.cout_choix;
      this.tab_pred[x][y].x = xp;
      this.tab_pred[x][y].y = yp;
      //console.log("MISE A JOUR - xpred :"+this.tab_pred[x][y].x+"ypred :"+this.tab_pred[x][y].y+"et choix :"+x+","+y);
      this.modification_tas(ind_courant);

      return;
    }
    else
    {
      return;
    }  
  }

  else/*Si il n'est pas déjà présent, on l'ajoute au tas*/
  {
    this.tab_pred[x][y].x = xp;
    this.tab_pred[x][y].y = yp;
    //console.log("NON MISE A JOUR - xpred :"+this.tab_pred[x][y].x+"ypred :"+this.tab_pred[x][y].y+"et choix :"+x+","+y);
    this.insertion_tas(x,y);
    return;
  }
};

/**
 * fonction qui affiche les données contenues dans le tas binaire (pour le debug) 
 * @return  rien
 */
BinaryHeap.prototype.afficher_tas = function()
{
  var i;
  console.log("Debut affichage tas avec cout mini :"+this.cout_mini);
  for (i = 0; i < this.taille; ++i)
  {
    var node = this.fp[i];
    console.log('x: ' + node.coor.x, ', y: ' + node.coor.y+ ', cout: ' + node.cout + ', heuri: ' + node.heuri + ', cout_heuri: ' + node.cout_heuri);
  }
  console.log("\n");
  console.log("Fin affichage tas");
};

/**
 * fonction qui affiche les données liées à un nœud (pour le debug)  
 * @param   node le nœud à afficher
 * @return       rien
 */
BinaryHeap.prototype.afficher_node = function(node)
{
  var i;
  console.log("noeud choisi : "+'x: ' + node.coor.x, ', y: ' + node.coor.y+ ', cout: ' + node.cout + ', heuri: ' + node.heuri + ', cout_heuri: ' + node.cout_heuri);
};

/**
 * Le noeud, unité du tas binaire
 * @param  x     la coordonnée x du nœud
 * @param  y     la coordonnée y du nœud
 * @param  cout  le coût du nœud
 * @param  heuri le coût heuristique du nœud
 */
function Node(x,y,cout,heuri) {
  this.valeur = x+","+y;
  this.coor = {x:x,y:y};
  this.cout = cout;
  this.heuri = heuri;
  this.cout_heuri = cout + heuri;
}

/**
 * fonction qui détecte la couleur du pixel
 * @param   context   le contexte du canvas
 * @param   x         la coordonnée x du pixel
 * @param   y         la coordonnée y du pixel
 * @param   copieData la copie du canvas courant
 * @param   width     la largeur du canvas courant
 * @param   height    la hauteur du canvas courant
 * @return            rien
 */
function detection_couleur(context,x,y,copieData,width,height)
{

  R = copieData.data[((y * (width * 4)) + (x * 4)) + 0];
  G = copieData.data[((y * (width * 4)) + (x * 4)) + 1];
  B = copieData.data[((y * (width * 4)) + (x * 4)) + 2];

  if(R == 178 && G==178 && B==178)
  {
    return 1;
  }
  
  else{
    return 0;
  }
}

/**
 * fonction qui affiche le chemin obtenu une fois l'algorithme A * terminé
 * @param   x2  la coordonnée x du point d'arrivée
 * @param   y2  la coordonnée y du point de départ
 * @param   x1  la coordonnée x du point de départ
 * @param   y1  la coordonnée y du point de départ
 * @param   tas le tas 
 * @param   ctx le contexte du canvas
 * @return      rien
 */
function chemin(x2,y2,x1,y1,tas,ctx)
{ 
  //console.log("x : "+tas.tab_pred[x1][y1].x+"y : "+tas.tab_pred[x1][y1].y);  
  var solx = x2;
  var soly = y2;
  var x = x2;
  var y = y2;
  var i =0;
  //console.log("x : "+solx+"y : "+soly);

  while((x!=x1 || y!=y1) && i<2000){
    solx = tas.tab_pred[x][y].x;
    soly = tas.tab_pred[x][y].y;
    x = solx;
    y = soly;
    //console.log("x : "+x+"y : "+y);
    ctx.beginPath();
    ctx.arc(x, y,5, 0, 2 * Math.PI, false);
    ctx.fillStyle = '#04AFF9';
    ctx.fill();
    ctx.lineWidth = 2;
    ctx.strokeStyle = '#3379C3';
    ctx.stroke();
    i++;
  }
  //console.log(i);
  
}

/**
 * fontion qui renvoie la coordonnée x ou y d'un pixel arrondi au pas près (pris à 10)
 * @param   x   la coordonnée du pixel
 * @param   pas le pas d'itération
 * @return      rien
 */
function estPaire(x,pas)
{
  if (x%pas != 0)
  {
    x=Math.round(Math.round(x/pas)*pas);

    return x;
  }
  return x;
}

/**
 * fonction qui détecte sur quelle carte se situe la coordonnée choisie par l'utilisateur
 * @param   x la coordonnée x du point choisi par l'utilisateur
 * @param   y la coordonnée y du point choisi par l'utilisateur
 * @return    rien
 */
function detectImage(x,y)
{
  if(y >= 510 &&  y<= 1150 && x >= 694 && x <= 1226)
  {
    return 1;
  }
  else if(y>= 57 && y<= 463 && x >= 901 &&  x <= 1549 )
  {
    return 0;
  }
  else
  {
    return 2;
  }
}

/**
 * fonction qui renvoie le plus petit des quatre chemins entrés
 * @param   chem1 le premier chemin rentré
 * @param   chem2 le deuxième chemin entré
 * @param   chem3 le troisième chemin entré
 * @param   chem4 le quatrième chemin rentré
 * @return        rien
 */
function mini(chem1,chem2,chem3,chem4)
{
  var tab = [chem1,chem2,chem3,chem4];
  var minesc = tab[0];
  var escalier = 1;
  for (var i = 0; i <= 3; i++) {
    if (minesc >= tab[i])
    {
      minesc = tab[i];
      escalier = i+1;
    }
  }

  return escalier;
}

/**
 * fonction qui renvoie l'escalier le plus proche d'un point de départ ou d'arrivée choisi par l'utilisateur
 * @param   x    la coordonnée x du point
 * @param   y    la coordonnée y du point
 * @param   map1 l'étage sur lequel se situe le premier point
 * @param   map2 l'étage sur lequel se situe le deuxième point
 * @return       rien
 */
function escalier(x,y,map1,map2)
{
  var chem1;
  var chem2;
  var chem3;
  var excalier0={x0:0,y0:0,x1:0,y1:0};

  var excalier1={x0:1180,y0:260,x1:840,y1:660};
  var excalier2={x0:1250,y0:260,x1:1060,y1:660};

  var excalier3={x0:840,y0:680,x1:330,y1:270};
  var excalier4={x0:1060,y0:680,x1:400,y1:270};
  var excalier5={x0:1060,y0:680,x1:590,y1:270};
  var excalier6={x0:930,y0:1050,x1:340,y1:700};

  console.log("entrée");
  if (map1 == 2)
  {
    console.log("depart deuxieme etage vers le premier");
    esc1 = excalier3;
    esc2 = excalier4;
    esc3 = excalier5;
    esc4 = excalier6;

    chem1 = Math.sqrt(Math.pow(Math.abs(x - esc1.x1),2) + Math.pow(Math.abs(y - esc1.y1),2));
    chem2 = Math.sqrt(Math.pow(Math.abs(x - esc2.x1),2) + Math.pow(Math.abs(y - esc2.y1),2));
    chem3 = Math.sqrt(Math.pow(Math.abs(x - esc3.x1),2) + Math.pow(Math.abs(y - esc3.y1),2));
    chem4 = Math.sqrt(Math.pow(Math.abs(x - esc4.x1),2) + Math.pow(Math.abs(y - esc4.y1),2));
  }
  else if (map1 == 1)
  {
    //console.log("départ premier étage vers ");
    if (map2 == 0)
    {
      //console.log("le rdc");
      esc1 = excalier1;
      esc2 = excalier2;
      esc3 = excalier0;
      esc4 = excalier0;

      chem1 = Math.sqrt(Math.pow(Math.abs(x - esc1.x1),2) + Math.pow(Math.abs(y - esc1.y1),2));
      chem2 = Math.sqrt(Math.pow(Math.abs(x - esc2.x1),2) + Math.pow(Math.abs(y - esc2.y1),2));
      chem3 = Math.sqrt(Math.pow(Math.abs(x - esc3.x0),2) + Math.pow(Math.abs(y - esc3.y0),2));
      chem4 = Math.sqrt(Math.pow(Math.abs(x - esc4.x0),2) + Math.pow(Math.abs(y - esc4.y0),2));
    }
    else
    {
      //console.log("vers le deuxième");
      esc1 = excalier3;
      esc2 = excalier4;
      esc3 = excalier5;
      esc4 = excalier6;

      chem1 = Math.sqrt(Math.pow(Math.abs(x - esc1.x0),2) + Math.pow(Math.abs(y - esc1.y0),2));
      chem2 = Math.sqrt(Math.pow(Math.abs(x - esc2.x0),2) + Math.pow(Math.abs(y - esc2.y0),2));
      chem3 = Math.sqrt(Math.pow(Math.abs(x - esc3.x0),2) + Math.pow(Math.abs(y - esc3.y0),2));
      chem4 = Math.sqrt(Math.pow(Math.abs(x - esc4.x0),2) + Math.pow(Math.abs(y - esc4.y0),2));
    }
  }
  else
  {
    //console.log("départ rdc vers le premier");
    esc1 = excalier1;
    esc2 = excalier2;
    esc3 = excalier0;
    esc4 = excalier0;

    chem1 = Math.sqrt(Math.pow(Math.abs(x - esc1.x0),2) + Math.pow(Math.abs(y - esc1.y0),2));
    chem2 = Math.sqrt(Math.pow(Math.abs(x - esc2.x0),2) + Math.pow(Math.abs(y - esc2.y0),2));
    chem3 = Math.sqrt(Math.pow(Math.abs(x - esc3.x0),2) + Math.pow(Math.abs(y - esc3.y0),2));
    chem4 = Math.sqrt(Math.pow(Math.abs(x - esc4.x0),2) + Math.pow(Math.abs(y - esc4.y0),2));
  }

  console.log("chem com :",chem1,chem2,chem3,chem4);

  var minesc = mini(chem1,chem2,chem3,chem4);
  console.log("Le plus grand escalier est :",minesc);
  switch(minesc)
  {
    case 1:
    return esc1;
    case 2:
    return esc2;
    case 3:
    return esc3;
    case 4:
    return esc4;
  }

}


/**
 * fonction qui calcule le plus court chemin entre deux point A et B entré par l'utilisateur
 * @param   choix    le choix de parcours, avec ou sans heuristique (Dijkstra ou A *->choisi)
 * @param   nb_noeud le nombre de nœud maximum de l'image
 * @param   context  le contexte du canvas
 * @param   data     la copie du canvas pour y faire des opérations annexes
 * @param   width    la largeur du canvas
 * @param   height   la hauteur du canvas
 * @param   xa       le coordonnée x de départ du parcours
 * @param   ya       le coordonnée y de départ du parcours
 * @param   xb       le coordonnée x d'arrivée du parcours
 * @param   yb       la coordonnée y d'arrivée du parcours
 * @return           rien
 */
function a_etoile(choix,nb_noeud,context,data,width,height,xa,ya,xb,yb)
{
  //console.log("ini image ok");

  /*Initialisation données*/
  
  var tas = new BinaryHeap(nb_noeud);
  //console.log("ini tas ok");
  var i;
  var suc_pot = {};
  var entourage=-1;

  var pas = 10;
  var x1 = estPaire(xa,pas);
  var y1 = estPaire(ya,pas);
  var xnew = 0;
  var ynew = 0;
  var heuri=0;
  var cout=0;
  var x2 = estPaire(xb,pas);
  var y2 = estPaire(yb,pas);
  
  /*Début aetoile*/

  tas.insertion_tas(x1,y1); /*On insère le premier sommet dans le tas*/
  tas.tab_pred[x1][y1].x = -1;
  tas.tab_pred[x1][y1].y = -1;
  //console.log("taille :"+tas.taille);
  while ((tas.taille > 0) && tas.tab_pred[x2][y2].x == 0 && tas.tab_pred[x2][y2].y == 0 && entourage != 0)  /*Tant que le tas n'est pas vide et que le sommet de sortie n'a pas de prédécesseur*/
  {
    //console.log("On rentre dans le while");
    tas.extraction_tas(); /*On extraie le sommet de plus petit coût heuristique*/
    sommet = tas.minNode;
    //tas.afficher_node(sommet);
    xs = sommet.coor.x;
    ys = sommet.coor.y;
    tas.tab_visite[xs][ys] = 1;/*On le marque*/

    for (i = -1; i <= 1; ++i)/*On fait défiler ses voisins*/
    {
      for (j = - 1; j <= 1; ++j) 
      {
        //console.log(i+","+j);
        xnew = xs+i*pas;
        ynew = ys+j*pas;
        if (!(i==0 && j == 0) && detection_couleur(context,xnew,ynew,data,width,height))
        {
          //console.log("visite :"+tas.tab_visite[xnew][ynew]);
          if (tas.tab_visite[xnew][ynew] == 0) /*Si on a trouvé un voisin pas encore marqué*/
          {
            //console.log("pas encore marqué");
            tas.calcul_distance(xnew,ynew,x2,y2,choix);/*On calcule les différents coûts ...*/
            tas.recherche_tas(xnew,ynew,xs,ys);/*... et on met à jour le tas*/
          }
          //context.fillStyle = "#E37E33FF";
          //context.fillRect(xs,ys, 2, 2);
        }
      }      
    }
    //tas.afficher_tas();
  }
  //console.log(tas.cout_mini,"ok",tas.cout_choix,"ok",tas.heuri_choix);
  var ctx = canvas.getContext('2d');
  ctx.fillStyle = "#75DDF4"; 
  chemin(x2,y2,x1,y1,tas,ctx);
  //console.log("Et voila :"+tas.tab_pred[534][403].x+"ypred :"+tas.tab_pred[534][403].y);

  
}


/**
 * fonction qui initialise le parcours A*
 * @return rien
 */
function initialisation(){

  //document.getElementById('ima').style.visibility = "hidden";
  console.log(champ_dep.value,champ_arr.value,"oc");

  var type =0;
  var map1 =0;
  var map2 =0;
  var e1 = {};
  var e2 = {};
  var xe1,xe2,xe3,xe4,ye1,ye2,ye3,ye4;
  var img = new Image();
  img.src = "../image/totale.svg";
  img.id = "ima";
  var canvas = document.getElementById('canvas');
  var width = img.width;
  var height = img.height;
  canvas.width =width ;
  canvas.height =height ;
  console.log(width,height);
  var ctx = canvas.getContext('2d');
  ctx.drawImage(img, 0, 0, img.width, img.height);

  var tab1 = champ_dep.value.split(',');
  var tab2 = champ_arr.value.split(",");
  var x1 = Number(tab1[0]);
  var y1 = Number(tab1[1]);
  var x2 = Number(tab2[0]);
  var y2 = Number(tab2[1]);

  var imageDataCopie = ctx.getImageData(0, 0, canvas.width, canvas.height);

  if (!(detection_couleur(ctx,x1,y1,imageDataCopie,canvas.width,canvas.height) && detection_couleur(ctx,x2,y2,imageDataCopie,canvas.width,canvas.height) ))
  {
    console.log("pas de chemin trouvé");
  }
  else
  {
    map1 = detectImage(x1,y1);
    map2 = detectImage(x2,y2);
    console.log(map1,map2);
    if (map1 != map2)
    {
      if ( map1 == 2 && map2 == 0)/*On descend*/
      {
        console.log("On descent 2 vers 0");
        e1 = escalier(x1,y1,2,1);
        xe1 = e1.x1;/*coord entrée étage 2*/
        ye1 = e1.y1;
        xe2 = e1.x0;/*coord sortie étage 1*/
        ye2 = e1.y0;
        e2 = escalier(xe2,ye2,1,0);
        xe3 = e2.x1;/*coord entrée étage 1*/
        ye3 = e2.y1;
        xe4 = e2.x0;/*coord sortie étage O*/
        ye4 = e2.y0; 
      }
      else if(map1 == 0 && map2 == 2)/*On monte*/
      {
        console.log("On monte 0 vers 2");
        e1 = escalier(x2,y2,2,1);
        xe4 = e1.x1;/*coord sortie étage 2*/
        ye4 = e1.y1;
        xe3 = e1.x0;/*coord entrez étage 1*/
        ye3 = e1.y0;
        e2 = escalier(xe3,ye3,1,0);
        xe2 = e2.x1;/*coord sortie étage 1*/
        ye2 = e2.y1;
        xe1 = e2.x0;/*coord entrée étage 0*/ 
        ye1 = e2.y0;     
      }
      
      else if( map1 == 0 && map2 == 1)/*On monte*/
      {
        console.log("On monte 0 vers 1");
        e1 = escalier(x1,y1,map1,map2);
        xe1 = e1.x0;/*coord entrée étage 0 resp(1)*/
        ye1 = e1.y0;
        xe2 = e1.x1;/*coord sortie étage 1 resp(2)*/
        ye2 = e1.y1;
        xe3 = e1.x1;
        ye3 = e1.y1;
        xe4 = e1.x1;
        ye4 = e1.y1;
        
      }
      else if (map1 == 1 && map2 == 2)
      {        
        console.log("On monte 1 vers 2");
        e1 = escalier(x2,y2,map2,map1);
        xe4 = e1.x1;/*coord entrée étage 0 resp(1)*/
        ye4 = e1.y1;
        xe3 = e1.x0;/*coord sortie étage 1 resp(2)*/
        ye3 = e1.y0;
        xe2 = e1.x0;
        ye2 = e1.y0;
        xe1 = e1.x0;
        ye1 = e1.y0;
      }
      else
      {
        console.log("On descent 2 vers 1 ou 1 vers 0");
        e1 = escalier(x1,y1,map1,map2);        
        xe1 = e1.x1;/*coord sortie étage 1 resp(2)*/
        ye1 = e1.y1;
        xe2 = e1.x0;/*coord entrée étage 0 resp(1)*/
        ye2 = e1.y0;
        xe3 = e1.x0;
        ye3 = e1.y0;
        xe4 = e1.x0;
        ye4 = e1.y0;
        
      }

      //console.log("xe1 :",xe1,"ye1 :",ye1,"xe2 :",xe2,"ye2 :",ye2,"xe3 :",xe3,"ye3 :",ye3,"xe4 :",xe4,"ye4 :",ye4);
      a_etoile(type,800,ctx,imageDataCopie,width,height,x1,y1,xe1,ye1);
      a_etoile(type,800,ctx,imageDataCopie,width,height,xe2,ye2,xe3,ye3);
      a_etoile(type,800,ctx,imageDataCopie,width,height,xe4,ye4,x2,y2);
    }
    else
    {
      a_etoile(type,800,ctx,imageDataCopie,width,height,x1,y1,x2,y2);
    }
    context.beginPath();
    context.arc(x2, y2, 6, 0, 2 * Math.PI, false);
    context.fillStyle = 'white';
    context.fill();
    context.lineWidth = 2;
    context.strokeStyle = 'black';
    context.stroke();
    context.beginPath();
    context.arc(x2, y2, 2, 0, 2 * Math.PI, false);
    context.fillStyle = 'black';
    context.fill();

    context.drawImage(logo, x2-9, y2-24,logo.width/10, logo.height/10);

    context.beginPath();
    context.arc(x1, y1, 6, 0, 2 * Math.PI, false);
    context.fillStyle = 'white';
    context.fill();
    context.lineWidth = 3;
    context.strokeStyle = 'black';
    context.stroke();

  }
}
