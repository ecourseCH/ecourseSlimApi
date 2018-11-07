<?php

class LeaderRepository extends Repository {

    public function getEntityName() {
        return 'leader';
    }

    public function getEntityFields() {
        return ['leaderId', 'userId', 'leaderName', 'leaderSurname', 'leaderScoutname'];
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

    public function getParticipantTagbyLeaderId($leaderId) {
        $sql = "SELECT participantTagId from leader_partTag WHERE leaderId = :leaderId";
        $stmt = $this->db->pepare($sql);
        $stmt->bindParam('leaderId', $leaderId);
        $stmt->execute();

        $results = [];
        while ($row = $stmt->fetch()) {

            $results[] = getParticipantTag($row['participantTagId']);
        }


        return $results;
    }

    public function addLeaderToParticipantTag($leaderId, $participantTagId) {
        $sql = "INSERT INTO leader_partTag (leaderId, participantTagId) VALUES (:leaderId, :participantTagId)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('leaderId', $leaderId);
        $stmt->bindParam('participantTagId', $participantTagId);
        $stmt->execute();
    }

    public function deleteLeaderToParticipantTag($leaderId, $participantTagId) {
        $sql = "DELETE FROM leader_partTag WHERE leaderId = :leaderId AND participantTagId = :participantTagId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('leaderId', $leaderId);
        $stmt->bindParam('participantTagId', $participantTagId);
        $stmt->execute();
    }
}
