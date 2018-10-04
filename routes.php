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
$app->delete('/user/{id}', function (Request $request, Response $response, array $args) {
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
$app->delete('/leader/{id}', function (Request $request, Response $response, array $args) {
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
$app->delete('/activity/{id}', function (Request $request, Response $response, array $args) {
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


// CodeMapping
// TODO

// Observation
// add observation
$app->post('/observation', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();
    $repository = new ObservationRepository($this->db);
    $insertedObservation =  $repository->addObservation($data); 
    $newResponse = $response->withJson($insertedObservation);
    return $newResponse;
   
});
// update observation
$app->post('/observation/{id}', function (Request $request, Response $response, array $args) {
   $observationId = (int)$args['id'];
    $data = $request->getParsedBody();
    $repository = new ObservationRepository($this->db);
    $insertedObservation =  $repository->updateObservation($observationId, $data); 
    $newResponse = $response->withJson($insertedObservation);
    return $newResponse;
   
});
// delete observation
$app->delete('/observation/{id}', function (Request $request, Response $response, array $args) {
   $observationId = (int)$args['id'];
    $repository = new ObservationRepository($this->db);
  return  $repository->deleteObservation($observationId); 
   ;
   
});
// get all observations //TODO is this needed?
$app->get('/observation', function (Request $request, Response $response, array $args) {
    $repository = new ObservationRepository($this->db);
    $observations = $repository->getObservations();
    $newResponse = $response->withJson($observations);
    return $newResponse;
});
// get observation
$app->get('/observation/{id}', function (Request $request, Response $response, array $args) {
    $observationId = (int)$args['id'];
    $repository = new ObservationRepository($this->db);
    $observation = $repository->getObservation($observationId);
    $newResponse = $response->withJson($observation);
    return $newResponse;
});


// ObservationTag

// Participant
// add participant
$app->post('/participant', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();
    $repository = new ParticipantRepository($this->db);
    $insertedParticipant =  $repository->addParticipant($data); 
    $newResponse = $response->withJson($insertedParticipant);
    return $newResponse;
   
});
// update participant
$app->post('/participant/{id}', function (Request $request, Response $response, array $args) {
   $participantId = (int)$args['id'];
    $data = $request->getParsedBody();
    $repository = new ParticipantRepository($this->db);
    $insertedParticipant =  $repository->updateParticipant($participantId, $data); 
    $newResponse = $response->withJson($insertedParticipant);
    return $newResponse;
   
});
// delete participant
$app->delete('/participant/{id}', function (Request $request, Response $response, array $args) {
   $participantId = (int)$args['id'];
    $repository = new ParticipantRepository($this->db);
  return  $repository->deleteParticipant($participantId); 
   ;
   
});
// get all participants 
$app->get('/participant', function (Request $request, Response $response, array $args) {
//print_r("im here1");
    $repository = new ParticipantRepository($this->db);
   // print_r("im here2");
    
    $participants = $repository->getParticipants();
  //  print_r("im 3");
    $newResponse = $response->withJson($participants);
 //   print_r("im here4");
    return $newResponse;
});
// get participant
$app->get('/participant/{id}', function (Request $request, Response $response, array $args) {
    $participantId = (int)$args['id'];
    $repository = new ParticipantRepository($this->db);
    $participant = $repository->getParticipant($participantId);
    $newResponse = $response->withJson($participant);
    return $newResponse;
});



// ParticipantTag

// for testing purposes only:
// delete all users
$app->delete('/user', function (Request $request, Response $response, array $args) {

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
$app->delete('/course', function (Request $request, Response $response, array $args) {

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

/*
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

*/
?>