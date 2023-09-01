var FibonacciHeap = function (nb_noeud) {
  this.minNode = undefined;
  this.size = 0;
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

FibonacciHeap.prototype.calcul_distance = function(x1,y1, x2,y2,choix_heuristique)
{
  this.cout_choix = this.cout_mini + 1 ;
  if (choix_heuristique == 1) /* Si parcours en largeur*/
  {
    this.heuri_choix = 0;
  }
  else /*Si A * */
  {
    this.heuri_choix = Math.sqrt(Math.abs(x1 - x2)*Math.abs(x1 - x2) + Math.abs(y1 - y2)*Math.abs(y1 - y2));
  }
};

FibonacciHeap.prototype.insertion_tas = function(x,y)
{   
  //console.log("Ajout :");
  var largeur = this.size;
  var poids = this.heuri_choix + this.cout_choix;
  //console.log("cout_heuri : "+poids+"\n"+"largeur : "+largeur);

  this.size +=1;
  var ind_courant = Math.floor((largeur-1)/2);
  while (largeur > 0 && this.fp[ind_courant].cout_heuri >= poids)/*Tant que le noeud à remonter est plus petit que son père on le remonte*/
  {
    ind_courant = Math.floor((largeur-1)/2);
    this.fp[largeur] = this.fp[ind_courant];
    largeur = Math.floor((largeur-1)/2);
  }
  //console.log("x : "+x+"\n"+"y : "+y);

  var node = new Node(x,y,this.cout_choix,this.heuri_choix);
  //console.log("suite ... x : "+node.coor.x+"\n"+"y : "+node.coor.y);
  //console.log("largeur :"+largeur);
  this.fp[largeur] = node;
};


FibonacciHeap.prototype.extraction_tas = function()
{

  this.minNode = (this.fp[0]); /*On enlève le dernier noeud du tas et on le met à la place du premier que l'on retire du tas*/
  this.cout_mini = (this.fp[0]).cout; 

  var v = this.fp[this.size-1].cout_heuri;
  var ancien = this.size-1;

  this.fp[0] = this.fp[this.size-1];
  this.size --;

  var i = 0;

  while (2*i+1 < this.size)/*Tant que le père est plus petit que l'un de ses deux fils */
  {
    var j = 2*i+1;
    if ( (j +1 < this.size) && ( this.fp[j+1].cout_heuri < this.fp[j].cout_heuri) )/*Si l'un des deux fils est plus petit*/
    {
      j++;
    } 
    if ( v < this.fp[j].cout_heuri)/*Si le père est plus petit qu ses deux fils*/
      break;

    this.fp[i] = this.fp[j];
    i = j;           
  }

  this.fp[i] = this.fp[ancien];/*On place l'ancienne racine à sa nouvelle place*/
};


FibonacciHeap.prototype.modification_tas = function(pos_fils)
{
  var largeur = pos_fils;
  var ret = this.fp[largeur];
  var poids = this.fp[largeur].cout_heuri;

  var ind_courant = Math.floor((largeur-1)/2);
  while (largeur > 0 && this.fp[ind_courant].cout_heuri >= poids)/*Tant que le noeud à remonter est plus petit que son père on le remonte*/
  {     
    ind_courant = Math.floor((largeur-1)/2);
    this.fp[largeur] = this.fp[ind_courant];
    largeur = Math.floor((largeur-1)/2);
  }

  (this.fp[largeur]) = ret;
};


FibonacciHeap.prototype.recherche_tas = function(x,y,xp,yp)
{
  var suc_pot = x+','+y;
  var present = 0;
  var ind_courant = this.fp.map(function(e){ return e.valeur;}).indexOf(suc_pot);
  //console.log("ind_courant rec :"+ind_courant);
  if (ind_courant != -1) /*Si le noeud est déjà présent dans le tas ...*/
  {
    //console.log("deja pres :");
    if ( (this.fp[ind_courant]).cout >= this.cout_choix)/*... et si il a un cout plus petit*/
    {
      /*On met à jour*/
      //console.log("cout quasi meme :"+(this.fp[ind_courant]).cout+"et"+cout);
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


FibonacciHeap.prototype.afficher_tas = function()
{
  var i;
  console.log("Debut affichage tas avec cout mini :"+this.cout_mini);
  for (i = 0; i < this.size; ++i)
  {
    var node = this.fp[i];
    console.log('x: ' + node.coor.x, ', y: ' + node.coor.y+ ', cout: ' + node.cout + ', heuri: ' + node.heuri + ', cout_heuri: ' + node.cout_heuri);
  }
  console.log("\n");
  console.log("Fin affichage tas");
};

FibonacciHeap.prototype.afficher_node = function(node)
{
  var i;
  console.log('x: ' + node.coor.x, ', y: ' + node.coor.y+ ', cout: ' + node.cout + ', heuri: ' + node.heuri + ', cout_heuri: ' + node.cout_heuri);
};


function Node(x,y,cout,heuri) {
  this.valeur = x+","+y;
  this.coor = {x:x,y:y};
  this.cout = cout;
  this.heuri = heuri;
  this.cout_heuri = cout + heuri;
}

function detection_couleur(context,x,y,copieData,width,height)
{
  //console.log("Noeud couleur: "+x+","+y);
  
  //console.log(imageDataCopie.data[((394 * (1052 * 4)) + (93 * 4)) + 0]);
  R = copieData.data[((y * (width * 4)) + (x * 4)) + 0];
  G = copieData.data[((y * (width * 4)) + (x * 4)) + 1];
  B = copieData.data[((y * (width * 4)) + (x * 4)) + 2];
  //console.log('R1: '+R+'G2: '+G+'B2: '+B);

  /*var imageData = context.getImageData(x,y, 1,1).data;
  //console.log("width:"+width);
  R = imageData[0];
  G = imageData[1];
  B = imageData[2];
  console.log('R2: '+R+'G2: '+G+'B2: '+B);*/

  if(R == 178 && G==178 && B==178)
  {
    return 1;
  }
  
  else{
    return 0;
  }
}

function chemin(x2,y2,x1,y1,tas,ctx)
{ 
  console.log("lala x : "+tas.tab_pred[x1][y1].x+"y : "+tas.tab_pred[x1][y1].y);  
  var solx = x2;
  var soly = y2;
  var x = x2;
  var y = y2;
  var i =0;
  console.log("x : "+solx+"y : "+soly);

  while((x!=x1 || y!=y1) && i<500){
    solx = tas.tab_pred[x][y].x;
    soly = tas.tab_pred[x][y].y;
    x = solx;
    y = soly;
    console.log("x : "+x+"y : "+y);
    ctx.beginPath();
    ctx.arc(x, y,5, 0, 2 * Math.PI, false);
    ctx.fillStyle = '#E37E33FF';
    ctx.fill();
    ctx.lineWidth = 2;
    ctx.strokeStyle = '#A52771';
    ctx.stroke();
    i++;
  }
  console.log(i);
  
}

function estPaire(x)
{
  if (x%10 != 0)
  {
    x=x-x%10;

    return x;
  }
  return x;
}

function detectImage(x,y)
{
  if(y >= 510 &&  y<= 1150 && x >= 694 && x <= 1226)
  {
    return 1;
  }
  else if(y>= 467 && y<= 394 && x >= 913 &&  x <= 1525 )
  {
    return 0;
  }
  else
  {
    console.log("lllaaaaaaaaaaaaaaaa");
    return 2;
  }
}

function escalier(x,y,map1,map2)
{
  var chem1;
  var chem2;
  var chem3;
  var excalier0={x0:0,y0:0,x1:0,y1:0};
  var excalier1={x0:1240,y0:180,x1:880,y1:590};
  var excalier2={x0:1300,y0:180,x1:1090,y1:590};
  var excalier3={x0:880,y0:610,x1:240,y1:260};
  var excalier4={x0:1090,y0:610,x1:400,y1:260};
  var excalier5={x0:1090,y0:610,x1:590,y1:260};


  if ((map1 == 0 && map2 == 1) || (map1 == 1 && map2  == 0)){
    console.log("cas 1");
    esc1 = excalier1;
    esc2 = excalier2;
    esc3 = excalier0;
  }
  else{
    console.log("cas 2");
    esc1 = excalier3;
    esc2 = excalier4;
    esc3 = excalier5;
  }

  if (map1 == 0 || (map1 == 1 && map2  == 2))
  {

    chem1 = Math.sqrt(Math.pow(Math.abs(x - esc1.x0),2) + Math.pow( Math.abs(y - esc1.y0),2));
    chem2 = Math.sqrt(Math.pow(Math.abs(x - esc2.x0),2) + Math.pow( Math.abs(y - esc2.y0),2));
    chem3 = Math.sqrt(Math.pow(Math.abs(x - esc3.x0),2) + Math.pow( Math.abs(y - esc3.y0),2));
  }
  else
  {
    chem1 = Math.sqrt(Math.pow(Math.abs(x - esc1.x1),2) + Math.pow( Math.abs(y - esc1.y1),2));
    chem2 = Math.sqrt(Math.pow(Math.abs(x - esc2.x1),2) + Math.pow( Math.abs(y - esc2.y1),2));
    chem3 = Math.sqrt(Math.pow(Math.abs(x - esc3.x1),2) + Math.pow( Math.abs(y - esc3.y1),2));
  }
  console.log("chem com :",chem1,chem2,chem3);

  if (chem1 >= chem2) {
    if (chem3 >= chem2) {
      console.log("escalier 2 choisi");
      return esc2;
    }
    else
    {
      console.log("escalier 3 choisi");
      return esc3;
    }

  }
  else
  {
    if (chem3 >= chem1) {
      console.log("escalier 1 choisi");
      return esc1;
    }
    else
    {
      console.log("escalier 3 choisi");
      return esc3;
    }
  }


}


function a_etoile(choix,nb_noeud,context,data,width,height,xa,ya,xb,yb)
{
  console.log("ini image ok");

  /*Initialisation données*/
  
  var tas = new FibonacciHeap(nb_noeud);
  console.log("ini tas ok");
  var i;
  var suc_pot = {};
  var entourage=-1;

  var x1 = estPaire(xa);
  var y1 = estPaire(ya);
  var xnew = 0;
  var ynew = 0;
  var heuri=0;
  var cout=0;
  var x2 = estPaire(xb);
  var y2 = estPaire(yb);
  /*Début aetoile*/

  tas.insertion_tas(x1,y1); /*On insère le premier sommet dans le tas*/
  tas.tab_pred[x1][y1].x = -1;
  tas.tab_pred[x1][y1].y = -1;
  console.log("taille :"+tas.size);
  while ((tas.size > 0) && tas.tab_pred[x2][y2].x == 0 && tas.tab_pred[x2][y2].y == 0 && entourage != 0)  /*Tant que le tas n'est pas vide et que le sommet de sortie n'a pas de predecesseur*/
  {
    //console.log("On rentre dans le while");
    tas.extraction_tas(); /*On extraie le sommet de plus petit cout heuristique*/
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
        xnew = xs+i*10;
        ynew = ys+j*10;
        if (!(i==0 && j == 0) && detection_couleur(context,xnew,ynew,data,width,height))
        {
          //console.log("visite :"+tas.tab_visite[xnew][ynew]);
          if (tas.tab_visite[xnew][ynew] == 0) /*Si on a trouvé un voisin pas encore marqué*/
          {
            //console.log("pas encore marqué");
            tas.calcul_distance(xnew,ynew,x2,y2,choix);/*On calcule les différents coûts ...*/
            tas.recherche_tas(xnew,ynew,xs,ys);/*... et on met à jour le tas*/
          }

        }
        //context.fillStyle = "#E37E33FF";
        //context.fillRect(xs,ys, 2, 2);
        //tas.afficher_tas();
      }
    }
  }

  var ctx = canvas.getContext('2d');
  ctx.fillStyle = "#FF0000"; 
  chemin(x2,y2,x1,y1,tas,ctx);
  console.log("Et voila :"+tas.tab_pred[534][403].x+"ypred :"+tas.tab_pred[534][403].y);

  
}


function initialisation(a,b){

  //document.getElementById('ima').style.visibility = "hidden";
  console.log(champ_dep.value,champ_arr.value,"coc",width,height);

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
      if ( map1 == 2 && map2 == 0)/*On descent*/
      {
        console.log("On descent");
        e1 = escalier(x1,y1,2,1);
        xe1 = e1.x1;/*coord entree etage 2*/
        ye1 = e1.y1;
        e2 = escalier(x2,y2,0,1);
        xe4 = e2.x0;/*coord sortie etage O*/
        ye4 = e2.y0;

        xe2 = e1.x0;/*coord sortie etage 1*/
        ye2 = e1.y0;
        xe3 = e2.x1;/*coord entree etage 1*/
        ye3 = e2.y1;
      }
      else if(map1 == 0 && map2 == 2)/*On monte*/
      {
        console.log("On monte");
        e1 = escalier(x1,y1,0,1);
        xe1 = e1.x0;/*coord entree etage 0*/
        ye1 = e1.y0;
        e2 = escalier(x2,y2,2,1);
        xe4 = e2.x1;/*coord sortie etage 2*/
        ye4 = e2.y1;

        xe2 = e1.x1;/*coord sortie etage 1*/
        ye2 = e1.y1;
        xe3 = e2.x0;/*coord entree etage 1*/
        ye3 = e2.y0;
      }
      
      else if( (map1 == 0 && map2 == 1) || (map1 == 1 && map2 == 2))/*On monte*/
      {
        e1 = escalier(x2,y2,map2,map1);
        xe4 = e1.x1;/*coord entree etage 0 resp(1)*/
        ye4 = e1.y1;
        xe2 = e1.x1;/*coord sortie etage 1 resp(2)*/
        ye2 = e1.y1;
        xe3 = e1.x1;
        ye3 = e1.y1;
        xe1 = e1.x0;
        ye1 = e1.y0;
      }
      else
      {
        e1 = escalier(x2,y2,map2,map1);
        xe4 = e1.x0;/*coord entree etage 0 resp(1)*/
        ye4 = e1.y0;
        xe2 = e1.x0;/*coord sortie etage 1 resp(2)*/
        ye2 = e1.y0;
        xe3 = e1.x0;
        ye3 = e1.y0;
        xe1 = e1.x1;
        ye1 = e1.y1;
      }

      console.log("xe1 :",xe1,"ye1 :",ye1,"xe2 :",xe2,"ye2 :",ye2,"xe3 :",xe3,"ye3 :",ye3,"xe4 :",xe4,"ye4 :",ye4);
      a_etoile(0,800,ctx,imageDataCopie,width,height,x1,y1,xe1,ye1);
      a_etoile(0,800,ctx,imageDataCopie,width,height,xe2,ye2,xe3,ye3);
      a_etoile(0,800,ctx,imageDataCopie,width,height,xe4,ye4,x2,y2);
    }
    else
    {
      a_etoile(0,800,ctx,imageDataCopie,width,height,x1,y1,x2,y2);
    }

    
  }

  

//console.log(imageDataCopie.data[((400 * (1052 * 4)) + (400 * 4)) + 0]);
//console.log(imageDataCopie.data[((400 * (1052 * 4)) + (400 * 4)) + 1]);
//console.log(imageDataCopie.data[((400 * (1052 * 4)) + (400 * 4)) + 2]);
}








