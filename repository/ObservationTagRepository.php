<?php

class ObservationTagRepository extends Repository {
    public function getEntityName() {
        return 'observationTag';
    }

    public function getEntityFields() {
        return ['observationTagId', 'parentObservationTagId', 'observationTagName'];
    }
    
  /*  
    // for object
function buildTree($items) {
    $childs = array();
    foreach($items as $item)
        $childs[$item->parent_id][] = $item;
    foreach($items as $item) if (isset($childs[$item->id]))
        $item->childs = $childs[$item->id];
    return $childs[0];
}
// or array version
function buildTree($items) {
    $childs = array();
    foreach($items as &$item) $childs[$item['parent_id']][] = &$item;
    unset($item);
    foreach($items as &$item) if (isset($childs[$item['id']]))
            $item['childs'] = $childs[$item['id']];
    return $childs[0];
}
*/
    
    public function getTree() {
    $observationTags = this.getAll();
    return buildTree($observationTags);
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

        return $this->getById(0);

    }

}
