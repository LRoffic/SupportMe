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

class Session {
	private $user = null;

	function __construct(){
		session_start();

		if(isset($_SESSION['id'])){
			$user = User::GetByID($_SESSION['id']);

			if(!empty($user) && $user)
				$this->user = $user;
			else
				$this->destroy();
		}

		$this->getToken() ?: $this->setToken(self::generateToken());
		$this->bumpUser();
	}

	private static function generateToken(){
		return sha1(uniqid());
	}

	function getToken(){
		if(isset($_SESSION['token']))
			return $_SESSION['token'];
	}

	function setToken($token){
		$_SESSION['token'] = $token;
	}

	function isLogged(){
		return !!$this->user;
	}

	function getUser(){
		return $this->user;
	}

	function bumpUser(){
		if(!$this->isLogged())
			return;

		$this->user->last_active = time();
		$this->user->ip = $_SERVER['REMOTE_ADDR'];
		$this->user->save();
	}

	function setUser($user){
		$_SESSION['id'] = $user->id;
		$this->setToken(self::generateToken());
		$this->user = $user;

		$this->bumpUser();
	}

	function setCookie($name, $value, $lifetime){
		setcookie($name, $value, time() + $lifetime, FOLDER);
	}

	function deleteCookie($name){
		setcookie($name, '', time()-3600, FOLDER);
	}

	function destroy(){
		unset($_SESSION['id']);
		unset($_SESSION['token']);

		session_destroy();
	}

}