<?php
class NoticeTagRepository extends Repository
{
    public function getNoticeTags() {
        $sql = "SELECT nt.noticeTagId, nt.noticeTagName, nt.parentNoticeTagId
            FROM noticeTag nt";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('noticeTagId', $noticeTagId);
        $stmt->execute();
        $results = [];
        while($row = $stmt->fetch()) {
            $rows[] = $row;
            $categories[$row['parentNoticeTagId']][] = $row;
        }


        $result = array();
        foreach ($rows as &$resultRow) {
            if($resultRow['parentNoticeTagId'] == null || $resultRow['parentNoticeTagId'] == 0 ){
                $result[] = $this->getChildrenOfNoticeTag($resultRow, $categories);
            }
        }

        return $result;
    }

    private function getChildrenOfNoticeTag($noticeTag, &$categories){
        if(!array_key_exists($noticeTag['noticeTagId'], $categories)){
            return $noticeTag;
        }
        
        $subcategories = $categories[$noticeTag['noticeTagId']];

        foreach ($subcategories as &$subcategory) {
            $noticeTag['children'][] = $this->getChildrenOfNoticeTag($subcategory, $categories);
        }

        return $noticeTag;

    }
}
?>