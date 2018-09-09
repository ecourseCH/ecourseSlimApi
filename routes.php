<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
//// USER
// add user
$app->post('/user', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();
    $repository = new UserRepository($this->db);
    $insertedUser =  $repository->addUser($data); 
    $newResponse = $response->withJson($insertedUser);
    return $newResponse;
   
});
// update user
$app->post('/user/{id}', function (Request $request, Response $response, array $args) {
   $userId = (int)$args['id'];
    $data = $request->getParsedBody();
    $repository = new UserRepository($this->db);
    $insertedUser =  $repository->updateUser($userId, $data); 
    $newResponse = $response->withJson($insertedUser);
    return $newResponse;
   
});
// delete user
$app->post('/user/del/{id}', function (Request $request, Response $response, array $args) {
   $userId = (int)$args['id'];
    $repository = new UserRepository($this->db);
  return  $repository->deleteUser($userId); 
   ;
   
});
// get all users //TODO is this needed?
$app->get('/user', function (Request $request, Response $response, array $args) {
    $repository = new UserRepository($this->db);
    $users = $repository->getUsers();
    $newResponse = $response->withJson($users);
    return $newResponse;
});
// get user
$app->get('/user/{id}', function (Request $request, Response $response, array $args) {
    $userId = (int)$args['id'];
    $repository = new UserRepository($this->db);
    $user = $repository->getUser($userId);
    $newResponse = $response->withJson($user);
    return $newResponse;
});

//// COURSE
// get all courses //TODO is this needed?
$app->get('/course', function (Request $request, Response $response, array $args) {
    $repository = new CourseRepository($this->db);
    $courses = $repository->getCourses();
    $newResponse = $response->withJson($courses);
    return $newResponse;
});

// get course
$app->get('/course/{id}', function (Request $request, Response $response, array $args) {
    $courseId = (int)$args['id'];
    $repository = new CourseRepository($this->db);
    $course = $repository->getCourse($courseId);
    $newResponse = $response->withJson($course);
    return $newResponse;
});

// add course
$app->post('/course', function (Request $request, Response $response, array $args) {
      
    $data = $request->getParsedBody();
  $userId = $data['userId'];
    $repository = new CourseRepository($this->db);
    $insertedCourse =  $repository->addCourse($userId, $data);
    
    $newResponse = $response->withJson($insertedCourse);
    return $newResponse;
    
});

//// LEADER
// get leaders
$app->get('/leader', function (Request $request, Response $response, array $args) {
    $repository = new LeaderRepository($this->db);
    $leaders = $repository->getLeaders();
    $newResponse = $response->withJson($leaders);
    return $newResponse;
});

// get leader
// TODO does not work
$app->get('/leader/{id}', function (Request $request, Response $response, array $args) {
    $leaderId = (int)$args['id'];
    $repository = new LeaderRepository($this->db);
    $leader = $repository->getLeader($leaderId);
    $newResponse = $response->withJson($leader);
    return $newResponse;
});
// add leader
// TODO does not work
$app->post('/leader', function (Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();
  //$userId = $data['userId'];
    $repository = new LeaderRepository($this->db);
    $insertedLeader =  $repository->addLeader($data);
    $newResponse = $response->withJson($insertedLeader);
    return $newResponse;
    
});
// delete leader
// TODO does not work
$app->post('/leader/del/{id}', function (Request $request, Response $response, array $args) {
   $leaderId = (int)$args['id'];
    $repository = new LeaderRepository($this->db);
  return  $repository->deleteLeader($leaderId); 
   ;
   
});

//// ACTIVITY
// add activity
$app->post('/activity', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();
    $repository = new ActivityRepository($this->db);
    $insertedActivity =  $repository->addActivity($data); 
    $newResponse = $response->withJson($insertedActivity);
    return $newResponse;
   
});
// update activity
$app->post('/activity/{id}', function (Request $request, Response $response, array $args) {
   $activityId = (int)$args['id'];
    $data = $request->getParsedBody();
    $repository = new ActivityRepository($this->db);
    $insertedActivity =  $repository->updateActivity($activityId, $data); 
    $newResponse = $response->withJson($insertedActivity);
    return $newResponse;
   
});
// delete activity
$app->post('/activity/del/{id}', function (Request $request, Response $response, array $args) {
   $activityId = (int)$args['id'];
    $repository = new ActivityRepository($this->db);
  return  $repository->deleteActivity($activityId); 
   ;
   
});
// get all activitys //TODO is this needed?
$app->get('/activity', function (Request $request, Response $response, array $args) {
    $repository = new ActivityRepository($this->db);
    $activitys = $repository->getActivitys();
    $newResponse = $response->withJson($activitys);
    return $newResponse;
});
// get activity
$app->get('/activity/{id}', function (Request $request, Response $response, array $args) {
    $activityId = (int)$args['id'];
    $repository = new ActivityRepository($this->db);
    $activity = $repository->getActivity($activityId);
    $newResponse = $response->withJson($activity);
    return $newResponse;
});


// for testing purposes only:
// delete all users
$app->get('/deluser', function (Request $request, Response $response, array $args) {

$repository = new UserRepository($this->db);
 
    return $repository->delAllUsers(); ;
});
// create new course id
$app->get('/courseId', function (Request $request, Response $response, array $args) {
    $repository = new CourseRepository($this->db);
    $courses = $repository->getNewCourseId();
    $newResponse = $response->withJson($courses);
    return $newResponse;
});

// delete all courses
$app->get('/delcourse', function (Request $request, Response $response, array $args) {

$repository = new CourseRepository($this->db);
 
    return $repository->delAllCourses(); ;
});

$app->get('/testcourse', function (Request $request, Response $response, array $args) {
    $repository = new CourseRepository($this->db);
    $courses = $repository->addTestCourse();
    $newResponse = $response->withJson($courses);
    return $newResponse;
});



// all old routes below this comment

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});


$app->get('/participant', function (Request $request, Response $response, array $args) {
    $repository = new ParticipantRepository($this->db);
    $participants = $repository->getParticipants();
    $newResponse = $response->withJson($participants);
    return $newResponse;
});

$app->get('/participant/{id}', function (Request $request, Response $response, array $args) {
    $participantId = (int)$args['id'];
    $repository = new ParticipantRepository($this->db);
    $participant = $repository->getParticipant($participantId);

    $repository = new NoticeRepository($this->db);
    $participant['notices'] = $repository->getNotices($participantId);

    $newResponse = $response->withJson($participant);
    return $newResponse;
});

$app->post('/notice/{id}', function (Request $request, Response $response, array $args) {
    $participantId = (int)$args['id'];

    $data = $request->getParsedBody();

   
    $repository = new NoticeRepository($this->db);
    $insertedNotice =  $repository->addNotice($participantId, $data);
    
    $newResponse = $response->withJson($insertedNotice);
    return $newResponse;
});

$app->get('/noticetag', function (Request $request, Response $response, array $args) {
    $repository = new NoticeTagRepository($this->db);
    $noticeTags = $repository->getNoticeTags();
    $newResponse = $response->withJson($noticeTags);
    return $newResponse;
});
?>