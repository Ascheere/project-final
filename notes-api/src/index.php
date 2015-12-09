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
        $jsons = json_encode($repo->getUsers());
        $response =  new Response($jsons, 200);
        $response->headers->set('Content-Type','application/json');
        $response->headers->set('Content-Length',strlen($jsons));
        return $response;
});

$app->post('/users',function(Request $request) {

    $payload = json_decode($request->getContent(), true);

    $request->request->replace(is_array($payload) ? $payload : array());

    $payload = array
    (
        'username'  => $request->request->get('username'),
        'password'  => $request->request->get('password'),
        'email'  => $request->request->get('email'),
        'firstName'  => $request->request->get('firstName'),
        'lastName'  => $request->request->get('lastName'),
    );
    $repo = new \Notes\Persistence\Entity\MysqlUserRepository();
    $newUser = new \Notes\Domain\Entity\User(new \Notes\Domain\ValueObject\Uuid());

    if(isset($payload['username']))
    {
        $newUser->setUsername($payload['username']);
    }
    if(isset($payload['password']))
    {
        $newUser->setPassword($payload['username']);
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

    $jsons = json_encode
                ([
                    $newUser->getUserID()->__toString(),
                    $newUser->getUsername(),
                    $newUser->getEmail(),
                    $newUser->getFirstName(),
                    $newUser->getLastName()
                ]);

    $response =  new Response($jsons, 201);
    $response->headers->set('Content-Type','application/json');
    $response->headers->set('Content-Length',strlen($jsons));

    return $response;
});

$app->run();
