<?php
class UserRepository extends Repository
{
    public function getUsers() {
        $sql = "SELECT u.userId, u.userName, u.userMail, u.language
            FROM user u";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }

    public function getUser($userId) {
        $sql = "SELECT u.userId, u.userName, u.userMail, u.language
            FROM user u
            WHERE u.userId = :userId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('userId', $userId);
        $stmt->execute();
        
        $row = $stmt->fetch();
        return $row;
    }
    
}
