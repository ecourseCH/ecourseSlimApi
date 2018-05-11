<?php
class ParticipantRepository extends Repository
{
    public function getParticipants() {
        $sql = "SELECT p.participantId, p.scoutName, p.preName, p.name, p.branch
            FROM participant p";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }

    public function getParticipant($participantId) {
        $sql = "SELECT p.participantId, p.scoutName, p.preName, p.name, p.branch
            FROM participant p
            WHERE p.participantId = :participantId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('participantId', $participantId);
        $stmt->execute();
        
        $row = $stmt->fetch();
        return $row;
    }
    
}
