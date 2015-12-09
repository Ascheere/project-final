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
        $response =  new Response($jsons,200);
        $response->headers->set('Content-Type','application/json');
        $response->headers->set('Content-Length',strlen($jsons));
        return $response;
});

$app->post('/users',function(Request $request) {
        //if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);
            $request->request->replace(is_array($data) ? $data : array());
        //}
        $data = array(
                'username'  => $request->request->get('username'),
                'firstName'  => $request->request->get('firstName'),
                'lastName'  => $request->request->get('lastName'),
            );
        //return new Response(json_encode($data),200);
        $repo = new \Notes\Persistence\Entity\MysqlUserRepository();
        $userFactory = new \Notes\Domain\Entity\UserFactory();
        $user = $userFactory->create();

        if(isset($data['username']))
            {
                $user->setUsername($data['username']);
            }
    if(isset($data['firstName']))
            {
                $user->setFirstName($data['firstName']);
            }
    if(isset($data['lastName']))
            {
                $user->setLastName($data['lastName']);
            }
    $repo->add($user);
    $jsons = json_encode([$user->getId()->__toString(),$user->getUsername(),$user->getFirstName(),$user->getLastName()]);
    $response =  new Response($jsons,200);
    $response->headers->set('Content-Type','application/json');
    $response->headers->set('Content-Length',strlen($jsons));
    return $response;
});

$app->run();
