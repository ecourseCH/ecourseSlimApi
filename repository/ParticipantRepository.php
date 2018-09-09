<?php
class ParticipantRepository extends Repository
{
    public function getParticipants() {
        $sql = "SELECT p.participantId, p.scoutName, p.preName, p.name, p.branch
            FROM participant p";
        $stmt = $this->db->prepare($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }

    public function getParticipant($participantId) {
        $sql = "SELECT p.participantId, p.scoutName, p.preName, p.name, p.branch
            FROM participant p
            WHERE p.participantId = :participantId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('participantId', $participantId);
        $stmt->execute();
        
        $row = $stmt->fetch();
        return $row;
    }
    public function addParticipant(array $participant) {
    $sql = "INSERT INTO participant (participantName, participantSurname, participantScoutname ) VALUES
     (:participantName, :participantSurname, :participantScoutname )";
     $stmt = $this->db->prepare($sql);
        $stmt->bindParam('participantName', $participant['participantName']);
        $stmt->bindParam('participantSurname', $participant['participantSurname']);
        $stmt->bindParam('participantScoutname', $participant['participantScoutname']);
        $stmt->execute();
        // tbd add return value
    }
    public function updateParticipant(array $participant){
    $sql = "UPDATE participant SET participantName =:participantName, 
    participantSurname = :participantSurname, participantScoutname = :participantScoutname 
    WHERE participantId = :participantId"
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('participantId', $participant['participantId']);
        $stmt->bindParam('participantName', $participant['participantName']);
        $stmt->bindParam('participantSurname', $participant['participantSurname']);
        $stmt->bindParam('participantScoutname', $participant['participantScoutname']);
        $stmt->execute();
        
     return getParticipant( $participant['participantId']);
        
        
    }
       public function deleteParticipant(array $participant){
    $sql = "DELETE FROM participant WHERE participantId = :participantId ";
       $stmt = $this->db->prepare($sql);
          $stmt->bindParam('participantId', $participant["participantId"]); 
            $stmt->execute();
    }
    
    
      public function getParticipantTagbyParticipantId($participantId){
  $sql = "SELECT participantTagId from part_partTag WHERE participantId = :participantId";
   $stmt = $this->db->prepare($sql);
          $stmt->bindParam('participantId', $participantId); 
            $stmt->execute();

   $results = [];
        while($row = $stmt->fetch()) {
          
            $results[] = getParticipantTag($row['participantTagId'])
        }
        
        
     
        return $results;
  }
   public function addParticipantToParticipantTag($participantId, $participantTagId){
   $sql = "INSERT INTO part_partTag (participantId, participantTagId) VALUES (:participantId, :participantTagId)";
     $stmt = $this->db->prepare($sql);
         $stmt->bindParam('participantId', $participantId); 
         $stmt->bindParam('participantTagId', $participantTagId); 
            $stmt->execute();
   }
     public function deleteParticipantToParticipantTag($participantId, $participantTagId){
   $sql = "DELETE FROM part_partTag WHERE participantId = :participantId AND participantTagId = :participantTagId";
     $stmt = $this->db->prepare($sql);
         $stmt->bindParam('participantId', $participantId); 
         $stmt->bindParam('participantTagId', $participantTagId); 
            $stmt->execute();
   }  
}
