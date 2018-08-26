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
            public function addUser(array $userData){
        $sql = "INSERT INTO user ( userName, userMail, language) VALUES (:userName,:userMail,:language)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('userName', $userData['userName']); 
        $stmt->bindParam('userMail', $userData['userMail']); 
        $stmt->bindParam('language', $userData['language']);  //todo check that language is part of codes
        $stmt->execute();

        $sqlSelect = "SELECT u.userId, u.userName, u.userMail,u.password, u.language
            FROM user u
            WHERE u.userName = :userName";  // todo works as long as name is unique
        $stmtSelect = $this->db->prepare($sqlSelect);
        $stmtSelect->bindParam('userName', $userData['userName']);
        $stmtSelect->execute();
        $insertedUser = $stmtSelect->fetch();

        return $insertedUser;
    }
    
    public function getUserLanguages(){
    $sql = "SELECT value1 FROM codeMapping WHERE codeMappingName = 'Locales'";
        $stmt = $this->db->prepare($sql);    
    $stmt->execute();
    $availableLanguages = $stmtSelect->fetch();
    }
    public function updateUser($userId, array $userData){
    $sql = "UPDATE user SET userName = :userName, userMail = :userMail, language = :userLanguage where userId = :userId ";
          $stmt = $this->db->prepare($sql); 
                  $stmt->bindParam('userId', $userId);
            $stmt->bindParam('userName', $userData['userName']); 
        $stmt->bindParam('userMail', $userData['userMail']); 
        $stmt->bindParam('language', $userData['language']);  //todo check that language is part of codes
        $stmt->execute();
            

        return getUser($userId);
    }
    
    public function deleteUser($userId){
         $sql = "DELETE FROM user WHERE userId = :userId  ";
     $stmt = $this->db->prepare($sql);
    $stmt->bindParam('userId', $userId);
        $stmtSelect->execute();
    }
    
}
