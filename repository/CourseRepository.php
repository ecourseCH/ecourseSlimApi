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
    public function getNewCourseId(){
    static $courseIdLength = "8";
    $checkStr = "1";
    $returnCourseId = "1";
    $abort = "0";
    while ($checkStr == $returnCourseId AND $abort < 200){
    
    $now = DateTime::createFromFormat('U.u', microtime(true));
    //$now->format("m-d-Y H:i:s.u");
    $inputStr = date_format($now,"Y-m-d h:i:s.u");
   // print ("inputstr " . $inputStr ."\n");
    $checkStr = substr(md5($inputStr), 0 , $courseIdLength);
   // print ("checkstr " . $checkStr."\n");
   $sql = "SELECT c.courseId FROM 
course c WHERE  c.courseId = :courseId ";
    $stmt = $this->db->prepare($sql);
        $stmt->bindParam('courseId', $courseId);
        $stmt->execute();
    $row = $stmt->fetch();
 //    $results []= $row;
   //         print(" results " . $row ."\n");
    $returnCourseId = $row['courseId'];
     //  print(" return " . $returnCourseId ."\n");

    $abort++;
    }
    
    return $checkStr;
    }
    
        public function addCourse($userId, array $courseData){

        $newCourseId = $this->getNewCourseId();
        $sql = "INSERT INTO course ( courseId, courseName, ownerUserId) 
        VALUES (:courseId, :courseName,:ownerUserId)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('courseId', $newCourseId ); 
        $stmt->bindParam('courseName', $courseData['courseName']); 
        // print_r ($userId);
        $stmt->bindParam('ownerUserId', $userId);
        //print_r ($userId);
        $stmt->execute();
        
        // read script
        $courseTemplateFile = fopen(__DIR__ . "/../sql/createcourse.sql","r") or die("Unable to open course sql file");
        $courseFile = fopen(__DIR__ . "/../sql/". $newCourseId . "_createcourse.sql","x+") or die ("Unable to create new course sql file " . $newCourseId );
        // do regex
        $courseTemplate = fread($courseTemplateFile, filesize(__DIR__ . "/../sql/createcourse.sql"));
        $courseTemplate = str_replace("**********",$newCourseId,$courseTemplate);
        // write script
        fwrite($courseFile, $courseTemplate);
        
        // execute script //TODO this does not work
        $coursestmt = $this->db->exec($courseTemplate);
        
        
        fclose($courseFile);
        fclose($courseTemplateFile);
        
        $sqlSelect = "SELECT c.courseId, c.courseName, c.ownerUserId, c.dbScheme
            FROM course c
            WHERE c.courseId = :courseId ";
        $stmtSelect = $this->db->prepare($sqlSelect);
        $stmtSelect->bindParam('courseId', $newCourseId);
        $stmtSelect->execute();
        $insertedUser = $stmtSelect->fetch();
        $courseUserData = array('userId' => $userId, 'courseId' => $newCourseId);
      //  print_r('I0m here');
        $this->addUserToCourse($userId, $courseUserData);
        
        return $insertedUser;
    }
    //TODO update course is missing
    public function updateCourse(){
    }
    
   public function deleteCourse($userId, array $courseData){
       $sql = "DELETE FROM course c where courseId = :courseId and ownerUserId = :ownerUserId ";
     $stmt = $this->db->prepare($sql);
    $stmt->bindParam('ownerUserId', $userId);
    $stmt->bindParam('courseId', $courseData['courseId']);
    $stmt->execute();
    }
    
      public function delAllCourses(){
           $sql = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'ecourse' 
           and table_name not in ('codeMapping','course','user','user_course') ";
     $stmt = $this->db->prepare($sql);
    $stmt->execute();
     $tables = "";
        while($row = $stmt->fetch()) {
            $tables .= ", " . $row;
        }
    $tables = ltrim($tables, ', ');

    // TODO cleanup of tables
    //    print($tables);
 //      $sql = "DROP TABLE :dropTables ";
 //    $stmt = $this->db->prepare($sql);
  //   $stmt->bindParam('dropTables', $tables);
 //   $stmt->execute();
          $sql = "DELETE FROM user_course";
     $stmt = $this->db->prepare($sql);
    $stmt->execute(); 
            $sql = "DELETE FROM course";
     $stmt = $this->db->prepare($sql);
    $stmt->execute();   
    }
    
    
    public function addUserToCourse($userId, array $courseUserData){
     $sql = "INSERT INTO user_course ( userId, courseId) VALUES (:userId,:courseId) ";
     $stmt = $this->db->prepare($sql);
    $stmt->bindParam('courseId', $courseUserData['courseId']);
    $stmt->bindParam('userId', $courseUserData['userId']);
    $stmt->execute();

    }
    
    public function deleteUserFromCourse($userId, array $courseUserData){
     $sql = "DELETE FROM user_course WHERE userId = :userId 
     AND courseId = :courseId
     AND EXISTS (select null from course where courseId = :courseId and ownerUserId = :ownerUserId ";
     $stmt = $this->db->prepare($sql);
    $stmt->bindParam('ownerUserId', $userId);
    $stmt->bindParam('courseId', $courseUserData['courseId']);
        $stmt->bindParam('userId', $courseUserData['userId']);
        $stmt->execute();
    }
    
}
