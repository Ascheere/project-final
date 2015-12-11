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
            $count = $actual->count();

            $actual->add($user2);
            $count++;

            expect($actual->count())->to->equal($count); // this is an acceptable way to test an add
        });
    });
    describe('->addUser(swagzilla)', function() {
        it('should add a user to the sql table', function () {
            $actual = new MysqlUserRepository();

            $username = "Swagzilla";
            $password = "Yeezy2020!";
            $email = "swagzillablaze@gmail.com";
            $firstName = "Gary";
            $lastName = "Grice";

            $this->user1Key = new Uuid;
            $user1 = new User($this->user1Key, $username, $password, $email, $firstName, $lastName);


            $count = $actual->count();

            expect($actual->count())->to->equal($count);
            $actual->add($user1);
            $count++;

            expect($actual->count())->to->equal($count);
            //expect($actual->getUser($user1Key))->equal($user1);
        });
    });


    describe('->getUsers()', function() {
        it('should return an array of users', function () {
            $actual = new MysqlUserRepository();
            $count = $actual->count();

            $users = [];
            $users = $actual->getUsers();

            expect(count($users))->to->equal($count);
            expect(array_pop($users))->to->be->instanceof('Notes\Domain\Entity\User');

        });
    });

    describe('->removeUserID(Uuid $id)', function() {
        it('should remove a user by a userID', function () {
            $actual = new MysqlUserRepository();
            $count = $actual->count();

            $count -= 1;

            $actual->removeById($this->user1Key);

            expect($actual->count())->to->equal($count);

        });
    });

    describe('->getUser($userID)', function() {
        it('should return a single user that has the userid given', function () {
            $actual = new MysqlUserRepository();

            $username = "Swagzilla";
            $password = "Yeezy2020!";
            $email = "swagzillablaze@gmail.com";
            $firstName = "Gary";
            $lastName = "Grice";

            $this->user1Key = new Uuid;
            $user1 = new User($this->user1Key, $username, $password, $email, $firstName, $lastName);

            $actual->add($user1);

            $returnedUser = $actual->getUser($this->user1Key);

            expect($returnedUser)->to->be->instanceof('Notes\Domain\Entity\User');

            expect($returnedUser->getUserName())->to->equal($user1->getUserName());
        });
    });


    describe('->containsUser($userID)', function() {
        it('should return true if the user is in the database and false if they are not', function () {
            $actual = new MysqlUserRepository();

            expect($actual->containsUser($this->user1Key))->to->equal(true);

            $fakeId = new Uuid();

            expect($actual->containsUser($fakeId))->to->equal(false);

        });
    });

    describe('->modify($userID)', function() {
        it('should modify a user with the ID given with one or more input values', function () {

            $actual = new MysqlUserRepository();

            $passwordU = "OldDannyBrown12$";
            $emailU = "Blazeit@gmail.com";

            $actual->modify($this->user1Key,'', '', $passwordU, $emailU, '' );

            $returnedUser = $actual->getUser($this->user1Key);

            expect($returnedUser)->to->be->instanceof('Notes\Domain\Entity\User');

            expect($returnedUser->getEmail())->to->equal($emailU);
        });
    });

});
