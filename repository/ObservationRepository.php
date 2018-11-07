<?php

class ObservationRepository extends Repository {

    public function getEntityName() {
        return 'observation';
    }

    public function getEntityFields() {
        return ['observationId', 'observationText', 'activityId', 'observationDate', 'leaderId', 'participantId'];
    }

    public function updateObservation(array $observation) {
        $sql = "UPDATE observation SET observationText = :observationText, activityId =:activityId,
    observationDate = :observationDate, leaderId = :leaderId
    ,participantId = :participantId
    WHERE observationId = :observationId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('observationId', $observation["observationId"]);
        $stmt->bindParam('observationText', $observation["observationText"]);
        $stmt->bindParam('activityId', $observation["activityId"]);
        $stmt->bindParam('observationDate', $observation["observationDate"]);
        $stmt->bindParam('leaderId', $observation["leaderId"]);
        $stmt->bindParam('participantId', $observation["participantId"]);
        $stmt->execute();
        return getObservation($observation["observationId"]);
    }

    public function deleteObservation($observationId) {
        $sql = "DELETE FROM observation WHERE observationId = :observationId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('observationId', $observationId);
        $stmt->execute();

    }


    public function getObservationTagbyObservationId($observationId) {
        $sql = "SELECT observationTagId from obs_obsTag WHERE observationId = :observationId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('observationId', $observationId);
        $stmt->execute();

        $results = [];
        while ($row = $stmt->fetch()) {
            $repository = new ObservationTagRepository($this->db);
            $results[] = $repository->getObservationTag($row['observationTagId']);
        }
        return $results;
    }

    public function addObservationTagtoObservation($observationId, $observationTagId) {
        $sql = "INSERT INTO obs_obsTag ( observationId , observationTagId ) VALUES (:observationId ,  :observationTagId)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('observationId', $observationId);
        $stmt->bindParam('observationTagId', $observationTagId);

        $stmt->execute();
        return $this->getObservationTagbyObservationId($observationId);
    }

    public function deleteObservationTagFromObservation($observationId, $observationTagId) {
        $sql = "DELETE FROM obs_obsTag WHERE observationId = :observationId AND  observationTagId = :observationTagId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('observationId', $observationId);
        $stmt->bindParam('observationTagId', $observationTagId);
        $stmt->execute();
        print_r('im here del ' . $observationId . ' and ' . $observationTagId);
    }


    public function addObservationToObservationTag($observationId, $observationTagId) {
        $sql = "INSERT INTO part_partTag (observationId, observationTagId) VALUES (:observationId, :observationTagId)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('observationId', $observationId);
        $stmt->bindParam('observationTagId', $observationTagId);
        $stmt->execute();
    }

    public function deleteObservationToObservationTag($observationId, $observationTagId) {
        $sql = "DELETE FROM part_partTag WHERE observationId = :observationId AND observationTagId = :observationTagId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('observationId', $observationId);
        $stmt->bindParam('observationTagId', $observationTagId);
        $stmt->execute();
    }
}
