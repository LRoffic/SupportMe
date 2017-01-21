<?php
/*
Copyright (C) 2016  Lee-Roy Dubourg
	
This program is free software: you can redistribute it and/or modify it
under the terms of the GNU General Public License as published by the Free
Software Foundation, either version 3 of the License, or (at your option)
any later version.

This program is distributed in the hope that it will be useful, but WITHOUT
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
more details.

You should have received a copy of the GNU General Public License along
with this program.  If not, see <http://www.gnu.org/licenses/>. 
*/

if(file_exists("../includes/database.php")){
	include "../vendor/autoload.php";
	include "../includes/define.php";
	include "../includes/database.php";
}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Installation de Support Me</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container" style="padding-top: 10%">
			<h1 id="logo"><a href="http://supportme.dzv.me/" title="Support Me" target="_blank"><h1>Support Me</h1></a></h1>
			<div class="well">
				<?php
					$step = (isset($_GET['step']))?htmlspecialchars($_GET['step']):'';

					switch($step){
						default:
							include "templates/default.html";
						break;

						case "1":
							include "templates/step1.html";
						break;

						case "2": 
							//verif du formulaire step1
							if(empty($_POST['host']) || empty($_POST['dbname']) || empty($_POST['dbusername'])){
								echo '<div class="alert alert-danger">Un ou plusieurs champs étaient vides !</div>';
								include "templates/step1.html";
								exit();
							}

							try{
								$bdd = new PDO('mysql:host='.$_POST['host'].';dbname='.$_POST['dbname'], $_POST['dbusername'], $_POST['dbpassword'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
								$bdd->exec(file_get_contents('database.sql'));

								$file = "../includes/database.php";
								$content = "<?php
/*
Copyright (C) 2016  Lee-Roy Dubourg
	
This program is free software: you can redistribute it and/or modify it
under the terms of the GNU General Public License as published by the Free
Software Foundation, either version 3 of the License, or (at your option)
any later version.

This program is distributed in the hope that it will be useful, but WITHOUT
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
more details.

You should have received a copy of the GNU General Public License along
with this program.  If not, see <http://www.gnu.org/licenses/>. 
*/

ORM::configure('mysql:host=".$_POST["host"].";dbname=".$_POST['dbname']."');
ORM::configure('username', '".$_POST['dbusername']."');
ORM::configure('password', '".$_POST['dbpassword']."');

if(DEBUG_MODE){
	ORM::configure('error_mode', PDO::ERRMODE_WARNING);
	ORM::configure('logging', true);
}";
								file_put_contents($file, $content);

								include "templates/step2.html";
							} catch (Exception $e) {
								?>
									<h1 style="text-align: center;">Erreur impossible d'établir une connexion à la base de données</h1>
										<p>Ce qui signifie que soit le nom d'utilisateur et mot de passe dans votre fichier config sont incorrects ou on ne peut pas communiquer avec le serveur de base de données à <?php echo htmlspecialchars($_POST['host']); ?>. Cela pourrait signifier que le serveur de base de données de votre hôte est en panne.</p>
										<ul>
											<li>Etes-vous sûr que vous avez le nom d'utilisateur et mot de passe correct?</li>
													<li>Etes-vous sûr que vous avez tapé le nom d'hôte correct?</li>
												<li>Etes-vous sûr que le serveur de base de données est en cours d'exécution?</li>
											</ul>
									<p>Si vous n'êtes pas sûr de ce que signifient ces termes, vous devriez probablement contacter votre hébergeur. Si vous avez encore besoin d'aide, vous pouvez toujours visiter les forums de soutien.</p>
								<?php

								include "templates/step1.html";
							}
						break;

						case "3": 
							//verif du formulaire step2
							if(empty($_POST['sitename']) || empty($_POST['sitemail'])){
								echo '<div class="alert alert-danger">Un ou plusieurs champs étaient vides !</div>';
								include "templates/step2.html";
								exit();
							}

							$create_config = ORM::for_table("config")->create();
							$create_config->site_name = $_POST['sitename'];
							$create_config->site_email = $_POST['sitemail'];
							$create_config->register = $_POST['register'];
							$create_config->connexion_mandatory = $_POST['connexion_mandatory'];
							$create_config->recaptcha_private_key = $_POST['recaptcha_private_key'];
							$create_config->recaptcha_public_key = $_POST['recaptcha_public_key'];

							$create_config->save();

							//si tout est ok afficher step3
							include "templates/step3.html";
						break;

						case "4":
							//verif du formulaire step3
							if(empty($_POST['username']) || empty($_POST['email'])){
								echo '<div class="alert alert-danger">Un ou plusieurs champs étaient vides !</div>';
								include "templates/step3.html";
								exit();
							}

							if(!preg_match("!^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$!", $_POST['email'])){
								echo '<div class="alert alert-danger">Adresse E-Mail incorrect !</div>';
								include "templates/step3.html";
								exit();
							}

							//fonction générant une chaîne de caractère
							function random_str($length = 1){
								$chars = array("A", "a", "B", "b", "C", "c", "D", "d", "E", "e", "F", "f", "G", "g", "H", "h", "I", "i", "J", "j", "K", "k", "L", "l", "M", "m", "N", "n", "O", "o", "P", "p", "Q", "q", "R", "r", "S", "s", "T", "t", "U", "u", "V", "v", "W", "w", "X", "x", "Y", "y", "Z", "z", 0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
								$str = '';
								for ($i=0;$i<$length;$i++){
									$str .= $chars[mt_rand(0,count($chars) - 1)];
								}
								return $str;
							}

							if(!empty($_POST['password']) && !empty($_POST['verif_password'])){
								if($_POST['password'] != $_POST['verif_password']){
									echo '<div class="alert alert-danger">Les deux mots de passe ne sont pas identiques !</div>';
									include "templates/step3.html";
									exit();
								} else {
									$password = $_POST['password'];
								}
							} else {
								$password = random_str(10);
								echo '<div class="alert alert-info text-center">Votre mot de passe a été généré aléatoirement, car vous avez laissé vide le champ. Vous pourrez changer votre mot de passe en vous connectant sur votre support.<br /> Voici votre mot de passe :<br /><b>'.$password.'</b><br /> Pensez à bien le noter !</div>';
							}

							$create_admin = ORM::for_table("users")->create();
							$create_admin->username = $_POST['username'];
							$create_admin->email = $_POST['email'];
							$create_admin->password = sha1($_POST['password']);
							$create_admin->rank = 3;
							$create_admin->ip = $_SERVER['REMOTE_ADDR'];
							$create_admin->last_active = time();
							$create_admin->save();

							//si tout est ok afficher step4
							include "templates/step4.html";
						break;
					}
				?>
			</div>
		</div>

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</body>
</html>