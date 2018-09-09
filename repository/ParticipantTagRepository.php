<?php
class ParticipantTagRepository extends Repository
{  

    public function getParticipantTags() {
        $sql = "SELECT ot.participantTagId,ot.partentParticipantTagId, ot.participantTagName
        FROM participantTag ot";
        $stmt = $this->db->prepare($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }
     public function getParticipantTag($participantTagId) {
        $sql = "SELECT ot.participantTagId,ot.partentParticipantTagId, ot.participantTagName
        FROM participantTag ot WHERE ot.participantTagId = :participantTagId";
        $stmt = $this->db->prepare($sql);
         $stmt->bindParam('participantTagId', $participantTagId); 
           $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
       
    public function addParticipantTag(array $participantTag){
    $sql = "INSERT INTO participantTag (parentParticipantTagId, participantTagName ) VALUES 
    (:parentParticipantTagId, :participantTagName ) ";
        $stmt = $this->db->prepare($sql);
    $stmt->bindParam('parentParticipantTagId', $participantTag['parentParticipantTagId']); 
      $stmt->bindParam('participantTagName', $participantTag['participantTagName']); 
              $stmt->execute();
    
    // tbd return value
    
    }
    
    publicn function updateParticipantTag(array $participantTag){
    $sql = "UPDATE participantTag SET parentParticipantTagId = :parentParticipantTagId, participantTagName = :participantTagName
    WHERE participantTagId = :participantTagId":
           $stmt = $this->db->prepare($sql);
     $stmt->bindParam('parentParticipantTagId', $participantTag['parentParticipantTagId']); 
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
    
    }

 
}
