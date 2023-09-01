<?php
/**
 * @file table.php
 * 
 * Ce fichier contient l'affichage de l'emploi de temps de la semaine courante et selon les réservations de l'utilisateur                                          
 * 
 */
include "vue.php";
include "config.php";
?>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"/>
	<link rel="stylesheet" href="style/table.css"/>
	<link rel="stylesheet" href="style/style_menu.css"/>
	<title>
		MappIIE - Emploi du temps
	</title>
</head>

<body>

	<?php
	$groupe="";
	if (isset($_SESSION['user']))
	{
		$id_pers=$_SESSION['id'];
		$res=$connection->query("SELECT id_groupe FROM personne,eleve WHERE id_eleve=id_personne AND id_personne='$id_pers' ");
		$res->setFetchMode(PDO::FETCH_OBJ);
		$nb=$res->rowCount();
		$ligne = $res->fetch();
		if($nb!=0)
		{
			$groupe=$ligne->id_groupe;
			$res->closeCursor();

		}

	}
	else
	{
		$groupe = $_POST['groupe'];
	}
	create_nav();
	echo "<p>Ton groupe:".$groupe."</p>";
	?>

	<div class="centre">

		<div>
			<!--<table>-->
				<?php 
				function test_input($data) {
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;
				}

				
				$d=date('w');
				$c=0;
				if ($d==1)
				{
					$lundi=date('l j F');
					$lundi2=date('Y\-m\-d');
					$c++;
				}
				else
				{
					$lundi=date('l j F',strtotime(' last monday'));
					$lundi2=date('Y\-m\-d',strtotime(' last monday'));
				}
				if ($d==2)
				{
					$mardi=date('l j F');
					$mardi2=date('Y\-m\-d');
					$c++;
				}
				else
				{
					if ($c>0)
					{
						$mardi=date('l j F',strtotime('  tuesday'));
						$mardi2=date('Y\-m\-d',strtotime('  tuesday'));
					}
					else
					{
						$mardi=date('l j F',strtotime(' last tuesday'));
						$mardi2=date('Y\-m\-d',strtotime(' last tuesday'));
					}
				}
				if ($d==3)
				{
					$mercredi=date('l j F');
					$mercredi2=date('Y\-m\-d');
					$c++;
				}
				else
				{
					if ($c>0)
					{
						$mercredi=date('l j F',strtotime('  wednesday'));
						$mercredi2=date('Y\-m\-d',strtotime('  wednesday'));
					}
					else
					{
						$mercredi=date('l j F',strtotime(' last wednesday'));
						$mercredi2=date('Y\-m\-d',strtotime(' last wednesday'));
					}
				}
				if ($d==4)
				{
					$jeudi=date('l j F');
					$jeudi2=date('Y\-m\-d');
					$c++;
				}
				else
				{

					if ($c>0)
					{
						$jeudi=date('l j F',strtotime(' thursday'));
						$jeudi2=date('Y\-m\-d',strtotime(' thursday'));
					}
					else
					{
						$jeudi=date('l j F',strtotime(' last thursday'));
						$jeudi2=date('Y\-m\-d',strtotime(' last thursday'));
					}
				}
				if ($d==5)
				{
					$vendredi=date('l j F');
					$vendredi2=date('Y\-m\-d');
					$c++;
				}
				else
				{
					if ($c>0)
					{
						$vendredi=date('l j F',strtotime(' friday'));
						$vendredi2=date('Y\-m\-d',strtotime(' friday'));
					}
					else
					{
						$vendredi=date('l j F',strtotime(' last friday'));
						$vendredi2=date('Y\-m\-d',strtotime(' last friday'));
					}
				}
				if ($d==6)
				{
					$samedi=date('l j F');
					$samedi2=date('Y\-m\-d');
					$c++;
				}
				else
				{
					if ($c>0)
					{
						$samedi=date('l j F',strtotime('  saturday'));
						$samedi2=date('Y\-m\-d',strtotime('  saturday'));
					}
					else
					{
						$samedi=date('l j F',strtotime('last saturday'));
						$samedi2=date('Y\-m\-d',strtotime('last saturday'));
					}
				}
				if ($c>0)
				{
					$dimanche=date('l j F',strtotime(' sunday'));
					$dimanche2=date('Y\-m\-d',strtotime(' sunday'));
				}
				else
				{
					$dimanche=date('l j F');
					$dimanche2=date('Y\-m\-d');
				}
				/*echo"<table class='zoom'>";
				echo"<tr>";*/
				echo "<td><table class=' caseprincipal'>";
				echo "<tr><td class='casehead'>Horaires</td>";
				echo "<td class='casehead'>".$lundi."</td>";
				echo "<td class='casehead'>".$mardi."</td>";
				echo "<td class='casehead'>".$mercredi."</td>";
				echo "<td class='casehead'>".$jeudi."</td>";
				echo "<td class='casehead'>".$vendredi."</td>";
				echo "<td class='casehead'>".$samedi."</td>";
				echo "<td class='casehead'>".$dimanche."</td></tr>";


				$i=1;
				$j=1;
				$type="";
				$nom="";
				$salle=0;
				$titre="";
				$tableau=array("9h - 10h45","11h - 12h45","14h - 15h45","16h - 17h45");
				/*Je vais faire un foreach sur un vecteur déf à l'avance*/
				$choix=0;
				for ($i = 1; $i <= 10; $i++) 
				{
					switch ($i){
						case 2 :
						echo "<tr class='taille1'>";
						echo "<td class='pause'></td> "; 
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "</tr>";
						break;
						case 4 :
						echo "<tr class='taille1'>";
						echo "<td class='pause'></td> "; 
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "</tr>";
						break;
						case 9:
						echo "<tr class='taille1'>";
						echo "<td class='vide'></td> "; 
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "</tr>";
						break;
						case 7 :
						echo "<tr class='taille1'>";
						echo "<td class='pause'></td> "; 
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "</tr>";
						break;

						case 5:
						echo "<tr class='taille4' >"; 
						echo "<td class='casehoraire4cours'>Repas</td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "<td ></td> ";
						echo "</tr>";
						break;

						case 10:
						echo "<tr class='taille7'>"; 
						echo"<td >Soirée</td>";

						$table=array("".$lundi2." 18:00:00","".$mardi2." 18:00:00","".$mercredi2." 18:00:00","".$jeudi2." 18:00:00","".$vendredi2." 18:00:00","".$samedi2." 18:00:00","".$dimanche2." 18:00:00");
						$table2=array("".$lundi2."","".$mardi2."","".$mercredi2."","".$jeudi2."","".$vendredi2."","".$samedi2."","".$dimanche2."");
						for ($k=0; $k<=6;$k++)
						{

							$date=$table[$k];
							$date2=$table2[$k];
							$heure="18:00:00";
							$res=$connection->query("SELECT nom,id_salle,type,libelle,description FROM cours,intervention,personne,module,ue WHERE id_personne=id_professeur AND intervention.id_inter = cours.id_inter AND date_inter = '$date' AND module.id_module=intervention.id_module AND module.id_module=ue.id_module");
							$res->setFetchMode(PDO::FETCH_OBJ);
							$nbr=$res->rowCount();/*Pour compter le nombre de trucs chopés*/
							$ligne = $res->fetch();
							if($nbr!=0)
							{
								$nom=$ligne->nom;
								$salle=$ligne->id_salle;
								$type=$ligne->type;
								$titre=$ligne->libelle;
								$lien=$ligne->description;
								$res->closeCursor();/*On ferme le curseur une fois la requete exploitée*/
								echo "<td class='taille7 ".$type."2' >";
								echo "<div class='type'>".$type."</div>";
								echo "<div class='titre'><a class='lien' href=".$lien." target='_blank'><span class='alignement'>".$titre."</span></a></div>";
								echo "<div class='gr'><div class='nom'>".$nom."</div>";
								echo "<div class='salle'>".$salle."</div></div>";
								echo "</td>";
							}
							else
							{
								if (isset($_SESSION['id']))
								{
									$id_pers=$_SESSION['id'];
									$date=$table[$k];
									$res=$connection->query("SELECT nom,id_salle,description FROM reservation AS R,personne AS P WHERE date_reservation='$date' AND P.id_personne='$id_pers' AND R.id_personne=P.id_personne ");
									$res->setFetchMode(PDO::FETCH_OBJ);
									$nbr2=$res->rowCount();
									$ligne = $res->fetch();
									if($nbr2!=0)
									{
										$salle=$ligne->id_salle;
										$nom=$ligne->nom;
										$res->closeCursor();
										$titre=$ligne->description;
										echo "<td class='taille7 soiree' >";
										echo "<div class='type'>PARTY</div>";
										echo "<div class='titre'>".$titre."</div>";
										echo "<div class='gr'><div class='nom'>".$nom."</div>";
										echo "<div class='salle'>".$salle."</div></div>";
										echo "</td>";

									}
									else
									{
										$date=$table[$k];
										$acces='PUBLIC';
										$res=$connection->query("SELECT nom,id_salle,description FROM reservation,personne WHERE personne.id_personne=reservation.id_personne AND date_reservation='$date' AND statut='$acces'");
										$res->setFetchMode(PDO::FETCH_OBJ);
										$nbr2=$res->rowCount();
										$ligne = $res->fetch();
										if($nbr2!=0)
										{
											$salle=$ligne->id_salle;
											$nom=$ligne->nom;
											$titre=$ligne->description;
											$res->closeCursor();
											echo "<td class='taille7 soiree' >";
											echo "<div class='type'>PARTY</div>";
											echo "<div class='titre'>".$titre."</div>";
											echo "<div class='gr'><div class='nom'>".$nom."</div>";
											echo "<div class='salle'>".$salle."</div></div>";
											echo "</td>";

										}
										else
										{
											echo "<td class='taille7 vide2'>";
											echo "<form name='form' method='post' action='reservationviatimetable.php'>";
											echo "<input type='hidden' name='heure' value='".$heure."'/>";
											echo "<input type='hidden' name='date' value='".$date2."'/>";
											echo '<input class="bt btn-primary btn-lg btn-primary btn-block" style="font-family: \'ARIAL_ROUNDED\',arial,sans-serif; font-size: 15px; width: 100px; position: relative; top: 20px; left: 50%; transform: translate(-50%,0)" type="submit" name="submit" value="Réserver"/>
											</form>';
											echo "</td>";
										}
									}
								}
								else
								{
									$date=$table[$k];
									$acces='PUBLIC';
									$res=$connection->query("SELECT nom,id_salle,description FROM reservation,personne WHERE personne.id_personne=reservation.id_personne AND date_reservation='$date' AND statut='$acces'");
									$res->setFetchMode(PDO::FETCH_OBJ);
									$nbr2=$res->rowCount();
									$ligne = $res->fetch();
									if($nbr2!=0)
									{
										$salle=$ligne->id_salle;
										$nom=$ligne->nom;
										$res->closeCursor();
										$titre=$ligne->description;
										echo "<td class='taille7 soiree' >";
										echo "<div class='type'>PARTY</div>";
										echo "<div class='titre'>".$titre."</div>";
										echo "<div class='gr'><div class='nom'>".$nom."</div>";
										echo "<div class='salle'>".$salle."</div></div>";
										echo "</td>";

									}
									else
									{
										echo "<td class='taille7 vide2'>";
										echo "<form name='form' method='post' action='reservationviatimetable.php'>";
										echo "<input type='hidden' name='heure' value='".$heure."'/>";
										echo "<input type='hidden' name='date' value='".$date2."'/>";
										echo '<input class="bt btn-primary btn-lg btn-primary btn-block" style="font-family: \'ARIAL_ROUNDED\',arial,sans-serif; font-size: 15px; width: 100px; position: relative; top: 20px; left: 50%; transform: translate(-50%,0)" type="submit" name="submit" value="Réserver"/>
										</form>';
										echo "</td>";
									}
								}
							}
						}
						echo"</tr>";
						break;

						default:
						$choix=1;
						break;
					}
					if ($choix==1)
					{
						echo "<tr class=' case testalex'>";
						switch($i)
						{
							case 1:
							echo "<td class='casehoraire7cours'><div class='dateup'>9h</div><div class='datedown'> 10h45</div></td>";
							break;

							case 3:
							echo "<td class='casehoraire7cours'><div class='dateup'>11h</div><div class='datedown'>12h45</div></td>";
							break;

							case 6:
							echo "<td class='casehoraire7cours'><div class='dateup'>14h</div><div class='datedown'>15h45</div></td>";
							break;

							case 8:
							echo "<td class='casehoraire7cours'><div class='dateup'>16h</div><div class='datedown'>17h45</div></td>";
							break;
							default:
							echo "<p>merde</p>";
							break;

						}
						for ($j=1; $j<=7;$j++)
						{
							switch($j)
							{
								case 1:
								$day=$lundi2;
								break;
								case 2:
								$day=$mardi2;
								break;
								case 3:
								$day=$mercredi2;
								break;
								case 4:
								$day=$jeudi2;
								break;
								case 5:
								$day=$vendredi2;
								break;
								case 6:
								$day=$samedi2;
								break;
								case 7:
								$day=$dimanche2;
								break;
								default:
								$day="";
								break;
							}
							$res=[];
							switch($i)
							{
								case 1:
								$date = test_input("".$day." 09:00:00");
								$heure="09:00:00";
								break;

								case 3:
								$date = test_input("".$day." 11:00:00");
								$heure="11:00:00";
								break;

								case 6:
								$date = test_input("".$day." 14:00:00");
								$heure="14:00:00";
								break;

								case 8:
								$date = test_input("".$day." 16:00:00");
								$heure="16:00:00";
								break;
								default:
								break;

							};
							$res=$connection->query("SELECT nom,id_salle,type,libelle,description FROM cours,intervention,personne,module,ue WHERE id_personne=id_professeur AND intervention.id_inter = cours.id_inter AND date_inter = '$date' AND id_groupe='$groupe' AND module.id_module=intervention.id_module AND module.id_module=ue.id_module");
							$res->setFetchMode(PDO::FETCH_OBJ);
							$nbr=$res->rowCount();/*Pour compter le nombre de trucs chopés*/
							$ligne = $res->fetch();

							if($nbr!=0)
							{
								$nom=$ligne->nom;
								$salle=$ligne->id_salle;
								$type=$ligne->type;
								$titre=$ligne->libelle;
								$lien=$ligne->description;
								$res->closeCursor();/*On ferme le curseur une fois la requete exploitée*/
								echo "<td class='taille7 ".$type."2' >";
								echo "<div class='type'>".$type."</div>";
								echo "<div class='titre'><a class='lien' href=".$lien." target='_blank'><span class='alignement'>".$titre."</span></a></div>";
								echo "<div class='gr'><div class='nom'>".$nom."</div>";
								echo "<div class='salle'>".$salle."</div></div>";
								echo "</td>";
							}
							else{
								if (isset($_SESSION['id']))
								{
									$id_pers=$_SESSION['id'];
									$res=$connection->query("SELECT nom,id_salle,description FROM reservation AS R,personne AS P WHERE date_reservation='$date' AND P.id_personne='$id_pers' AND R.id_personne=P.id_personne ");
									$res->setFetchMode(PDO::FETCH_OBJ);
									$nbr2=$res->rowCount();
									$ligne = $res->fetch();
									if($nbr2!=0)
									{
										$nom=$ligne->nom;
										$salle=$ligne->id_salle;
										$type="RV";
										$titre=$ligne->description;
										$res->closeCursor();
										echo "<td class='taille7 ".$type."2 '>";
										echo "<div class='type'>".$type."</div>";
										echo "<div class='titre'>".$titre."</div>";
										echo "<div class='gr'><div class='nom'>".$nom."</div>";
										echo "<div class='salle'>".$salle."</div></div>";
										echo "</td>";

									}
									else
									{
										$acces='PUBLIC';
										$res=$connection->query("SELECT nom,id_salle,description FROM reservation,personne WHERE personne.id_personne=reservation.id_personne AND date_reservation='$date' AND statut='$acces'");
										$res->setFetchMode(PDO::FETCH_OBJ);
										$nbr2=$res->rowCount();
										$ligne = $res->fetch();
										if($nbr2!=0)
										{
											$salle=$ligne->id_salle;
											$nom=$ligne->nom;
											$titre=$ligne->description;
											$type="RV";
											$res->closeCursor();
											echo "<td class='taille7 soiree' >";
											echo "<div class='type'>".$type."</div>";
											echo "<div class='titre'>".$titre."</div>";
											echo "<div class='gr'><div class='nom'>".$nom."</div>";
											echo "<div class='salle'>".$salle."</div></div>";
											echo "</td>";

										}
										else
										{
											echo "<td class='taille7 vide2'>";
											echo "<form name='form' method='post' action='reservationviatimetable.php'>";
											echo "<input type='hidden' name='heure' value='".$heure."'/>";
											echo "<input type='hidden' name='date' value='".$day."'/>";
											echo '<input class="bt btn-primary btn-lg btn-primary btn-block" style="font-family: \'ARIAL_ROUNDED\',arial,sans-serif; font-size: 15px; width: 100px; position: relative; top: 20px; left: 50%; transform: translate(-50%,0)" type="submit" name="submit" value="Réserver"/>
											</form>';
											echo "</td>";
										}
									}
								}
								else
								{
									$acces='PUBLIC';
									$res=$connection->query("SELECT nom,id_salle,description FROM reservation,personne WHERE personne.id_personne=reservation.id_personne AND date_reservation='$date' AND statut='$acces'");
									$res->setFetchMode(PDO::FETCH_OBJ);
									$nbr2=$res->rowCount();
									$ligne = $res->fetch();
									if($nbr2!=0)
									{
										$salle=$ligne->id_salle;
										$nom=$ligne->nom;
										$titre=$ligne->description;
										$type="RV";
										$res->closeCursor();
										echo "<td class='taille7 soiree' >";
										echo "<div class='type'>".$type."</div>";
										echo "<div class='titre'>".$titre."</div>";
										echo "<div class='gr'><div class='nom'>".$nom."</div>";
										echo "<div class='salle'>".$salle."</div></div>";
										echo "</td>";

									}
									else
									{
										echo "<td class='taille7 vide2'>";
										echo "<form name='form' method='post' action='reservationviatimetable.php'>";
										echo "<input type='hidden' name='heure' value='".$heure."'/>";
										echo "<input type='hidden' name='date' value='".$day."'/>";
										echo '<input class="bt btn-primary btn-lg btn-primary btn-block" style="font-family: \'ARIAL_ROUNDED\',arial,sans-serif; font-size: 15px; width: 100px; position: relative; top: 20px; left: 50%; transform: translate(-50%,0)" type="submit" name="submit" value="Réserver"/>
										</form>';
										echo "</td>";
									}
								}
							}
						}
						echo "</tr>"; 
						$choix=0;
					}
				}

				echo "</table>";
				echo "</td>";
				/*echo "</tr>";
				echo "</table>";*/
				?>
				<!--</table>-->
			</div>
		</div>
		<?php
		create_footer();
		?>


	</body>
	</html>