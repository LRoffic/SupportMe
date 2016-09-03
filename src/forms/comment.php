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

hook_action("Form_Comment");

$comment = new FormBuilder();

$comment->add("comment", "textarea")
	->inputClass("form-control")
	->rows(5)
	->disableLabels()
	->autofocus();

$comment->style("#comment");

hook_filter("comment", $comment);

$comment->submit($lang['ticket']['submit'])->submitStyle('.btn btn-info btn-block btn-lg');

if($comment->sent()){
	if($comment->isValid()){
		if($session->isLogged()){
			if(!empty($match["params"]["id"])){
				$ticket = ORM::for_table("ticket")->find_one($match["params"]["id"]);
				if(!empty($ticket)){
					$status = getStatus($ticket->status_id);

					if(!$status['close'] || $permission->comment_closed_ticket){
						$newcomment = ORM::for_table("comments")->create();
						$newcomment->autor_id = $_SESSION['id'];
						$newcomment->ticket_id = $ticket->id;
						$newcomment->date_reply = time();
						$newcomment->comment = $_POST["comment"];
						$newcomment->save();

						$ticket->date_last_action = time();
						$ticket->status_id = 1;
						$ticket->save();

						$comment->clearFields();

						$tpl->assign("retour", $lang['ticket']['SuccessComment']);
					}
				}
			}
		}
	}
}