<?php
class CourseRepository extends Repository
{
    public function getCourses() {
        $sql = "SELECT c.courseId, c.courseName, c.ownerUserId
            FROM course c";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }

    public function getCourse($courseId) {
        $sql = "SELECT c.courseId, c.courseName, c.ownerUserId, c.dbScheme
            FROM course c
            WHERE c.courseId = :courseId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('courseId', $courseId);
        $stmt->execute();
        
        $row = $stmt->fetch();
        return $row;
    }
    
        public function addCourse($userId, array $courseData){
        $sql = "INSERT INTO course ( courseName, ownerUserId) VALUES (:courseName,:ownerUserId)";
        $stmt = $this->db->prepare($sql);
    // 
        $stmt->bindParam('courseName', $courseData['courseName']); 
        $stmt->bindParam('ownerUserId', $userId);
        $stmt->execute();

        $sqlSelect = "SELECT c.courseId, c.courseName, c.ownerUserId, c.dbScheme
            FROM course c
            WHERE c.ownerUserId = :userId ORDER By c.courseId DESC LIMIT 1";
        $stmtSelect = $this->db->prepare($sqlSelect);
        $stmtSelect->bindParam('ownerUserId', $userId);
        $stmtSelect->execute();
        $insertedUser = $stmtSelect->fetch();

        return $insertedUser;
    }
    
}
