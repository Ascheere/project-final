<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/24/15
 * Time: 6:47 PM
 */


use Notes\Persistence\Entity\MysqlUserRepository;
use Notes\Domain\Entity\UserFactory;
use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\Uuid;

describe( 'Notes\Persistence\Entity\MysqlUserRepository', function() {
    beforeEach(function(){
        $this->repo = new MysqlUserRepository();
        $this->userFactory = new UserFactory();
    });
    describe('->__construct()', function() {
        it('should construct an MysqlUserRepository object', function() {
            $actual = new MysqlUserRepository();

            expect($actual)->to->be->instanceof('Notes\Persistence\Entity\MysqlUserRepository');
        });
    });
    describe('->add()', function() {
        it('Should add 1 user to the repository', function() {
            $actual = new MysqlUserRepository();
            $user2 = new User(new Uuid);


            //$actual->add();

            expect($actual->count())->to->equal("1"); // this is an acceptable way to test an add
        });
    });
    describe('->addUser(swagzilla)', function() {
        it('should add a user to an empty Admin usergroup', function () {
            $actual = new MysqlUserRepository();

            $username = "Swagzilla";
            $password = "Yeezy2020!";
            $email = "swagzillablaze@gmail.com";
            $firstName = "Gary";
            $lastName = "Grice";
            $user1 = new User(new Uuid, $username, $password, $email, $firstName, $lastName);
            $user1Key = $user1->getUserID();

            expect($actual->count())->to->equal("1");
            $actual->add($user1);

            expect($actual->count())->to->equal("2");
            //expect($actual->getUser($user1Key))->equal($user1);
        });
    });


    /*
    describe('->getByUsername()', function() {
        it('Should return a single User object', function() {
            /**
             * @var \Notes\Domain\Entity\User $user
             *
            $user = $this->userFactory->create();
            $user->setUsername(new \Notes\Domain\ValueObject\StringLiteral('harrie'));

            $this->repo->add($user);

            $actual =  $this->repo->getByUsername('harrie');

            expect($actual)->to->be->instanceof('Notes\Domain\Entity\User');
            expect($actual->getUsername())->to->be->equal(new StringLiteral('harrie'));
        });
    });
    *
     public function add(User $user);
     public function getByUsername($username);
     public function getUsers();
     public function modify(User $user);
     public function remove(User $user);
     public function removeByUsername($username);
    */
});
