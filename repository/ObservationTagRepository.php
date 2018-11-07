<?php

class ObservationTagRepository extends Repository {
    public function getEntityName() {
        return 'observationTag';
    }

    public function getEntityFields() {
        return ['observationTagId', 'parentObservationTagId', 'observationTagName'];
    }

    public function getObservationTags() {
        $sql = "SELECT ot.observationTagId,ot.parentObservationTagId, ot.observationTagName
        FROM observationTag ot";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $results = [];
        while ($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }

    public function getObservationTag($observationTagId) {
        $sql = "SELECT ot.observationTagId,ot.parentObservationTagId, ot.observationTagName
        FROM observationTag ot WHERE ot.observationTagId = :observationTagId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('observationTagId', $observationTagId);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function getObservationTagByKey(array $observationTag) {
        IF (isset($observationTag['parentObservationTagId'])) {
            $parentObservationTagId = $observationTag['parentObservationTagId'];
        } else {
            $parentObservationTagId = 0;
        }
        $sql = "SELECT ot.observationTagId,ot.parentObservationTagId, ot.observationTagName
        FROM observationTag ot WHERE ot.parentObservationTagId = :parentObservationTagId 
        AND observationTagName = :observationTagName ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('parentObservationTagId', $parentObservationTagId);
        $stmt->bindParam('observationTagName', $observationTag['observationTagName']);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function addObservationTag(array $observationTag) {
        if (isset($observationTag['parentObservationTagId'])) {
            $parentObservationTagId = $observationTag['parentObservationTagId'];
        } else {
            $parentObservationTagId = 0;
        }

        $sql = "INSERT INTO observationTag (parentObservationTagId, observationTagName ) VALUES 
    (:parentObservationTagId, :observationTagName ) ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('parentObservationTagId', $parentObservationTagId);
        $stmt->bindParam('observationTagName', $observationTag['observationTagName']);
        $stmt->execute();

        return $this->getObservationTagByKey($observationTag);

    }

    public function createParentObservationTag() {
        $text = "ParentObservationTag";
        $sql = "REPLACE INTO observationTag (ObservationTagId,parentObservationTagId, observationTagName ) VALUES 
    (0,0, :parentObservationTag )";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('parentObservationTag', $text);

        $stmt->execute();

        return $this->getObservationTag(0);

    }

    public function updateObservationTag(array $observationTag) {
        IF (isset($observationTag['parentObservationTagId'])) {
            $parentObservationTagId = $observationTag['parentObservationTagId'];
        } else {
            $parentObservationTagId = 0;
        }
        $sql = "UPDATE observationTag SET parentObservationTagId = :parentObservationTagId, observationTagName = :observationTagName
    WHERE observationTagId = :observationTagId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('parentObservationTagId', $parentObservationTagId);
        $stmt->bindParam('observationTagName', $observationTag['observationTagName']);
        $stmt->bindParam('observationTagId', $observationTag['observationTagId']);

        $stmt->execute();
        return $this->getObservation($observationTag['observationTagId']);
    }

    public function deleteObservationTag($observationTagId) {
        $sql = "DELETE FROM observationTag WHERE observationTagId = :observationTagId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('observationTagId', $observationTagId);
        $stmt->execute();
        $this->createParentObservationTag();
    }

}
