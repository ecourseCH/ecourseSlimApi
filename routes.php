<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//// USER
// add user
$app->post('/user', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();
    $repository = new UserRepository($this->db);
    $insertedUser = $repository->add($data);
    $newResponse = $response->withJson($insertedUser);
    return $newResponse;

});
// update user
$app->post('/user/{id}', function (Request $request, Response $response, array $args) {
    $userId = (int)$args['id'];
    $data = $request->getParsedBody();
    $repository = new UserRepository($this->db);
    $insertedUser = $repository->update($userId, $data);
    $newResponse = $response->withJson($insertedUser);
    return $newResponse;

});
// delete user
$app->delete('/user/{id}', function (Request $request, Response $response, array $args) {
    $userId = (int)$args['id'];
    $repository = new UserRepository($this->db);
    return $repository->deleteById($userId);;

});
// get all users
$app->get('/user', function (Request $request, Response $response, array $args) {
    $repository = new UserRepository($this->db);
    $users = $repository->getAll();
    $newResponse = $response->withJson($users);
    return $newResponse;
});
// get user
$app->get('/user/{id}', function (Request $request, Response $response, array $args) {
    $userId = (int)$args['id'];
    $repository = new UserRepository($this->db);
    $user = $repository->getById($userId);
    $newResponse = $response->withJson($user);
    return $newResponse;
});

//// COURSE
// get all courses
$app->get('/course', function (Request $request, Response $response, array $args) {
    $repository = new CourseRepository($this->db);
    $courses = $repository->getAll();
    $newResponse = $response->withJson($courses);
    return $newResponse;
});

// get course
$app->get('/course/{id}', function (Request $request, Response $response, array $args) {
    $courseId = (int)$args['id'];
    $repository = new CourseRepository($this->db);
    $course = $repository->getById($courseId);
    $newResponse = $response->withJson($course);
    return $newResponse;
});

// add course
$app->post('/course', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();
    $userId = $data['userId'];
    $repository = new CourseRepository($this->db);
    $insertedCourse = $repository->addCourse($userId, $data);

    $newResponse = $response->withJson($insertedCourse);
    return $newResponse;

});

//// LEADER
// get leaders
$app->get('/leader', function (Request $request, Response $response, array $args) {
    $repository = new LeaderRepository($this->db);
    $leaders = $repository->getAll();
    $newResponse = $response->withJson($leaders);
    return $newResponse;
});

// get leader
$app->get('/leader/{id}', function (Request $request, Response $response, array $args) {
    $leaderId = (int)$args['id'];
    $repository = new LeaderRepository($this->db);
    $leader = $repository->getById($leaderId);
    $newResponse = $response->withJson($leader);
    return $newResponse;
});
// add leader
$app->post('/leader', function (Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();
    //$userId = $data['userId'];
    $repository = new LeaderRepository($this->db);
    $insertedLeader = $repository->add($data);
    $newResponse = $response->withJson($insertedLeader);
    return $newResponse;

});
// delete leader
$app->delete('/leader/{id}', function (Request $request, Response $response, array $args) {
    $leaderId = (int)$args['id'];
    $repository = new LeaderRepository($this->db);
    return $repository->deleteById($leaderId);;

});

//// ACTIVITY
// add activity
$app->post('/activity', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();
    $repository = new ActivityRepository($this->db);
    $insertedActivity = $repository->add($data);
    $newResponse = $response->withJson($insertedActivity);
    return $newResponse;

});
// update activity
$app->post('/activity/{id}', function (Request $request, Response $response, array $args) {
    $activityId = (int)$args['id'];
    $data = $request->getParsedBody();
    $repository = new ActivityRepository($this->db);
    $insertedActivity = $repository->update($activityId, $data);
    $newResponse = $response->withJson($insertedActivity);
    return $newResponse;

});
// delete activity
$app->delete('/activity/{id}', function (Request $request, Response $response, array $args) {
    $activityId = (int)$args['id'];
    $repository = new ActivityRepository($this->db);
    return $repository->deleteById($activityId);;

});
// get all activitys
$app->get('/activity', function (Request $request, Response $response, array $args) {
    $repository = new ActivityRepository($this->db);
    $activitys = $repository->getAll();
    $newResponse = $response->withJson($activitys);
    return $newResponse;
});
// get activity
$app->get('/activity/{id}', function (Request $request, Response $response, array $args) {
    $activityId = (int)$args['id'];
    $repository = new ActivityRepository($this->db);
    $activity = $repository->getById($activityId);
    $newResponse = $response->withJson($activity);
    return $newResponse;
});


