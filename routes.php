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


$app->get('/course/{id}', function (Request $request, Response $response, array $args) {
    $courseId = (int)$args['id'];
    $repository = new CourseRepository($this->db);
    $course = $repository->getCourse($courseId);
    $newResponse = $response->withJson($course);
    return $newResponse;
});

$app->post('/course', function (Request $request, Response $response, array $args) {
      
    $data = $request->getParsedBody();
  $userId = $data['userId'];
    $repository = new CourseRepository($this->db);
    $insertedCourse =  $repository->addCourse($userId, $data);
    
    $newResponse = $response->withJson($insertedCourse);
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