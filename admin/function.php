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
<?php
	include_once './database.php';

	function random_str($length = 1) //fonction générant une chaîne de caractère
		{
			$chars = array("A", "a", "B", "b", "C", "c", "D", "d", "E", "e", "F", "f", "G", "g", "H", "h", "I", "i", "J", "j", "K", "k", "L", "l", "M", "m", "N", "n", "O", "o", "P", "p", "Q", "q", "R", "r", "S", "s", "T", "t", "U", "u", "V", "v", "W", "w", "X", "x", "Y", "y", "Z", "z", 0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
			$str = '';
			for ($i=0;$i<$length;$i++) 
				{
					$str .= $chars[mt_rand(0,count($chars) - 1)];
				}
			return $str;
		}

	function getPerm($id)
		{
			global $bdd;

			if(empty($id))
				$thisid="1";
			else
				$thisid=$id;

			$getperm = $bdd->prepare("SELECT * FROM permissions WHERE id = ?");
			$getperm->execute(array($thisid));
			$perm = $getperm->fetch();

			return $perm;
		}

	function getMail($id)
		{
			global $bdd;
			global $siteconfig;

			if(empty($id))
				$thisid="1";
			else
				$thisid=$id;

			$getmail = $bdd->prepare("SELECT * FROM users WHERE id = ?");
			$getmail->execute(array($thisid));
			$mail = $getmail->fetch();

			return $mail['email'];
		}

	function connexion($pseudo, $password)
		{
			global $bdd;

			$co = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
			$co->execute(array($pseudo));
			$info = $co->fetch();

			if($co->rowCount() > 0)
				{
					if(password_verify($password, $info['password']))
						{
							$perm = getPerm($info['permission']);

							$_SESSION['id'] = $info['id'];
							$_SESSION['pseudo'] = htmlspecialchars($info['pseudo']);
							$_SESSION['token'] = random_str(15);

							if($perm['accessAdmin'] == '1')
								{
									header('Location: ./index.php');
									exit();
								}
							else
								{
									header('Location: ./connexion.php?erreur=noaccess');
									exit();
								}
						}
					else
						{
							header('Location: ./connexion.php?erreur=badpass');
							exit();
						}
				}
			else
				{
					header('Location: ./connexion.php?erreur=notexist');
					exit();
				}
		}

	function notinstall()
		{
			$contenuconfig=file_get_contents("../config.php");
			if(file_exists("../install/index.php") && empty($contenuconfig))
				return true;
			else
				return false;
		}
		
	function update_sql() {
		global $bdd;
		
		if(file_exists('./sql/update.sql')){
			$bdd->query(file_get_contents('./sql/update.sql'));
			
			//unlink('./sql/update.sql');
			
			return true;
		} else {
			return false;
		}
	}

	function delete_folder($directory, $empty = false) 
		{
			if(substr($directory,-1) == "/") {
				$directory = substr($directory,0,-1);
			}

			if(!file_exists($directory) || !is_dir($directory)) {
				return false;
			} elseif(!is_readable($directory)) {
				return false;
			} else {
				$directoryHandle = opendir($directory);

				while ($contents = readdir($directoryHandle)) {
					if($contents != '.' && $contents != '..') {
						$path = $directory . "/" . $contents;

						if(is_dir($path)) {
							supprimer_dossier($path);
						} else {
							unlink($path);
						}
					}
				}

				closedir($directoryHandle);

				if($empty == false) {
					if(!rmdir($directory)) {
						return false;
					}
				}

				return true;
			}
		}

	function verifToken($token)
		{
			if(!empty($_SESSION['token']) && !empty($token) && $_SESSION['token'] == $token)
				return true;
			else
				return false;
		}

	function sendmail($to, $sujet, $messageText, $messageHTML)
		{
			global $bdd;
			global $siteconfig;

			$stconfig = $bdd->query("SELECT * FROM config WHERE id = 1");
			$siteconfig = $stconfig->fetch();

			include_once "../FastMailBuilder.php";

			$mail = new FastMailBuilder();//envoie de mail grâce à fastmailbuilder de cfillion ( http://cfillion.tk )
			$mail->subject($sujet)
			->from('support '.$siteconfig['sitename'],$siteconfig['sitemail'])
			->to($to)
			->replyTo($siteconfig['sitemail'])
			->text($messageText)
			->html($messageHTML)
			->send();
		}

	function getAuteurName($auteur)
		{
			global $bdd;

			if(is_numeric($auteur))
				{
					$getusername=$bdd->prepare('SELECT * FROM users WHERE id = :id');
					$getusername->execute(array('id'=>$auteur));
					$username=$getusername->fetch();
					return htmlspecialchars($username['pseudo']);
				}
			else
				return htmlspecialchars($auteur);
		}

	function getCategorieName($categorie)
		{
			global $bdd;
			
			$cat = $bdd->prepare('SELECT * FROM categories WHERE id = ?');
			$cat->execute(array($categorie));
			$catname=$cat->fetch();
			return htmlspecialchars($catname['nom']);
		}