// CodeMapping
// add codeMapping
$app->post('/codeMapping', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();
    $repository = new CodeMappingRepository($this->db);
    $insertedCodeMapping = $repository->add($data);
    $newResponse = $response->withJson($insertedCodeMapping);
    return $newResponse;

});
// update codeMapping
$app->post('/codeMapping/{id}', function (Request $request, Response $response, array $args) {
    $codeMappingId = (int)$args['id'];
    $data = $request->getParsedBody();
    $repository = new CodeMappingRepository($this->db);
    $insertedCodeMapping = $repository->update($codeMappingId, $data);
    $newResponse = $response->withJson($insertedCodeMapping);
    return $newResponse;

});
// delete codeMapping
$app->delete('/codeMapping/{id}', function (Request $request, Response $response, array $args) {
    $codeMappingId = (int)$args['id'];
    $repository = new CodeMappingRepository($this->db);
    return $repository->deleteById($codeMappingId);;

});
// get all codeMappings
$app->get('/codeMapping', function (Request $request, Response $response, array $args) {
    $repository = new CodeMappingRepository($this->db);
    $codeMappings = $repository->getAll();
    $newResponse = $response->withJson($codeMappings);
    return $newResponse;
});
// get codeMapping
$app->get('/codeMapping/{id}', function (Request $request, Response $response, array $args) {
    $codeMappingId = (int)$args['id'];
    $repository = new CodeMappingRepository($this->db);
    $codeMapping = $repository->getById($codeMappingId);
    $newResponse = $response->withJson($codeMapping);
    return $newResponse;
});

