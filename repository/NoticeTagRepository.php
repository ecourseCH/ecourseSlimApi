<?php

class NoticeTagRepository extends Repository {

    public function getEntityName() {
        return 'noticeTag';
    }

    public function getEntityFields() {
        return ['noticeTagId', 'noticeTagName', 'parentNoticeTagId'];
    }

    private function getChildrenOfNoticeTag($noticeTag, &$categories) {
        if (!array_key_exists($noticeTag['noticeTagId'], $categories)) {
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
