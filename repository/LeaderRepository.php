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
    $stmt->bindParam('userId', $leader['userId']); 
      $stmt->bindParam('leaderName', $leader['leaderName']); 
        $stmt->bindParam('leaderSurname', $leader['leaderSurname']); 
          $stmt->bindParam('leaderScoutname', $leader['leaderScoutname']); 
              $stmt->execute();
    
    // tbd add return value
    
    }

    public function updateLeader($leader){
    $sql = "UPDATE leader SET userId = :userId, leaderName = :leaderName, leaderSurname = :leaderSurname, 
    leaderScoutname = :leaderScoutname where leaderId = :leaderId";
        $stmt = $this->db->query($sql);
          $stmt->bindParam('leaderId', $leader['leaderId']); 
    $stmt->bindParam('userId', $leader['userId']); 
      $stmt->bindParam('leaderName', $leader['leaderName']); 
        $stmt->bindParam('leaderSurname', $leader['leaderSurname']); 
          $stmt->bindParam('leaderScoutname', $leader['leaderScoutname']); 
              $stmt->execute();
    $sql = "SELECT l.leaderId, l.userId, l.leaderName, l.leaderSurname, l.leaderScoutname
            FROM leader l where l.leaderId = :leaderId";
        $stmt = $this->db->query($sql);
         $stmt->bindParam('leaderId', $leaderId); 
            $stmt->execute();
         $result = $stmt->fetch();
        return $result;
    
    
    }
    
    public function deleteLeader($leader){
    $sql = "DELETE FROM leader WHERE leaderId = :leaderId ";
       $stmt = $this->db->query($sql);
          $stmt->bindParam('leaderId', $leader['leaderId']); 
            $stmt->execute();
    }
    
  
   
    
}
