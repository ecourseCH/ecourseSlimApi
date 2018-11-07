<?php

class CodeMappingRepository extends Repository {

    public function getEntityName() {
        return 'codeMapping';
    }

    public function getEntityFields() {
        return ['codeMappingId', 'codeMappingName', 'Key1_alpha', 'Key1_num', 'Value1'];
    }

    public function getCodeMappingByName($codeMappingName) {
        $sql = "SELECT cm.codeMappingId, cm.codeMappingName, cm.Key1_alpha, cm.Key1_num, cm.Value1
            FROM codeMapping cm where cm.codeMappingName = :codeMappingName";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('codeMappingName', $codeMappingName);
        $stmt->execute();
        $results = [];
        while ($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }

    public function getCodeMappingByKey(array $codeMapping) {
        $sql = "SELECT cm.codeMappingId, cm.codeMappingName, cm.Key1_alpha, cm.Key1_num, cm.Value1
            FROM codeMapping cm where cm.codeMappingName = :codeMappingName AND
            cm.Key1_alpha = :Key1_alpha AND cm.Key1_num = :Key1_num";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('codeMappingName', $codeMapping["codeMappingName"]);
        $stmt->bindParam('Key1_alpha', $codeMapping["Key1_alpha"]);
        $stmt->bindParam('Key1_num', $codeMapping["Key1_num"]);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

}
