<?php
class LeaderRepository extends Repository
{
    public function getLeaders() {
        $sql = "SELECT l.leaderId, l.userId, l.leaderName, l.leaderSurname, l.leaderScoutname
            FROM leader l ";
        $stmt = $this->db->prepare($sql);
         //$stmt->bindParam('leaderId', $leaderId); 
            $stmt->execute();
         $results = [];
           while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
        
    }
  

  public function getLeader($leaderId) {
        $sql = "SELECT l.leaderId, l.userId, l.leaderName, l.leaderSurname, l.leaderScoutname
            FROM leader l WHERE leaderId = :leaderId";
          
      $stmt = $this->db->prepare($sql);
         $stmt->bindParam('leaderId', $leaderId); 
            $stmt->execute();
         $results = $stmt->fetch();
        return $results;
    }
    
     public function getLeaderByUserId($userId) {
        $sql = "SELECT l.leaderId, l.userId, l.leaderName, l.leaderSurname, l.leaderScoutname
            FROM leader l WHERE userId = :userId";
          
      $stmt = $this->db->prepare($sql);
         $stmt->bindParam('userId', $userId); 
            $stmt->execute();
         $results = $stmt->fetch();
        return $results;
    } 
    
    public function addLeader(array $leader){
    $sql = "INSERT INTO leader (userId, leaderName, leaderSurname, leaderScoutname) VALUES
    (:userId, :leaderName, :leaderSurname, :leaderScoutname)";
  //         print_r($sql);
 $stmt = $this->db->prepare($sql);
    $stmt->bindParam('userId', $leader['userId']); 
    $stmt->bindParam('leaderName', $leader['leaderName']); 
   $stmt->bindParam('leaderSurname', $leader['leaderSurname']); 
   $stmt->bindParam('leaderScoutname', $leader['leaderScoutname']); 
   $stmt->execute();
    return $this->getLeaderByUserId($leader['userId']);
    
    }

    public function updateLeader(array $leader){
    $sql = "UPDATE leader SET userId = :userId, leaderName = :leaderName, leaderSurname = :leaderSurname, 
    leaderScoutname = :leaderScoutname where leaderId = :leaderId";
        $stmt = $this->db->prepare($sql);
          $stmt->bindParam('leaderId', $leader['leaderId']); 
    $stmt->bindParam('userId', $leader['userId']); 
      $stmt->bindParam('leaderName', $leader['leaderName']); 
        $stmt->bindParam('leaderSurname', $leader['leaderSurname']); 
          $stmt->bindParam('leaderScoutname', $leader['leaderScoutname']); 
              $stmt->execute();
    $sql = "SELECT l.leaderId, l.userId, l.leaderName, l.leaderSurname, l.leaderScoutname
            FROM leader l where l.leaderId = :leaderId";
        $stmt = $this->db->prepare($sql);
         $stmt->bindParam('leaderId', $leaderId); 
            $stmt->execute();
         $result = $stmt->fetch();
        return $result;
    
    
    }
    
    public function deleteLeader($leaderId){
    $sql = "DELETE FROM leader WHERE leaderId = :leaderId ";
       $stmt = $this->db->prepare($sql);
          $stmt->bindParam('leaderId', $leaderId); 
            $stmt->execute();
            return 0;
    }
    
  public function getParticipantTagbyLeaderId($leaderId){
  $sql = "SELECT participantTagId from leader_partTag WHERE leaderId = :leaderId";
   $stmt = $this->db->pepare($sql);
          $stmt->bindParam('leaderId', $leaderId); 
            $stmt->execute();

   $results = [];
        while($row = $stmt->fetch()) {
          
            $results[] = getParticipantTag($row['participantTagId']);
        }
        
        
     
        return $results;
  }
   public function addLeaderToParticipantTag($leaderId, $participantTagId){
   $sql = "INSERT INTO leader_partTag (leaderId, participantTagId) VALUES (:leaderId, :participantTagId)";
     $stmt = $this->db->prepare($sql);
         $stmt->bindParam('leaderId', $leaderId); 
         $stmt->bindParam('participantTagId', $participantTagId); 
            $stmt->execute();
   }
     public function deleteLeaderToParticipantTag($leaderId, $participantTagId){
   $sql = "DELETE FROM leader_partTag WHERE leaderId = :leaderId AND participantTagId = :participantTagId";
     $stmt = $this->db->prepare($sql);
         $stmt->bindParam('leaderId', $leaderId); 
         $stmt->bindParam('participantTagId', $participantTagId); 
            $stmt->execute();
   }  
   
}
