<?php
abstract class Repository {
	protected $db;
	public function __construct(PDO $db) {
		$this->db = $db;
	}

	public abstract function getEntityName();

	public function getIdName() {
		return $this->getEntityName() . "Id";
	}

	public abstract function getEntityFields();

	public function getPublicFields() {
		return $this->getEntityFields();
	}

	private static function wrapFieldNameInQuotes(string $fieldName) {
		return '`' . $fieldName . '`';
	}

	private static function prefixFieldValueWithColon(string $fieldValue) {
		return ':' . $fieldValue;
	}

	private static function createEqualsExpression(string $fieldName) {
		return self::wrapFieldNameInQuotes($fieldName) . ' = ' . self::prefixFieldValueWithColon($fieldName);
	}

	public function add(array $entity) {
		$entityName = $this->getEntityName();
		$entityFields = $this->getEntityFields();
		$entityFieldsString = implode(",", array_map(['self', 'wrapFieldNameInQuotes'], $entityFields));
		$entityFieldValuesString = implode(", ", array_map(['self', 'prefixFieldValueWithColon'], $entityFields));

		$sql = "INSERT INTO $entityName ( $entityFieldsString ) VALUES ($entityFieldValuesString)";
		$stmt = $this->db->prepare($sql);

		foreach ($entityFields as $field) {
			// todo validation
			$stmt->bindParam($field, $entity[$field]);
		}
		$stmt->execute();

		return $this->getById($this->db->lastInsertId());
	}

	public function getAll() {
		$entityName = $this->getEntityName();
		$publicFieldsString = implode(', ', array_map(['self', 'wrapFieldNameInQuotes'], $this->getPublicFields()));

		$sql = "SELECT $publicFieldsString FROM $entityName entity";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$results = [];
		while ($row = $stmt->fetch()) {
			$results[] = $row;
		}

		return $results;
	}
	// idea: provide an object of return type and the values that are already set are acting as filter criteria
	public function getSome(array $entity) {
		$entityName = $this->getEntityName();
		$entityFields = $this->getEntityFields();
		$publicFieldsString = implode(', ', array_map(['self', 'wrapFieldNameInQuotes'], $this->getPublicFields()));
		// create entity filter
		$filterFields = [];
		$entityFilter = " 1 = 1 ";
		// go through fields and check if they are filled
		$keys = array_keys($entity);
		foreach ($keys as $key) {
			if (isset($entity[$key]) and in_array($key, $entityFields)) {
				$entityFilter = $entityFilter . " and " . $key . " = :" . $key;
				array_push($filterFields, $key);
			}

		}

		$sql = "SELECT $publicFieldsString FROM $entityName entity WHERE $entityFilter";

		$stmt = $this->db->prepare($sql);

		foreach ($filterFields as $field) {
			// todo validation
			$stmt->bindParam($field, $entity[$field]);
		}

		$stmt->execute();
		$results = [];
		while ($row = $stmt->fetch()) {
			$results[] = $row;
		}

		return $results;
	}

	public function getById(string $id) {
		return $this->getByUniqueField($this->getIdName(), $id);
	}

	public function getByUniqueField(string $fieldName, string $fieldValue) {
		$entityName = $this->getEntityName();
		$publicFieldsString = implode(', ', array_map(['self', 'wrapFieldNameInQuotes'], $this->getPublicFields()));
		$fieldCondition = self::createEqualsExpression($fieldName);

		$sql = "SELECT $publicFieldsString FROM $entityName WHERE $fieldCondition";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam($fieldName, $fieldValue);
		$stmt->execute();
		$row = $stmt->fetch();

		return $row;
	}

	public function update(string $id, array $entity) {
		$entityName = $this->getEntityName();
		$entityFields = $this->getEntityFields();
		$positionOfIdFieldInEntityArray = array_search($this->getIdName(), $entityFields);

		if ($positionOfIdFieldInEntityArray === false) {
			throw new Exception("Id field with name " . $this->getIdName() . " was not found in EntityFields " . implode(', ', $this->getEntityFields()));
		}
		unset($entityFields[$positionOfIdFieldInEntityArray]);

		$entityFieldAssignments = implode(', ', array_map(['self', 'createEqualsExpression'], $entityFields));
		$idFieldName = $this->getIdName();
		$idFieldCondition = self::createEqualsExpression($idFieldName);
		unset($entity[$idFieldName]);

		$sql = "UPDATE $entityName SET $entityFieldAssignments WHERE $idFieldCondition";

		$stmt = $this->db->prepare($sql);
		foreach ($entityFields as $field) {
			if (isset($entity[$field])) {
				$stmt->bindParam($field, $entity[$field]);
			}
		}
		$stmt->bindParam($idFieldName, $id);
		$stmt->execute();

		return $this->getById($id);
	}

	public function deleteAll() {
		$entityName = $this->getEntityName();

		$sql = "DELETE FROM $entityName";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
	}

	public function deleteById(string $id) {
		$entityName = $this->getEntityName();
		$idFieldName = $this->getIdName();
		$idFieldCondition = self::createEqualsExpression($idFieldName);

		$sql = "DELETE FROM $entityName WHERE $idFieldCondition";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam($idFieldName, $id);
		$stmt->execute();
	}
}

?>
