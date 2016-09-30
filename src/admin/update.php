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

hook_action("admin_update");

use \VisualAppeal\AutoUpdate;

if ($update->newVersionAvailable()) {
	//Install new update
	$result = $update->update();
	if ($result === true) {
		$tpl->assign("update", "true");
	} else {
		if ($result = AutoUpdate::ERROR_SIMULATE) {
			$tpl->assign("Simulation", $update->getSimulationResults());
		}

		$tpl->assign("update", "false");
		$tpl->assign("result", $result);
	}
} else {
	$tpl->assign("upToDate", true);
}

$tpl->assign("log", nl2br(file_get_contents(__DIR__ . '/update.log')));

file_put_contents(__DIR__ . '/update.log', "");

$tpl->display("admin/update.tpl");

