<?php
class ActivityRepository extends Repository
{  

    public function getActivitys() {
    $sql = "SELECT a.activityId, a.activityName, a.activityNumber, a.activityDate from activity a";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
  $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
        }

        
        public function getActivity($activityId){
            $sql = "SELECT a.activityId, a.activityName, a.activityNumber, a.activityDate 
            from activity a WHERE activityId = :activityId";
$stmt = $this->db->prepare($sql);
         $stmt->bindParam('activityId', $activityId); 
           $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        }
        
        
    public function addActivity(array $activity){
    $sql = "INSERT INTO activity (activityName, activityNumber, activityDate ) VALUES
    (:activityName, :activityNumber, :activityDate )";
      $stmt = $this->db->prepare($sql);
         $stmt->bindParam('activityName', $activity['activityName']); 
         $stmt->bindParam('activityNumber', $activity['activityNumber']); 
         $stmt->bindParam('activityDate', $activity['activityDate']); 
           $stmt->execute();
           
           //TODO return value should be the right ones
           $sql = "SELECT activityId from activity ORDER BY activityId desc limit 1";
           $stmt = $this->db->prepare($sql);
             $stmt->execute();
           $activity = $stmt->fetch();
       
    return $this->getActivity($activity['activityId']);
    }
    
    
    public function updateActivity(array $activity){
    $sql= "UPDATE activity SET activityName =:activityName, activityNumber = :activityNumber,
    activityDate = :activityDate WHERE activityId = :activityID";
      $stmt = $this->db->prepare($sql);
         $stmt->bindParam('activityName', $activity['activityName']); 
         $stmt->bindParam('activityId', $activity['activityId']); 
         $stmt->bindParam('activityNumber', $activity['activityNumber']); 
         $stmt->bindParam('activityDate', $activity['activityDate']); 
           $stmt->execute();
    return getActivity($activity['activityId']);
    }
    
   public function deleteActivity($activityId) {
   $sql = "DELETE FROM activity WHERE activityId = :activityId";
        $stmt = $this->db->prepare($sql);
         $stmt->bindParam('activityId', $activityId); 
       $stmt->execute(); 
   }
  

 
}
