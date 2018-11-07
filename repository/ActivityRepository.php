<?php

class ActivityRepository extends Repository {

    public function getEntityName() {
        return 'activity';
    }

    public function getEntityFields() {
        return ['activityId', 'activityName', 'activityNumber', 'activityDate'];
    }
}
