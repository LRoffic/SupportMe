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

hook_action("Form_Login");

/* Login Form */
$login = new FormBuilder();

$login->add($lang["login"]["identifiant"], "text")->name("identifiant")->inputClass("form-control");
$login->add($lang['login']['password'], "password")->name("password_c")->inputClass("form-control");

hook_filter("login", $login);

$login->submit($lang['login']['login'])->submitStyle('.btn btn-primary btn-block btn-lg');

if($login->sent()){
	if($login->isValid()){
		if(!$session->isLogged()){
			if(!$config->connexion_mandatory)
				$getUser = ORM::for_table("users")->where_any_is([["username"=>$_POST['identifiant']], ["email"=>$_POST['identifiant']]])->find_one();
			else
				$getUser = ORM::for_table("users")->where("username", $_POST['identifiant'])->find_one();

			if(!empty($getUser)){
				function connect(){
					global $getUser;
					global $session;
					global $router;

					$session->setUser($getUser);
					$router->map("GET", "/admin/", "admin/home.php", "admin");
				}

				if(!empty($_POST['keep']))
					$keep = true;
				else
					$keep = false;

				if(empty($getUser->password) && !empty($getUser->email_password)){
					if(sha1($_POST['password_c']) == $getUser->email_password){
						connect();
					} else {
						$tpl->assign("error", $lang['error']['invalide_password']);
					}
				} elseif (!empty($getUser->password) && empty($getUser->email_password)){
					if(sha1($_POST['password_c']) == $getUser->password){
						connect();
					} else {
						$tpl->assign("error", $lang['error']['invalide_password']);
					}
				} else {
					$tpl->assign("error", $lang['error']['empty_user']);
				}
			} else {
				$tpl->assign("error", $lang['error']['empty_user']);
			}
		}
	}
} 

/* End Login Form */

/* Register Form */
$register = new FormBuilder();

$register->add($lang['login']['pseudo'], "text")->name("pseudo")->inputClass("form-control")->validator("specialchars()", $lang['error']['error_specialcars'])->autofocus();
$register->add($lang["login"]['email'],"email")->name("email")->inputClass("form-control")->validator("mailcheck()", $lang['error']['error_email']);
$register->add($lang["login"]["password"], "password")->name("password")->inputClass("form-control");
$register->add($lang["connexion"]["confirme_password"], "password")->name("verif_pass")->inputClass("form-control")->validator('equalTo(password)', $lang["error"]["error_password"]);

hook_filter("register", $register);

if(Recaptcha())
	$register->add($lang['login']['captcha'], "recaptcha")->name("g-recaptcha-response")->value($config['recaptcha_public_key'])->validator("testCaptcha()", "ReCaptcha");

$register->submit($lang['login']['login'])->submitStyle('.btn btn-info btn-block btn-lg');

if($register->sent()){
	if($register->isValid()){
		if(!$session->isLogged()){
			$verif = ORM::for_table('users')->where_any_is([["username"=>$_POST['pseudo']], ["email"=>$_POST['email']]])->find_one();
			if(empty($verif)){
				if($config->register){
					$new_user = ORM::for_table("users")->create();
					$new_user->username = $_POST['pseudo'];
					$new_user->email = $_POST['email'];
					$new_user->password = sha1($_POST['password']);
					$new_user->ip = $_SERVER['REMOTE_ADDR'];
					$new_user->last_active = time();
					$new_user->save();

					$session->setUser($new_user);
				} else {
					$tpl->assign("error", $lang['error']['register_no_actif']);
				}
			} else {
				$tpl->assign("error", $lang['error']['registered']);
			}
		}
	}
}
/* End Register Form */