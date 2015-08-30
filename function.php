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
	require_once 'database.php';
		
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

	function inscription($email, $pseudo, $password, $verifpass)
		{
			global $bdd;

			if(preg_match("!^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$!", $email))
				{
					$verifexist = $bdd->prepare('SELECT * FROM users WHERE pseudo = :pseudo OR email = :email');
					$verifexist->execute(array('pseudo'=>htmlspecialchars($pseudo), 'email'=>$email));

					if($verifexist->rowCount() == 0)
						{
							if($password == $verifpass)
								{
									$insc = $bdd->prepare('INSERT INTO users (email, pseudo, password, dateinsc, lastview, ip) VALUES (:email, :pseudo, :password, :time, :time, :ip)');
									$insc->execute(array('email'=>$email, 'pseudo'=>htmlspecialchars($pseudo), 'password'=>password_hash($password, PASSWORD_BCRYPT), 'time'=>time(), 'ip'=>$_SERVER['REMOTE_ADDR']));

									$idus = $bdd->prepare('SELECT * FROM users WHERE pseudo = :pseudo AND email = :email');
									$idus->execute(array('pseudo'=>htmlspecialchars($pseudo), 'email'=>$email));
									$idu = $idus->fetch();
									$id = $idu['id'];

									$_SESSION['id'] = $id;
									$_SESSION['pseudo'] = htmlspecialchars($pseudo);
									$_SESSION['token'] = random_str(15);

									return "ok";
								}
							else
								{
									return "invalidPassword";
								}
						}
					else
						{
							return "compteFound";
						}
				}
			else
				{
					return "invalidMail";
				}
		}
	function connexion($pseudo, $password)
		{
			global $bdd;
			global $siteconfig;

			
			$verifexist = $bdd->prepare('SELECT * FROM users WHERE pseudo = :field OR email = :field');
			$verifexist->execute(array('field'=>$pseudo));
			$verifex = $verifexist->rowCount();

			if($verifex == 1)
				{
					$info = $verifexist->fetch();

					if(password_verify($password, $info['password']))
						{
							$_SESSION['id'] = $info['id'];
							$_SESSION['pseudo'] = htmlspecialchars($info['pseudo']);
							$_SESSION['token'] = random_str(15);

							$upd = $bdd->prepare('UPDATE users SET lastview = :last, ip = :ip WHERE id = :id');
							$upd->execute(array('last'=>time(), 'ip'=>$_SERVER['REMOTE_ADDR'], 'id'=>$info['id']));

							if($siteconfig['cookie'] == "1" && isset($_POST['remember']))
								setcookie('auth', $info['id'].'-----'.sha1($info['pseudo'].$info['password'].$_SERVER["REMOTE_ADDR"]), time()+365*24*3600, null, null, false, true);

							return "ok";
						}
					else
						{
							return "password";
						}
				}
			else
				{
					return "notFound";
				}
		}
	
	function notinstall()
		{
			$contenuConfig=file_get_contents("./config.php");
			if(file_exists("./install/index.php") && empty($contenuConfig))
				return true;
			else
				return false;
		}

	function replace_lang($lang){
		global $bdd;

		$getconfig = $bdd->query("SELECT * FROM config WHERE id = '1'");
		$config = $getconfig->fetch();

		$arrayprofil = array(
			'%sitename%' => htmlspecialchars($config['sitename'])
		);

		$string = str_replace(array_keys($arrayprofil), array_values($arrayprofil), $lang);

		return $string;
	}

	function getlangs(){
		$dirname = './lang/';
		$dir = opendir($dirname);
		$fich = array();
		
		while($file = readdir($dir)) {
			if($file != '.' && $file != '..' && !is_dir($dirname.$file))
			{
				$get_content = file_get_contents($dirname.$file);
				$get_name = json_decode($get_content, true);
				$name = $get_name['name'];
				$filename = explode(".", $file);
				$fich[] = array("filename"=>$filename[0], "name"=>$name);
			}
		}
		
		closedir($dir);
		
		return $fich;
	}