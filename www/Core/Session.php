<?php

namespace App\Core;

class Session
{
	public static function add($name, $value) {
		if (session_status() == PHP_SESSION_DISABLED) { session_start(); }
		$_SESSION[$name] = $value;
	}

	public static function addMessage($name, $text, $type) {
		$_SESSION["messages"][] = [$name => [
			["text" => $text, "type" => $type]
		]];
	}

	public static function delete($name) {
		$_SESSION[$name] = null;
	}

	public static function get($name) {
		return $_SESSION[$name];
	}

	public static function exist($name) {
		return isset($_SESSION[$name]);
	}
}