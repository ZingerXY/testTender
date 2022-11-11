<?php
	/**
	 * Возвращает тендер по идетификатору
	 */
	function getTender($id) {
		$bd = ConectionBD::getInstance();
		$getTenderQuery = "SELECT id, number, status, name, date FROM tenders WHERE id = :id;";
		$resultQuery = $bd->prepareExecute($getTenderQuery, ['id' => $id]);
		return $resultQuery->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Возвращает список тендеров
	 */
	function getListTender($data) {
		$bd = ConectionBD::getInstance();
		$where = [];
		foreach ($data as $key => $value) {
			if ($value) {
				$where[] = "$key = :$key";
			} else {
				unset($data[$key]);
			}
		}
		$whereQuery = '';
		if (count($where)) {
			$whereQuery = 'WHERE '.implode(' && ', $where);
		}

		$getTagsQuery = "SELECT id, number, status, name, date FROM tenders $whereQuery LIMIT 10;";
		$resultQuery = $bd->prepareExecute($getTagsQuery, $data);
		return $resultQuery->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Добавляет новый тендер
	 */
	function addTender($data) {
		$bd = ConectionBD::getInstance();
		$addCuisineQuery = "INSERT INTO `tenders` (number, status, name) VALUES (:number, :status, :name)";
		$bd->prepareExecute($addCuisineQuery, ['number' => $data['number'], 'status' => $data['status'], 'name' => $data['name']]);
		return ['result' => 'ok'];
	}

	/**
	 * Проверять что запрос GET
	 */
	function isGetRequest() {
		return strtolower($_SERVER["REQUEST_METHOD"]) == 'get';
	}

	/**
	 * Проверять что запрос POST
	 */
	function isPostRequest() {
		return strtolower($_SERVER["REQUEST_METHOD"]) == 'post';
	}

	/**
	 * Проверять что есть GET параметр с заданным именем
	 */
	function isParam($name) {
		return isset($_GET[$name]);
	}