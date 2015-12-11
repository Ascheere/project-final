<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$app = new Application();

$app['debug'] = true;

$app->get('/',function(){
        return new Response('<h1>Final Project - Michael Brown -- Andrew Scheerenberger</h1>',200);
});

$app->get('/users',function(){
        $repo = new \Notes\Persistence\Entity\MysqlUserRepository();

        $userArray = array();
        $users = $repo->getUsers();
        for($i = 0; $i < $repo->count(); $i++)
        {
            $userArray[] = array_pop($users)->__toString();
        }
        $jsons = json_encode($userArray);

        $response =  new Response($jsons, 200);
        $response->headers->set('Content-Type','application/json');
        $response->headers->set('Content-Length',strlen($jsons));
        return $response;
});

$app->post('/users',function(Request $request) {

    $payload = json_decode($request->getContent(), true);




    $repo = new \Notes\Persistence\Entity\MysqlUserRepository();
    $newUser = new \Notes\Domain\Entity\User(new \Notes\Domain\ValueObject\Uuid());

    if(isset($payload['username']))
    {
        $newUser->setUsername($payload['username']);
    }

    if(isset($payload['password']))
    {
        $newUser->setPassword($payload['password']);
    }

    if(isset($payload['email']))
    {
        $newUser->setEmail($payload['email']);
    }
    if(isset($payload['firstName']))
    {
        $newUser->setFirstName($payload['firstName']);
    }
     if(isset($payload['lastName']))
    {
        $newUser->setLastName($payload['lastName']);
    }

    $repo->add($newUser);

    $responseData = [];

    $responseData['UserId'] = $newUser->getUserID();

    $responseJson = json_encode($responseData);

    $response =  new Response(json_encode($responseData), 201);
    $response->headers->set('Content-Type','application/json');
    $response->headers->set('Content-Length',strlen($responseJson));
    $response->headers->set('Content-Location', 'http://localhost:8989/users/' . $newUser->getUserID());

    return $response;
});

$app->run();
