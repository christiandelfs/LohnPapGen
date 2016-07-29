<?php

namespace Services;

/**
* Klasse Lohnsteuer
*
* @author     Christian Delfs
*/

class Lohnsteuer {

	public static function getInstance() {
		return getInstance(null);
	}

	public static function getInstance($name) {

		if (name != null) {

			return new $name();
			
		}

		return null;
	}
}

?>