// Observation
// add observation
$app->post('/observation', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();
    $repository = new ObservationRepository($this->db);
    $insertedObservation = $repository->add($data);
    $newResponse = $response->withJson($insertedObservation);
    return $newResponse;

});
// update observation
$app->post('/observation/{id}', function (Request $request, Response $response, array $args) {
    $observationId = (int)$args['id'];
    $data = $request->getParsedBody();
    $repository = new ObservationRepository($this->db);
    $insertedObservation = $repository->updateObservation($observationId, $data);
    $newResponse = $response->withJson($insertedObservation);
    return $newResponse;

});
// delete observation
$app->delete('/observation/{id}', function (Request $request, Response $response, array $args) {
    $observationId = (int)$args['id'];
    $repository = new ObservationRepository($this->db);
    return $repository->deleteObservation($observationId);;

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

// get all observationTag per observation
$app->get('/observation/{id}/observationTag', function (Request $request, Response $response, array $args) {
    $observationId = (int)$args['id'];
    $repository = new ObservationRepository($this->db);
    $observation = $repository->getObservationTagbyObservationId($observationId);
    $newResponse = $response->withJson($observation);
    return $newResponse;
});
// add observationTag to observation
$app->post('/observation/{id}/observationTag', function (Request $request, Response $response, array $args) {
    $observationId = (int)$args['id'];
    $data = $request->getParsedBody();
    $repository = new ObservationRepository($this->db);
    $insertedObservationTags = $repository->addObservationTagtoObservation($observationId, $data['observationTagId']);
    $newResponse = $response->withJson($insertedObservationTags);
    return $newResponse;

});
// delete observationTag to observation
$app->delete('/observation/{id}/observationTag', function (Request $request, Response $response, array $args) {
    $observationId = (int)$args['id'];
    $data = $request->getParsedBody();
    $repository = new ObservationRepository($this->db);
    $ObservationTags = $repository->deleteObservationTagFromObservation($observationId, $data['observationTagId']);
    $newResponse = $response->withJson($ObservationTags);
    return $newResponse;

});

// ObservationTag
// add observationTag
$app->post('/observationTag', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();
    $repository = new ObservationTagRepository($this->db);
    $insertedObservationTag = $repository->addObservationTag($data);
    $newResponse = $response->withJson($insertedObservationTag);
    return $newResponse;

});
// update observationTag
$app->post('/observationTag/{id}', function (Request $request, Response $response, array $args) {
    $observationTagId = (int)$args['id'];
    $data = $request->getParsedBody();
    $repository = new ObservationTagRepository($this->db);
    $insertedObservationTag = $repository->updateObservationTag($observationTagId, $data);
    $newResponse = $response->withJson($insertedObservationTag);
    return $newResponse;

});
// delete observationTag
$app->delete('/observationTag/{id}', function (Request $request, Response $response, array $args) {
    $observationTagId = (int)$args['id'];
    $repository = new ObservationTagRepository($this->db);
    return $repository->deleteObservationTag($observationTagId);;

});
// get all observationTags
$app->get('/observationTag', function (Request $request, Response $response, array $args) {
    $repository = new ObservationTagRepository($this->db);
    $observationTags = $repository->getObservationTags();
    $newResponse = $response->withJson($observationTags);
    return $newResponse;
});
// get observationTag
$app->get('/observationTag/{id}', function (Request $request, Response $response, array $args) {
    $observationTagId = (int)$args['id'];
    $repository = new ObservationTagRepository($this->db);
    $observationTag = $repository->getObservationTag($observationTagId);
    $newResponse = $response->withJson($observationTag);
    return $newResponse;
});


// Participant
// add participant
$app->post('/participant', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();
    $repository = new ParticipantRepository($this->db);
    $insertedParticipant = $repository->addParticipant($data);
    $newResponse = $response->withJson($insertedParticipant);
    return $newResponse;

});
// update participant
$app->post('/participant/{id}', function (Request $request, Response $response, array $args) {
    $participantId = (int)$args['id'];
    $data = $request->getParsedBody();
    $repository = new ParticipantRepository($this->db);
    $insertedParticipant = $repository->updateParticipant($participantId, $data);
    $newResponse = $response->withJson($insertedParticipant);
    return $newResponse;

});
// delete participant
$app->delete('/participant/{id}', function (Request $request, Response $response, array $args) {
    $participantId = (int)$args['id'];
    $repository = new ParticipantRepository($this->db);
    return $repository->deleteParticipant($participantId);;

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
// add participantTag
$app->post('/participantTag', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();
    $repository = new ParticipantTagRepository($this->db);
    $insertedParticipantTag = $repository->addParticipantTag($data);
    $newResponse = $response->withJson($insertedParticipantTag);
    return $newResponse;

});
// update participantTag
$app->post('/participantTag/{id}', function (Request $request, Response $response, array $args) {
    $participantTagId = (int)$args['id'];
    $data = $request->getParsedBody();
    $repository = new ParticipantTagRepository($this->db);
    $insertedParticipantTag = $repository->updateParticipantTag($participantTagId, $data);
    $newResponse = $response->withJson($insertedParticipantTag);
    return $newResponse;

});
// delete participantTag
$app->delete('/participantTag/{id}', function (Request $request, Response $response, array $args) {
    $participantTagId = (int)$args['id'];
    $repository = new ParticipantTagRepository($this->db);
    return $repository->deleteParticipantTag($participantTagId);;

});
// get all participantTags
$app->get('/participantTag', function (Request $request, Response $response, array $args) {
//print_r("im here1");
    $repository = new ParticipantTagRepository($this->db);
    // print_r("im here2");

    $participantTags = $repository->getParticipantTags();
    //  print_r("im 3");
    $newResponse = $response->withJson($participantTags);
    //   print_r("im here4");
    return $newResponse;
});
// get participantTag
$app->get('/participantTag/{id}', function (Request $request, Response $response, array $args) {
    $participantTagId = (int)$args['id'];
    $repository = new ParticipantTagRepository($this->db);
    $participantTag = $repository->getParticipantTag($participantTagId);
    $newResponse = $response->withJson($participantTag);
    return $newResponse;
});

// for testing purposes only:
// delete all users
$app->delete('/user', function (Request $request, Response $response, array $args) {

    $repository = new UserRepository($this->db);

    return $repository->deleteAll();
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

    return $repository->delAllCourses();;
});

$app->get('/testcourse', function (Request $request, Response $response, array $args) {
    $repository = new CourseRepository($this->db);
    $courses = $repository->addTestCourse();
    $newResponse = $response->withJson($courses);
    $ParentObservationTag = new ObservationTagRepository($this->db);
    $ParentObservationTag->createParentObservationTag();
    $ParentParticipantTag = new ParticipantTagRepository($this->db);
    $ParentParticipantTag->createParentParticipantTag();
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
