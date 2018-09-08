<?php
class ActivityRepository extends Repository
{  

    public function getActivitys() {
    $sql = "SELECT a.activityId, a.activityName, a.activityNumber, a.activityDate from activity a";
    $stmt = $this->db->query($sql);
    $stmt->execute();
  $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
        }

        
        public function getActivity($activityId){
            $sql = "SELECT a.activityId, a.activityName, a.activityNumber, a.activityDate 
            from activity a WHERE activityID = :activityID";

               $stmt = $this->db->query($sql);
         $stmt->bindParam('activityId', $activityId); 
           $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        }
        
        
    public function addActivity($activity){
    $sql = "INSERT INTO activity (activityName, activityNumber, activityDate ) VALUES
    (:activityName, :activityNumber, :activityDate )";
      $stmt = $this->db->query($sql);
         $stmt->bindParam('activityName', $activity['activityName']); 
         $stmt->bindParam('activityNumber', $activity['activityNumber']); 
         $stmt->bindParam('activityDate', $activity['activityDate']); 
           $stmt->execute();
           
           //TODO return value
    
    }
    
    
    public function updateActivity($activity){
    $sql= "UPDATE activity SET activityName =:activityName, activityNumber = :activityNumber,
    activityDate = :activityDate WHERE activityId = :activityID";
      $stmt = $this->db->query($sql);
         $stmt->bindParam('activityName', $activity['activityName']); 
         $stmt->bindParam('activityId', $activity['activityId']); 
         $stmt->bindParam('activityNumber', $activity['activityNumber']); 
         $stmt->bindParam('activityDate', $activity['activityDate']); 
           $stmt->execute();
    return getActivity($activity['activityId']);
    }
    
   public function deleteActivity($activityId) {
   $sql = "DELETE FROM activity WHERE activityId = :activityId";
        $stmt = $this->db->query($sql);
         $stmt->bindParam('activityId', $activity['activityId']); 
       $stmt->execute(); 
   }
  

 
}
