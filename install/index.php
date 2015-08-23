<?php
/*
Copyright (C) 2013 Dubourg Lee-Roy

This file is part of Support Me.

Support Me is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Support Me is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU Lesser General Public License
along with Support Me. If not, see <http://www.gnu.org/licenses/>.
 */
 ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Installation support me</title>
		<meta charset="UTF-8" />

		<link rel="stylesheet" type="text/css" href="install.css">
	</head>

	<body class="wp-core-ui">
		<h1 id="logo"><a href="https://supportme.dzv.me/">Support Me</a></h1>
		<?php

			$step = (isset($_GET['step']))?htmlspecialchars($_GET['step']):'';

			switch($step)
				{
					case "3":
						include_once '../database.php';
						include_once '../function.php';
						include_once '../libs/passwordlib.php';
						include_once '../FastMailBuilder.php';
						if(!empty($_POST['sitename']) && !empty($_POST['pseudo']) && !empty($_POST['email']))
							{
								if(preg_match("!^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$!", $_POST['email']))
									{
										$conf=$bdd->prepare("INSERT INTO config (id, sitename, sitemail, registration, cookie, faq, recaptcha, htaccess, version) VALUES (:id, :sitename, :sitemail, :registration, :cookie, :faq, :recaptcha, :htaccess, :version)");
										$conf->execute(array('id'=>'1', 'sitename'=>$_POST['sitename'], 'sitemail'=>$_POST['email'], 'registration'=>'force', 'cookie'=>'1', 'faq'=>'e', 'recaptcha'=>'d', 'htaccess'=>'d', 'version'=>'2.2'));

										if(!empty($_POST['password']) && !empty($_POST['pass']))
											{
												if($_POST['password'] == $_POST['pass'])
													{
														$pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
													}
												else
													{
														$password = random_str(10);
														$pass = password_hash($password, PASSWORD_BCRYPT);
														$autogener=true;
													}
											}
										else
											{
												$password = random_str(10);
												$pass = password_hash($password, PASSWORD_BCRYPT);
												$autogener=true;
											}

										$us=$bdd->prepare("INSERT INTO users (pseudo, password, email, dateinsc, lastview, permission, ip, protected) VALUES (:ps, :pass, :email, :dateinsc, :last, :perm, :ip, :protected)");
										$us->execute(array('ps'=>$_POST['pseudo'], 'pass'=>$pass, 'email'=>$_POST['email'], 'dateinsc'=>time(), 'last'=>time(), 'perm'=>'4', 'ip'=>$_SERVER['REMOTE_ADDR'], 'protected'=> '1'));
										?>
											<h1>Support Me - Installation finis !</h1>
											<p>Ça y est l'installation de Support Me est terminé ! Merci à toi pour cette installation !</p>
											<?php
												if(isset($autogener) && isset($password))
													echo '<p style="text-align: center;">Ton mot de passe a été généré aléatoirement, car tu as laissé vide le champ ou les deux mots de passe ne correspondent pas. Tu pourras changer ton mot de passe en te connectant sur ton support.<br /> Voici ton mot de passe :<br /><b>'.$password.'</b><br /> Pense à bien le noter !</p>';
											?>
											<p style="color:red">Pensez à supprimer ou renommer le dossier "install" sinon quelqu'un pourrait réinstaller votre support sans votre consentement !</p>
											<p style="text-align:center">
												<a href="../index.php" class="button button-large">Aller sur <?php echo htmlspecialchars($_POST['sitename']) ?></a>
											</p>
										<?php
									}
								else
									{
										header("Location: ./index.php?step=1");
									}
							}
						else
							header("Location: ./index.php?step=1");
					break;

					case "2":
						if(!empty($_POST['dbname']) && !empty($_POST['uname']) && !empty($_POST['dbhost']))
							{
								try
									{
										$bdd = new PDO('mysql:host='.$_POST['dbhost'].';dbname='.$_POST['dbname'], $_POST['uname'], $_POST['pwd'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'", PDO::ATTR_PERSISTENT => true));
										$fichier = "../config.php";
										$contenu = "<?php\n\$config = " . var_export(array(
										  'dbhost'=>$_POST['dbhost'],
										  'dbname'=>$_POST['dbname'],
										  'dbuser'=>$_POST['uname'],
										  'dbpassword'=>$_POST['pwd']
										), true).";";
										file_put_contents($fichier, $contenu);

										$create = $bdd->exec(file_get_contents('bdd.sql'));

										unlink("./bdd.sql");
										?>
											<h1 style="text-align: center">Support Me - Installation presque finis</h1>
											<p>Configuration du support</p>
											<form id="setup" method="post" action="?step=3">
												<table class="form-table">
													<tr>
														<th scope="row"><label for="weblog_title">Nom du site</label></th>
														<td><input name="sitename" required="true" type="text" id="weblog_title" size="25" value="" /></td>
													</tr>
													<tr>
														<th scope="row"><label for="user_login">Pseudo</label></th>
														<td>
															<input name="pseudo" required="true" type="text" id="user_login" size="25" value="" />
														</td>
													</tr>
													<tr>
														<th scope="row">
															<label for="admin_password">Mot de passe, deux fois</label>
															<p>Un mot de passe vous seras généré automatiquement si vous laisser ce champs vide</p>
														</th>
														<td>
															<input name="password" type="password" id="pass1" size="25" value="" />
															<p><input name="pass" type="password" id="pass2" size="25" value="" /></p>
															<p>Astuce: Le mot de passe doit être d'au moins sept caractères. Pour le rendre plus forte, utiliser les majuscules et minuscules, des chiffres et des symboles comme !»?$%^&).</p>
														</td>
													</tr>
													<tr>
														<th scope="row"><label for="admin_email">Votre adresse mail</label></th>
														<td><input name="email" required="true" type="email" id="admin_email" size="25" value="" />
													</tr>
												</table>
												<p class="step"><input type="submit" name="Submit" value="Terminer l'installation" class="button button-large" /></p>
											</form>
										<?php
									}
								catch (Exception $e)
									{
										?>
											<h1 style="text-align: center;">Erreur impossible d'établir une connexion à la base de données</h1>
											<p>Ce qui signifie que soit le nom d'utilisateur et mot de passe dans votre fichier config sont incorrects ou on ne peut pas communiquer avec le serveur de base de données à <?php echo htmlspecialchars($_POST['dbhost']); ?>. Cela pourrait signifier que le serveur de base de données de votre hôte est en panne.</p>
											<ul>
												<li>Etes-vous sûr que vous avez le nom d'utilisateur et mot de passe correct?</li>
     											<li>Etes-vous sûr que vous avez tapé le nom d'hôte correct?</li>
    											<li>Etes-vous sûr que le serveur de base de données est en cours d'exécution?</li>
    										</ul>
										<p>Si vous n'êtes pas sûr de ce que signifient ces termes, vous devriez probablement contacter votre hébergeur. Si vous avez encore besoin d'aide, vous pouvez toujours visiter les forums de soutien.</p>
										<a class="button button-large" onclick="javascript:history.go(-1);return false;" href="?step=1">Réésayer</a>
										<?php
									}
							}
						else
							header("Location: ./index.php?step=1");
					break;

					case "1":
						?>
							<h1 style="text-align:center">Support Me - Base de données</h1>
							<form method="post" action="?step=2">
								<p>Configuration de la base de données</p>
								<table class="form-table">
									<tr>
										<th scope="row"><label for="dbname">Database Name</label></th>
										<td><input name="dbname" id="dbname" type="text" size="25" value="SupportMe" /></td>
										<td>Le nom de la base de données sur laquelle vous souhaitez installer Support Me</td>
									</tr>
									<tr>
										<th scope="row"><label for="uname">User Name</label></th>
										<td><input name="uname" id="uname" type="text" size="25" value="username" /></td>
										<td>Identifiant MySQL (exemple: <code>root</code>)</td>
									</tr>
									<tr>
										<th scope="row"><label for="pwd">Password</label></th>
										<td><input name="pwd" id="pwd" type="text" size="25" value="password" /></td>
										<td>&hellip;et votre mot de passe MySQL.</td>
									</tr>
									<tr>
										<th scope="row"><label for="dbhost">Database Host</label></th>
										<td><input name="dbhost" id="dbhost" type="text" size="25" value="localhost" /></td>
										<td>l'hôte de la base de données (exemple: <code>localhost</code>)</td>
									</tr>
								</table>
									<p class="step"><input name="submit" type="submit" value="Envoyer" class="button button-large" /></p>
							</form>
						<?php
					break;

					default:
						?>
							<h1 style="text-align:center">Support Me - Installation</h1>
							<p>Aucun fichier de configuration n'a été trouvé !</p>
							<p>Support Me n'est donc pas installé ! Souhaiter vous l'installer ?</p>
							<p style="text-align:center">
								<a href="?step=1" class="button button-large">Lancer l'installation</a>
							</p>
						<?php
					break;
				}
		?>
	</body>
</html>