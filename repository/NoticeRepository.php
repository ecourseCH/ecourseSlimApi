<?php
class NoticeRepository extends Repository
{
    public function getNotices($participantId) {
        $sql = "SELECT n.noticeId, n.noticeText
            FROM notice n
            WHERE n.participantId = :participantId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('participantId', $participantId);
        $stmt->execute();
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }

    public function addNotice($participantId, array $noticeData){
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