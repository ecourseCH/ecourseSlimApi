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

    private static function wrapFieldNameInQuotes($fieldName) {
        return '`' . $fieldName . '`';
    }

    private static function prefixFieldValueWithColon($fieldValue) {
        return ':' . $fieldValue;
    }

    private static function createEqualsExpression($fieldName) {
        return self::wrapFieldNameInQuotes($fieldName) . ' = ' . self::prefixFieldValueWithColon($fieldName);
    }

    public function add($entity) {
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
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }

        return $results;
    }

    public function getById($id) {
        $entityName = $this->getEntityName();
        $publicFieldsString = implode(', ', array_map(['self', 'wrapFieldNameInQuotes'], $this->getPublicFields()));
        $idFieldName = $this->getIdName();
        $idFieldCondition = self::createEqualsExpression($idFieldName);

        $sql = "SELECT $publicFieldsString FROM $entityName WHERE $idFieldCondition";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam($idFieldName, $id);
        $stmt->execute();
        $row = $stmt->fetch();

        return $row;
    }

    public function update($id, $entity) {
        $entityName = $this->getEntityName();
        $entityFields = $this->getEntityFields();
        $entityFieldAssignments = implode( ', ', array_map(['self', 'createEqualsExpression'], $entityFields));
        $idFieldName = $this->getIdName();
        $idFieldCondition = self::createEqualsExpression($idFieldName);
        // Prevent updating id
        unset($entity[$idFieldName]);

        $sql = "UPDATE $entityName SET $entityFieldAssignments WHERE $idFieldCondition";
        $stmt = $this->db->prepare($sql);
        foreach ($entityFields as $field) {
            // todo validation
            $stmt->bindParam($field, $entity[$field]);
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

    public function deleteById($id) {
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
