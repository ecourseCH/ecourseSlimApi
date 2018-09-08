<?php
class ObservationTagRepository extends Repository
{  

    public function getObservationTags() {
        $sql = "SELECT ot.observationTagId,ot.partentObservationTagId, ot.observationTagName
        FROM observationTag ot";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }
     public function getObservationTag($observationTagId) {
        $sql = "SELECT ot.observationTagId,ot.partentObservationTagId, ot.observationTagName
        FROM observationTag ot WHERE ot.observationTagId = :observationTagId";
        $stmt = $this->db->query($sql);
         $stmt->bindParam('observationTagId', $observationTagId); 
           $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
       
    public function addObservationTag($observationTag){
    $sql = "INSERT INTO observationTag (parentObservationTagId, observationTagName ) VALUES 
    (:parentObservationTagId, :observationTagName ) ";
        $stmt = $this->db->query($sql);
    $stmt->bindParam('parentObservationTagId', $observationTag['parentObservationTagId']); 
      $stmt->bindParam('observationTagName', $observationTag['observationTagName']); 
              $stmt->execute();
    
    // tbd return value
    
    }
    
    publicn function updateObservationTag($observationTag){
    $sql = "UPDATE observationTag SET parentObservationTagId = :parentObservationTagId, observationTagName = :observationTagName
    WHERE observationTagId = :observationTagId":
           $stmt = $this->db->query($sql);
     $stmt->bindParam('parentObservationTagId', $observationTag['parentObservationTagId']); 
 $stmt->bindParam('observationTagName', $observationTag['observationTagName']); 
      $stmt->bindParam('observationTagId', $observationTag['observationTagId']); 
       
              $stmt->execute(); 
    return getObservation($observationTag['observationTagId']);
    }
    
    public function deleteObservationTag($observationTagId) {
    $sql = "DELETE FROM observationTag WHERE observationTagId = :observationTagId";
     $stmt = $this->db->query($sql);
     $stmt->bindParam('observationTagId', $observationTagId); 
       $stmt->execute(); 
    
    }

 
}
