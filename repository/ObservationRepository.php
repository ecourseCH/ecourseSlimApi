<?php
class OberservationRepository extends Repository
{
    public function getObservations() {
        $sql = "SELECT o.observationId, o.observationText, o.activityId, o.observationDate, 
        o.leaderId, o.participantId
            FROM observation o";
        $stmt = $this->db->query($sql);
                   $stmt->execute();
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }
     public function getObservation($observationId) {
        $sql = "SELECT o.observationId, o.observationText, o.activityId, o.observationDate, 
        o.leaderId, o.participantId
            FROM observation o WHERE observationId = :observationId";
        $stmt = $this->db->query($sql);
         $stmt->bindParam('observationId', $observationId); 
           $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
       
    public function addObservation($observation){
    $sql = "INSERT INTO observation (observationText, activityId, observationDate, leaderId
    ,participantId ) VALUES (:observationText, :activityId, :observationDate, :leaderId
    , :participantId ) ";
        $stmt = $this->db->query($sql);
    $stmt->bindParam('observationText', $observation["observationText"]); 
      $stmt->bindParam('activityId', $observation["activityId"]); 
        $stmt->bindParam('observationDate', $observation["observationDate"]); 
          $stmt->bindParam('leaderId', $observation["leaderId"]); 
          $stmt->bindParam('participantId', $observation["participantId"]); 
              $stmt->execute();
    
    // tbd return value
    
    }
    
    publicn function updateObservation($observation){
    $sql = "UPDATE observation SET observationText = :observationText, activityId =:activityId,
    observationDate = :observationDate, leaderId = :leaderId
    ,participantId = :participantId
    WHERE observationId = :observationId":
           $stmt = $this->db->query($sql);
     $stmt->bindParam('observationId', $observation["observationId"]); 
 $stmt->bindParam('observationText', $observation["observationText"]); 
      $stmt->bindParam('activityId', $observation["activityId"]); 
        $stmt->bindParam('observationDate', $observation["observationDate"]); 
          $stmt->bindParam('leaderId', $observation["leaderId"]); 
          $stmt->bindParam('participantId', $observation["participantId"]); 
              $stmt->execute(); 
    return getObservation($observation["observationId"]);
    }
    
    public function deleteObservation($observationId) {
    $sql = "DELETE FROM observation WHERE observationId = :observationId";
     $stmt = $this->db->query($sql);
     $stmt->bindParam('observationId', $observationId); 
       $stmt->execute(); 
    
    }

   
      public function getObservationTagbyObservationId($observationId){
  $sql = "SELECT observationTagId from obs_obsTag WHERE observationId = :observationId";
   $stmt = $this->db->query($sql);
          $stmt->bindParam('observationId', $observationId); 
            $stmt->execute();

   $results = [];
        while($row = $stmt->fetch()) {
          
            $results[] = getObservationTag($row['observationTagId'])
        }
        
        
     
        return $results;
  }
   public function addObservationToObservationTag($observationId, $observationTagId){
   $sql = "INSERT INTO part_partTag (observationId, observationTagId) VALUES (:observationId, :observationTagId)";
     $stmt = $this->db->query($sql);
         $stmt->bindParam('observationId', $observationId); 
         $stmt->bindParam('observationTagId', $observationTagId); 
            $stmt->execute();
   }
     public function deleteObservationToObservationTag($observationId, $observationTagId){
   $sql = "DELETE FROM part_partTag WHERE observationId = :observationId AND observationTagId = :observationTagId";
     $stmt = $this->db->query($sql);
         $stmt->bindParam('observationId', $observationId); 
         $stmt->bindParam('observationTagId', $observationTagId); 
            $stmt->execute();
   }  
}
