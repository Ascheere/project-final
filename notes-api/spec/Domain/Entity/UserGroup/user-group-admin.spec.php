<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/3/15
 * Time: 7:19 PM
 */
use Notes\Domain\Entity\UserGroup\Admin;
use Notes\Domain\ValueObject\Uuid;
use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\StringLiteral;


describe('Notes\Domain\Entity\UserGroup\Admin', function() {
    describe('->__construct()', function() {
        it('should return a Admin object', function () {
            $actual = new Admin();

            expect($actual)->to->be->instanceof('Notes\Domain\Entity\UserGroup\Admin');
        });
    });

    // i shall be testing the usergroupinterface functions here
    describe('->__construct("cs3620", "an array with user objects", true)', function() {
        it('should return a Admin object that is initialized with a name and 2 initial user objects and should be able to create new notes', function () {

            $groupID = new Uuid();

            $username = "Swagzilla";
            $password = "Yeezy2020!";
            $email = "swagzillablaze@gmail.com";
            $firstName = "Gary";
            $lastName = "Grice";
            $user1 = new User(new Uuid, $username, $password, $email, $firstName, $lastName);

            $username1 = "TheWorldsGreatest";
            $password2 = "Imadeit12@";
            $email3 = "piedpiperofRandB@gmail.com";
            $firstName4 = "Robert";
            $lastName5 = "Kelly";
            $user2 = new User(new Uuid, $username1, $password2, $email3, $firstName4, $lastName5);

            $user1Key = $user1->getUserID();
            $user2Key = $user2->getUserID();

            $initialUsers = array(
                $user1Key => $user1,
                $user2Key => $user2
            );
            $groupName = "cs3620";

            $actual = new Admin($groupID, $groupName, $initialUsers); // create new Admin group with name cs3620 and add an array with 2 users as initial users

            expect($actual)->to->be->instanceof('Notes\Domain\Entity\UserGroup\Admin');

            expect($actual->getName())->equal($groupName); // test get name

            expect($actual->getUsers())->equal($initialUsers); // test getUsers() could return the array or loop through the array a list each user. Not sure how id test that

            expect($actual->getUser($user1Key))->equal($user1); //test getUser with the key for user1

            expect($actual->getGroupID())->equal($groupID->__toString());

            expect($actual->count())->equal(2);

        });
    });

    describe('->addUser(swagzilla)', function() {
        it('should add a user to an empty Admin usergroup', function () {
            $actual = new Admin();

            $username = "Swagzilla";
            $password = "Yeezy2020!";
            $email = "swagzillablaze@gmail.com";
            $firstName = "Gary";
            $lastName = "Grice";
            $user1 = new User(new Uuid, $username, $password, $email, $firstName, $lastName);
            $user1Key = $user1->getUserID();

            $actual->addUser($user1);

            expect($actual->getUser($user1Key))->equal($user1);
        });
    });

    /*
    describe('->addUser(123)', function() {
        it('should trigger an invalidargumentexception', function () {
            $exception = null;
            $invalidUser = 123; // integer is not an instance of a user object
            $actual = new Admin();

            try{
                $actual->addUser($invalidUser);
            } catch(exception $e ){
                $exception = $e;
            }

            expect($exception)->to->be->instanceof(
                '\InvalidArgumentException'
            );
        });
    });*/

    // also tests contains
    describe('->removeUser()', function(){
        it('Should remove a user object from the group', function() {
            $username = "Swagzilla";
            $password = "Yeezy2020!";
            $email = "swagzillablaze@gmail.com";
            $firstName = "Gary";
            $lastName = "Grice";
            $user1 = new User(new Uuid, $username, $password, $email, $firstName, $lastName);

            $username1 = "TheWorldsGreatest";
            $password2 = "Imadeit12@";
            $email3 = "piedpiperofRandB@gmail.com";
            $firstName4 = "Robert";
            $lastName5 = "Kelly";
            $user2 = new User(new Uuid, $username1, $password2, $email3, $firstName4, $lastName5);

            $user1Key = $user1->getUserID();
            $user2Key = $user2->getUserID();

            $initialUsers = array(
                $user1Key => $user1,
                $user2Key => $user2
            );
            $groupName = "cs3620";

            $actual = new Admin(new Uuid,$groupName, $initialUsers); // create new Admin group with name cs3620 and add an array with 2 users as initial users

            expect($actual->getUser($user1Key))->equal($user1);

            $actual->removeUser($user1Key);

            expect($actual->containsUser($user1Key))->to->be->false;

        });
    });


    //todo figure out update
    describe('->updateUser(swagzilla)', function() {
        it('should update a user in an admin user group', function () {
            $actual = new Admin();

            $userKey = new Uuid();

            $username = "Swagzilla";
            $password = "Yeezy2020!";
            $email = "swagzillablaze@gmail.com";
            $firstName = "Gary";
            $lastName = "Grice";
            $user1 = new User($userKey, $username, $password, $email, $firstName, $lastName);
            $user1Key = $user1->getUserID();

            $actual->addUser($user1);

            expect($actual->getUser($user1Key))->equal($user1);

            $passwordU = "OldDannyBrown12$";
            $emailU = "Blazeit@gmail.com";
            $updatedUser1 = new User($userKey, $username, $passwordU, $emailU, $firstName, $lastName);

            $actual->updateUser($user1Key, '', '', $passwordU, $emailU, '');

            expect($actual->getUser($user1Key)->getEmail())->equal($updatedUser1->getEmail());
        });
    });

    /*
    describe('->setCanManipulateNotes()', function(){
        it('determines whether or not a group can manage users if a user is added to the banned Admin group then they cant create or edit notes', function() {
            $actual = new Admin();

            $actual->setName("banned");

            $actual->setCanManipulateNotes(false);


            expect($actual->canManageUsers())->to->be->false;


        });
    });*/
});
