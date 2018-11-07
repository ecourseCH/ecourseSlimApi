<?php

class UserRepository extends Repository {

    public function getEntityName() {
        return 'user';
    }

    public function getEntityFields() {
        return ['userId', 'userName', 'userMail', 'password', 'language'];
    }

    public function getPublicFields() {
        // everything except password is public (will be returned on GET request)
        return array_diff($this->getEntityFields(), ['password']);
    }

    public function delAllUsers() {
        $sql = "DELETE FROM user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }

    public function getUsers() {
        $sql = "SELECT u.userId, u.userName, u.userMail, u.language
            FROM user u";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $results = [];
        while ($row = $stmt->fetch()) {
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

    public function checkUserLogin(array $userData) {
        $sqlSelect = "SELECT u.userId, u.userName, u.userMail, u.language
            FROM user u
            WHERE u.userMail = :userMail";
        $stmtSelect = $this->db->prepare($sqlSelect);
        $stmtSelect->bindParam('userMail', $userData['userMail']);
        $stmtSelect->execute();
        $selectedUser = $stmtSelect->fetch();
        // TODO assert if user is not found
        return checkUserPwd;
    }

    public function checkUserPwd($userId, $userPwd) {
        //todo encryption
        $sql = "SELECT u.userId
            FROM user u
            WHERE u.userId = :userId AND u.password = :userPwd";
        $stmtSelect = $this->db->prepare($sql);
        $stmtSelect->bindParam('userId', $userId);
        $stmtSelect->bindParam('userPwd', $userPwd);
        $stmtSelect->execute();
        $loggedInUserId = $stmtSelect->fetch();
        return $loggedInUserId;
    }

    public function addUser(array $userData) {
        $sql = "INSERT INTO user ( userName, userMail, language) VALUES (:userName,:userMail,:language)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('userName', $userData['userName']);
        $stmt->bindParam('userMail', $userData['userMail']);
        $stmt->bindParam('language', $userData['language']);  //todo check that language is part of codes
        $stmt->execute();

        $sqlSelect = "SELECT u.userId, u.userName, u.userMail, u.language
            FROM user u
            WHERE u.userMail = :userMail";  // todo works as long as name is unique
        $stmtSelect = $this->db->prepare($sqlSelect);
        $stmtSelect->bindParam('userMail', $userData['userMail']);
        $stmtSelect->execute();
        $insertedUser = $stmtSelect->fetch();

        return $insertedUser;
    }

    //TODO are we using this?
    public function getUserLanguages() {
        $sql = "SELECT value1 FROM codeMapping WHERE codeMappingName = 'Locales'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $availableLanguages = $stmt->fetch();
        return $availableLanguages;
    }

    public function updateUser($userId, array $userData) {
        $sql = "UPDATE user SET userName = :userName, userMail = :userMail,
    language = :language WHERE userId = :userId ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('userId', $userId);
        $stmt->bindParam('userName', $userData['userName']);
        $stmt->bindParam('userMail', $userData['userMail']);
        $stmt->bindParam('language', $userData['language']);  //todo check that language is part of codes
        $stmt->execute();

        return $this->getUser($userId);
    }

    public function deleteUser($userId) {
        $sql = "DELETE FROM user WHERE userId = :userId  ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('userId', $userId);
        $stmt->execute();
    }
}
