<?php

class ConectionBD {
	private static $instance;
	private $pdo;

	protected function __construct() {
		$this->pdo = new PDO('mysql:host=' . HOST . ';dbname=' . DB, USER, PASSWORD);
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->pdo->exec('SET NAMES "utf8"');
	}

	protected function __clone() { }

	public function __wakeup()	{
		throw new \Exception("Cannot unserialize a singleton.");
	}

	public static function getInstance() {
		if (!isset(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function prepareExecute($sqlQuery, $params = null) {
		try {
			$s = $this->pdo->prepare($sqlQuery);
			$s->execute($params);
			return $s;
		} catch (PDOException $e) {
			exit(json_encode(['error' => $e->getMessage()]));
		}
	}
}
