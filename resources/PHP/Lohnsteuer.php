<?php

namespace Kununu\Services;

/**
* Klasse Lohnsteuer
*
* @author     Christian Delfs
* @copyright  kununu GmbH
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