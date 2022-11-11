<?php

	include 'config_BD.php';
	include 'classes/autoload.php';
	include 'functions.php';

	if (isset($_SERVER["CONTENT_TYPE"]) && strtolower($_SERVER["CONTENT_TYPE"]) == 'application/json') {
		header('Content-Type: application/json');
		header("Access-Control-Allow-Origin: *");
		try {
			$data = json_decode(file_get_contents('php://input'), true);
			$result = ['result' => 'ok'];

			/** Создает тендер */
			if (isPostRequest() && isParam('tender')) {
				$result = addTender($data);
			}

			/** Возвращает один тендер */
			if (isGetRequest() && isParam('tender')) {
				$result = getTender($_GET['id']);
			}

			/** Возвращает все тендеры или с фильтрацией по дате или имени */
			if (isGetRequest() && isParam('listTender')) {
				$result = getListTender(['date' => $_GET['date'] ?? false, 'name' => $_GET['name'] ?? false]);
			}
		} catch(Exception $e) {
			$result = $e->getMessage();
		}
		exit(json_encode($result));
	}