<?php

class ActivityRepository extends Repository {

    public function getEntityName() {
        return 'activity';
    }

    public function getEntityFields() {
        return ['activityId', 'activityName', 'activityNumber', 'activityDate'];
    }

    public function deleteActivity($activityId) {
        $sql = "DELETE FROM activity WHERE activityId = :activityId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('activityId', $activityId);
        $stmt->execute();
    }
}
