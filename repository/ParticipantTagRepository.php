<?php
class ParticipantTagRepository extends Repository
{  

    public function getParticipantTags() {
        $sql = "SELECT ot.participantTagId,ot.parentParticipantTagId, ot.participantTagName
        FROM participantTag ot";
        $stmt = $this->db->prepare($sql);
         $stmt->execute();
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }
     public function getParticipantTag($participantTagId) {
        $sql = "SELECT ot.participantTagId,ot.parentParticipantTagId, ot.participantTagName
        FROM participantTag ot WHERE ot.participantTagId = :participantTagId";
        $stmt = $this->db->prepare($sql);
         $stmt->bindParam('participantTagId', $participantTagId); 
           $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
      public function getParticipantTagByKey(array $participantTag) {
      IF (ISSET($participantTag['parentParticipantTagId'])){
          $parentParticipantTagId = $participantTag['parentParticipantTagId'];
          } ELSE {
    $parentParticipantTagId = 0;
    }
        $sql = "SELECT ot.participantTagId,ot.parentParticipantTagId, ot.participantTagName
        FROM participantTag ot WHERE ot.parentParticipantTagId = :parentParticipantTagId
        AND ot.participantTagName = :participantTagName";
        $stmt = $this->db->prepare($sql);
    $stmt->bindParam('parentParticipantTagId', $parentParticipantTagId); 
      $stmt->bindParam('participantTagName', $participantTag['participantTagName']); 
           $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
    
    public function addParticipantTag(array $participantTag){
      IF (ISSET($participantTag['parentParticipantTagId'])){
          $parentParticipantTagId = $participantTag['parentParticipantTagId'];
          } ELSE {
    $parentParticipantTagId = 0;
    }
    $sql = "INSERT INTO participantTag (parentParticipantTagId, participantTagName ) VALUES 
    (:parentParticipantTagId, :participantTagName ) ";
        $stmt = $this->db->prepare($sql);
    $stmt->bindParam('parentParticipantTagId', $parentParticipantTagId); 
      $stmt->bindParam('participantTagName', $participantTag['participantTagName']); 
              $stmt->execute();
    
     return $this->getParticipantTagByKey($participantTag);
    
    }
    
        public function createParentParticipantTag(){
    $text = "ParentParticipantTag";
    $sql = "REPLACE INTO participantTag (ParticipantTagId,parentParticipantTagId, participantTagName ) VALUES 
    (0,0, :parentParticipantTag )";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('parentParticipantTag', $text); 

              $stmt->execute();

   return $this->getParticipantTag(0);
    
    }   
    
    public function updateParticipantTag(array $participantTag){
      IF (ISSET($participantTag['parentParticipantTagId'])){
          $parentParticipantTagId = $participantTag['parentParticipantTagId'];
          } ELSE {
    $parentParticipantTagId = 0;
    }
    $sql = "UPDATE participantTag SET parentParticipantTagId = :parentParticipantTagId, participantTagName = :participantTagName
    WHERE participantTagId = :participantTagId";
           $stmt = $this->db->prepare($sql);
     $stmt->bindParam('parentParticipantTagId', $parentParticipantTagId); 
 $stmt->bindParam('participantTagName', $participantTag['participantTagName']); 
      $stmt->bindParam('participantTagId', $participantTag['participantTagId']); 
       
              $stmt->execute(); 
    return getParticipant($participantTag['participantTagId']);
    }
    
    public function deleteParticipantTag($participantTagId) {
    $sql = "DELETE FROM participantTag WHERE participantTagId = :participantTagId";
     $stmt = $this->db->prepare($sql);
     $stmt->bindParam('participantTagId', $participantTagId); 
       $stmt->execute(); 
     $this->createParentParticipantTag();
    }

 
}
