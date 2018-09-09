<?php
class CodeMappingRepository extends Repository
{
    public function getCodeMappingById($codeMappingId) {
        $sql = "SELECT cm.codeMappingId, cm.codeMappingName, cm.Key1, cm.Value1
            FROM codeMapping cm where cm.codeMappingId = :codeMappingId";
        $stmt = $this->db->prepare($sql);
         $stmt->bindParam('codeMappingId', $codeMappingId); 
            $stmt->execute();
         $results = $stmt->fetch();
        return $result;
    }
    public function getCodeMappingByName($codeMappingName) {
        $sql = "SELECT cm.codeMappingId, cm.codeMappingName, cm.Key1, cm.Value1
            FROM codeMapping cm where cm.codeMappingName = :codeMappingName";
        $stmt = $this->db->prepare($sql);
         $stmt->bindParam('codeMappingName', $codeMappingName); 
            $stmt->execute();
         $results = $stmt->fetch();
        return $result;
    }
    
    public function addCodeMapping(array $codeMapping){
         $sql = "INSERT INTO codeMapping (codeMappingName, Key1, Value1) VALUES (:codeMappingName, :Key1, :Value1)";
        $stmt = $this->db->prepare($sql);
         $stmt->bindParam('codeMappingName', $codeMapping["codeMappingName"]); 
         $stmt->bindParam('Key1', $codeMapping["Key1"]); 
                  $stmt->bindParam('Value1', $codeMapping["Value1"]); 
                  $stmt->execute();
         $results = $stmt->fetch();
        return $result;
    return $codeMapping
    }
        public function updateCodeMapping(array $codeMapping){
     $sql = "UPDATE codeMapping SET codeMappingName = :codeMappingName, Key1 = :Key1, Value1 = :Value1 
     where codeMappingId = :codeMappingId ";
          $stmt = $this->db->prepare($sql); 
                  $stmt->bindParam('codeMappingId', $codeMapping["codeMappingId"]);
          $stmt->bindParam('codeMappingName', $codeMapping["codeMappingName"]);
                    $stmt->bindParam('Key1', $codeMapping["Key1"]);
                    $stmt->bindParam('Value1', $codeMapping["Value1"]);
          
        $stmt->execute();
            

        return getCodeMappingById($codeMapping["codeMappingId"]);
    return $codeMapping
    }
    
    
    
      public function updateUser($userId, array $userData){
    $sql = "UPDATE user SET userName = :userName, userMail = :userMail, language = :userLanguage where userId = :userId ";
          $stmt = $this->db->prepare($sql); 
                  $stmt->bindParam('userId', $userId);
            $stmt->bindParam('userName', $userData['userName']); 
        $stmt->bindParam('userMail', $userData['userMail']); 
        $stmt->bindParam('language', $userData['language']);  //todo check that language is part of codes
        $stmt->execute();
            

        return getUser($userId);
    }
    public function deleteCodeMappingByName(array $codeMapping) {
            
                 $sql = "DELETE FROM codeMapping cm where cm.codeMappingName = :codeMappingName ";
     $stmt = $this->db->prepare($sql);
    $stmt->bindParam('codeMappingName', $codeMappingName); 
        $stmtSelect->execute();
    
    }
    
        public function deleteCodeMappingById($codeMappingId) {
            
                 $sql = "DELETE FROM codeMapping cm where cm.codeMappingId = :codeMappingId ";
     $stmt = $this->db->prepare($sql);
    $stmt->bindParam('codeMappingId', $codeMappingId); 
        $stmtSelect->execute();
    
    }
   
    
}
