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

    //TODO are we using this?
    public function getUserLanguages() {
        $sql = "SELECT value1 FROM codeMapping WHERE codeMappingName = 'Locales'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $availableLanguages = $stmt->fetch();
        return $availableLanguages;
    }

    public function deleteUser($userId) {
        $sql = "DELETE FROM user WHERE userId = :userId  ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('userId', $userId);
        $stmt->execute();
    }
}
