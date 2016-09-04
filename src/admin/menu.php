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

use \VisualAppeal\AutoUpdate;

$update = new AutoUpdate(__DIR__ . '/temp', __DIR__ . '/../', 60);
$update->setCurrentVersion(VERSION);
$update->setUpdateUrl('http://supportme.dzv.me/update'); //Replace with your server update directory
$update->setInstallDir(_PATH_);

if ($update->checkUpdate() === false)
	$tpl->assign("error", $lang['admin']["notCheckUpdate"]);

if ($update->newVersionAvailable()) {
	$tpl->assign("newUpdate", true);
	$tpl->assign("LastVersion",  $update->getLatestVersion());
}

$update->addLogHandler(new Monolog\Handler\StreamHandler(__DIR__ . '/update.log'));
$update->setCache(new Desarrolla2\Cache\Adapter\File(__DIR__ . '/cache'), 3600);

$tpl->assign("token", $_SESSION['token']);