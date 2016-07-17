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

include_once "menu.php";

if($config['connexion_mandatory']){
	hook_action("connexion");
	$tpl->display("connexion.tpl");
	exit();
}

hook_action("new");

include_once "forms/newTicket.php";

$tpl->assign("newTicket", $newTicket);

if($newTicket->sent()){
	if($newTicket->isValid()){
		$newTicket->clearFields();

		if(!$config['connexion_mandatory']){
			if(empty($_SESSION['email']['email']) || empty($_SESSION['email']['token'])){
				$verif_email_exist = ORM::for_table('users')->where("email", $_POST['email'])->find_one();
				if(empty($verif_exist)){
					$pass = \utilphp\util::random_string(8);

					$email = ORM::for_table("users")->create();
					$email->email = $_POST['email'];
					$email->email_password = sha1($pass);
					$email->ip = \utilphp\util::get_client_ip();
					$email->last_active = time();

					hook_filter("new_user_email",$email);

					$email->save();

					$_SESSION['email']['email'] = $email->email;
					$_SESSION['email']['token'] = \utilphp\util::random_string(16);

					register_filter("%email_password%", $pass);

					$mail = new FastMailBuilder();
					$mail->to($email->email)
					->from($config['site_name'], $config['site_email'])
					->subject($lang['email']['createPassSubject'])
					->text($lang['email']['createPass'])
					->send();
				}
			}
		}

		$ticket = ORM::for_table("ticket")->create();
		
		if(!$config['connexion_mandatory'])
			$ticket->autor = $_POST['email'];

		$ticket->autor_ip = \utilphp\util::get_client_ip();
		$ticket->subject = $_POST['subject'];
		$ticket->date_receive = time();
		$ticket->date_last_action = time();
		$ticket->category_id = $_POST['category'];
		$ticket->message = $_POST['message'];

		hook_filter("new_ticket", $ticket);

		$ticket->save();

		header("Location: ".$router->generate("ticket", array("id"=>$ticket->id)));
	}
}

$tpl->display("new.tpl");