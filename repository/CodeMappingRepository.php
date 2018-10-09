<?php
class CodeMappingRepository extends Repository
{

    public function getCodeMappings() {
        $sql = "SELECT cm.codeMappingId, cm.codeMappingName, cm.Key1_alpha, cm.Key1_num, cm.Value1
            FROM codeMapping cm ";
        $stmt = $this->db->prepare($sql);
            $stmt->execute();
     $results = [];
           while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }
    
     public function getCodeMapping($codeMappingId) {
     return $this->getCodeMappingById($codeMappingId);
     }
     
    public function getCodeMappingById($codeMappingId) {
        $sql = "SELECT cm.codeMappingId, cm.codeMappingName, cm.Key1_alpha, cm.Key1_num, cm.Value1
            FROM codeMapping cm where cm.codeMappingId = :codeMappingId";
        $stmt = $this->db->prepare($sql);
         $stmt->bindParam('codeMappingId', $codeMappingId); 
            $stmt->execute();
         $result = $stmt->fetch();
        return $result;
    }
    
    public function getCodeMappingByName($codeMappingName) {
        $sql = "SELECT cm.codeMappingId, cm.codeMappingName, cm.Key1_alpha, cm.Key1_num, cm.Value1
            FROM codeMapping cm where cm.codeMappingName = :codeMappingName";
        $stmt = $this->db->prepare($sql);
         $stmt->bindParam('codeMappingName', $codeMappingName); 
            $stmt->execute();
      $results = [];
           while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }
    
    //TODO return multiple codeMappings but should return only one
    public function addCodeMapping(array $codeMapping){
         $sql = "INSERT INTO codeMapping (codeMappingName, Key1_alpha, Key1_num, Value1) VALUES (:codeMappingName, :Key1_alpha, :Key1_num, :Value1)";
        $stmt = $this->db->prepare($sql);
         $stmt->bindParam('codeMappingName', $codeMapping["codeMappingName"]); 
         $stmt->bindParam('Key1_alpha', $codeMapping["Key1_alpha"]); 
         $stmt->bindParam('Key1_num', $codeMapping["Key1_num"]); 
                  $stmt->bindParam('Value1', $codeMapping["Value1"]); 
                  $stmt->execute();
        return $this->getCodeMappingByName($codeMapping["codeMappingName"]);
    
    }
        public function updateCodeMapping($codeMappingId,array $codeMapping){
     $sql = "UPDATE codeMapping SET codeMappingName = :codeMappingName, Key1_alpha = :Key1_alpha, Key1_num = :Key1_num, Value1 = :Value1 
     where codeMappingId = :codeMappingId ";
          $stmt = $this->db->prepare($sql); 
           $stmt->bindParam('codeMappingId', $codeMappingId);
          $stmt->bindParam('codeMappingName', $codeMapping["codeMappingName"]);
         $stmt->bindParam('Key1_alpha', $codeMapping["Key1_alpha"]); 
         $stmt->bindParam('Key1_num', $codeMapping["Key1_num"]); 
         $stmt->bindParam('Value1', $codeMapping["Value1"]);
          
        $stmt->execute();
           
        return $this->getCodeMappingById($codeMappingId);
  
    }
     public function deleteCodeMapping($codeMappingId) {
     return $this->deleteCodeMappingById($codeMappingId);
     }
        public function deleteCodeMappingById($codeMappingId) {
          $sql = "DELETE FROM codeMapping  WHERE codeMappingId = :codeMappingId ";
     $stmt = $this->db->prepare($sql);
    $stmt->bindParam('codeMappingId', $codeMappingId); 
        $stmt->execute();
    
    }
   
    
}
