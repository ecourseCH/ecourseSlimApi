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


function buildTree($flat, $pidKey, $idKey = null)
{

    echo  json_encode($flat);
  //  log ($pidKey);
   // log($idKey);
    $grouped = array();
    foreach ($flat as $sub){
        $grouped[$sub[$pidKey]][] = $sub;
    }

     echo  json_encode($grouped);
exit;
    $fnBuilder = function($siblings) use (&$fnBuilder, $grouped, $idKey) {
        foreach ($siblings as $k => $sibling) {
            $id = $sibling[$idKey];
            if(isset($grouped[$id])) {
                $sibling['children'] = $fnBuilder($grouped[$id]);
            }
            $siblings[$k] = $sibling;
        }

        return $siblings;
    };

    $tree = $fnBuilder($grouped[0]);

    return $tree;
} /*

// Example:
$flat = [
    ['id'=>100, 'parentID'=>0, 'name'=>'a'],
    ['id'=>101, 'parentID'=>100, 'name'=>'a'],
    ['id'=>102, 'parentID'=>101, 'name'=>'a'],
    ['id'=>103, 'parentID'=>101, 'name'=>'a'],
];





$tree = buildTree($flat, 'parentID', 'id');
print_r($tree);






The array generated will be like

Array
(
    [0] => Array
        (
            [id] => 1
            [parent_id] => 0
            [title] => Parent Page
            [children] => Array
                        (
                            [0] => Array
                                (
                                    [id] => 2
                                    [parent_id] => 1
                                    [title] => Sub Page
                                    [children] => Array
                                                (
                                                    [0] => Array
                                                        (
                                                            [id] => 3
                                                            [parent_id] => 1
                                                            [title] => Sub Sub Page
                                                        )
                                                )
                                )
                        )
        )
    [1] => Array
        (
            [id] => 4
            [parent_id] => 0
            [title] => Another Parent Page
        )
)
You need to use the below recursive function to achieve it

function buildTree(array $elements, $parentId = 0) {
    $branch = array();

    foreach ($elements as $element) {
        if ($element['parent_id'] == $parentId) {
            $children = buildTree($elements, $element['id']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[] = $element;
        }
    }

    return $branch;
}

$tree = buildTree($rows);
The algorithm is pretty simple:

Take the array of all elements and the id of the current parent (initially 0/nothing/null/whatever).
Loop through all elements.
If the parent_id of an element matches the current parent id you got in 1., the element is a child of the parent. Put it in your list of current children (here: $branch).
Call the function recursively with the id of the element you have just identified in 3., i.e. find all children of that element, and add them as children element.
Return your list of found children.










    
public function buildTree($list, $pId,$id){
    $grouped = array();
    $itemsTodo = $list
foreach ($list as $item) {
    if ($item[$pId] == 0) {
     array_push($grouped,$item);
     $itemsTodo = array_diff($itemsTodo,$item);
    } else {
        $this->addItemIfPossible($grouped,$item,$itemsTodo);
    }
}
while ( count($itemsTodo)> 0){
    foreach($itemsTodo as $item){
         $this->addItemIfPossible($grouped,$item,$itemsTodo);
    }

}

}
*/
public function buildTree(array $elements, $parentKey,$key,$childrenKey,$parentId = 0) {
    $branch = array();
   // echo(" calling for ". json_encode($elements) . " parent_id " . $parentId);
    
    foreach ($elements as $element) {
        if ($element[$parentKey] == $parentId && $element[$key] != 0) {
            $children = $this->buildTree($elements, $parentKey,$key,$childrenKey, $element[$key]);
            if ($children) {
                $element[$childrenKey] = $children;
            }
            $branch[] = $element;
        }
    }
     //   echo(" returning ". json_encode($branch) . " parent_id " . $parentId);

    return $branch;
}

    public function getTree() {
    $observationTags = $this->getAll();
    $tree = $this->buildTree($observationTags, 'parentObservationTagId','observationTagId', 'children',0);
    // echo(" result ". json_encode($tree) );
    return $tree;
    }

    public function setTree($tree) {
    return $this->getTree();
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
