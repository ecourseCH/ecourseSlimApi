<?php

class NoticeRepository extends Repository {

    public function getEntityName() {
        return 'notice';
    }

    public function getEntityFields() {
        return ['noticeId', 'noticeText', 'participantId'];
    }

    public function addNotice($participantId, array $noticeData) {
        $sql = "INSERT INTO notice (participantId, noticeText) VALUES (:participantId, :noticeText)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('participantId', $participantId);
        $stmt->bindParam('noticeText', $noticeData['text']);
        $stmt->execute();

        $sqlSelect = "SELECT n.noticeId, n.noticeText
            FROM notice n
            WHERE n.participantId = :participantId ORDER By n.noticeId DESC LIMIT 1";
        $stmtSelect = $this->db->prepare($sqlSelect);
        $stmtSelect->bindParam('participantId', $participantId);
        $stmtSelect->execute();
        $insertedNote = $stmtSelect->fetch();

        return $insertedNote;
    }
}

?>
