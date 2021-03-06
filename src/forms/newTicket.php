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

hook_action("Form_newTicket");

$newTicket = new FormBuilder();

$newTicket->errorTag('div');
$newTicket->errorStyle('.alert alert-danger');

//email input
if(!$config['connexion_mandatory'] && !$session->isLogged())
	$newTicket->add($lang['newTicket']['email'], "email")
	->name("email")
	->inputClass("form-control")
	->validator('mailcheck()', $lang['error']['error_email'])
	->autofocus();

//subject input
$newTicket->add($lang['newTicket']['subject'], "text")
->name("subject")
->inputClass("form-control")
->autofocus();

/* category input */
$newTicket->add($lang['newTicket']["category"], "select")
->name("category")
->inputClass("form-control")
->validator("verif_categorie(self)", $lang['error']['error_category']);

$newTicket->choice($lang['newTicket']['choiceCategory'], "", true);

$getCategory = ORM::for_table("category")->where("published", true)->find_many();
foreach ($getCategory as $category) {
	$newTicket->choice($category['name'], $category['id']);
}
/* end of category input */

// textarea message
$newTicket->add($lang['newTicket']['message'], "textarea")
	->name("message")
	->inputClass("form-control")
	->rows(10)->cols(20);

//recaptcha input
if(Recaptcha())
	$newTicket->add($lang['newTicket']['captcha'], "recaptcha")->name("g-recaptcha-response")->value($config['recaptcha_public_key'])->validator("testCaptcha()", "ReCaptcha");

hook_filter("newTicket", $newTicket);

$newTicket->submit($lang['newTicket']['submit'])->submitStyle('.btn btn-primary btn-block btn-lg');