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


    public function updateActivity(array $activity) {
        $sql = "UPDATE activity SET activityName =:activityName, activityNumber = :activityNumber,
    activityDate = :activityDate WHERE activityId = :activityID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('activityName', $activity['activityName']);
        $stmt->bindParam('activityId', $activity['activityId']);
        $stmt->bindParam('activityNumber', $activity['activityNumber']);
        $stmt->bindParam('activityDate', $activity['activityDate']);
        $stmt->execute();
        return getActivity($activity['activityId']);
    }
}
