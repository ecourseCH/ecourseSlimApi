<?php
class LeaderRepository extends Repository
{
    public function getLeaderById($leaderId) {
        $sql = "SELECT l.leaderId, l.userId, l.leaderName, l.leaderSurname, l.leaderScoutname
            FROM leader l where l.leaderId = :leaderId";
        $stmt = $this->db->query($sql);
         $stmt->bindParam('leaderId', $leaderId); 
            $stmt->execute();
         $results = $stmt->fetch();
        return $result;
    }
    public function addLeader($leader){
    $sql = "INSERT INTO leader (userId, leaderName, leaderSurname, leaderScoutname) VALUES
    (:userId, :leaderName, :leaderSurname, :leaderScoutname)";
    $stmt = $this->db->query($sql);
    $stmt->bindParam('userId', $leader["userId"]); 
      $stmt->bindParam('leaderName', $leader["leaderName"]); 
        $stmt->bindParam('leaderSurname', $leader["leaderSurname"]); 
          $stmt->bindParam('leaderScoutname', $leader["leaderScoutname"]); 
              $stmt->execute();
    
    
    
    }

    public function addCodeMapping($codeMapping){
         $sql = "INSERT INTO codeMapping (codeMappingName, Key1, Value1) VALUES (:codeMappingName, :Key1, :Value1)";
        $stmt = $this->db->query($sql);
         $stmt->bindParam('codeMappingName', $codeMapping["codeMappingName"]); 
         $stmt->bindParam('Key1', $codeMapping["Key1"]); 
                  $stmt->bindParam('Value1', $codeMapping["Value1"]); 
                  $stmt->execute();
         $results = $stmt->fetch();
        return $result;
    return $codeMapping
    }
        public function updateCodeMapping($codeMapping){
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
    public function deleteCodeMappingByName($codeMapping) {
            
                 $sql = "DELETE FROM codeMapping cm where cm.codeMappingName = :codeMappingName ";
     $stmt = $this->db->prepare($sql);
    $stmt->bindParam('codeMappingName', $codeMappingName); 
        $stmtSelect->execute();
    
    }
    
        public function deleteCodeMappingById($codeMapping) {
            
                 $sql = "DELETE FROM codeMapping cm where cm.codeMappingId = :codeMappingId ";
     $stmt = $this->db->prepare($sql);
    $stmt->bindParam('codeMappingId', $codeMappingId); 
        $stmtSelect->execute();
    
    }
   
    
}
