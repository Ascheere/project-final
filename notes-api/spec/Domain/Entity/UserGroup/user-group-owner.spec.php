<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/3/15
 * Time: 7:21 PM
 */
use Notes\Domain\Entity\UserGroup\Owner;

use Notes\Domain\ValueObject\Uuid;
use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\StringLiteral;

describe('Notes\Domain\Entity\UserGroup\Owner', function() {
    describe('->__construct()', function() {
        it('should return a owner object', function () {
            $actual = new Owner();

            expect($actual)->to->be->instanceof('Notes\Domain\Entity\UserGroup\owner');
        });
    });

    // i shall be testing the usergroupinterface functions here
    describe('->__construct("cs3620", "an array with user objects", true)', function() {
        it('should return a owner object that is initialized with a name and 2 initial user objects and should be able to create new notes', function () {

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

            $actual = new owner($groupID, $groupName, $initialUsers); // create new owner group with name cs3620 and add an array with 2 users as initial users

            expect($actual)->to->be->instanceof('Notes\Domain\Entity\UserGroup\owner');

            expect($actual->getName())->equal($groupName); // test get name

            expect($actual->getUsers())->equal($initialUsers); // test getUsers() could return the array or loop through the array a list each user. Not sure how id test that

            expect($actual->getUser($user1Key))->equal($user1); //test getUser with the key for user1

            expect($actual->getGroupID())->equal($groupID->__toString());

            expect($actual->count())->equal(2);

        });
    });

    describe('->addUser(swagzilla)', function() {
        it('should add a user to an empty owner usergroup', function () {
            $actual = new Owner();

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
            $actual = new owner();

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

            $actual = new Owner(new Uuid,$groupName, $initialUsers); // create new owner group with name cs3620 and add an array with 2 users as initial users

            expect($actual->getUser($user1Key))->equal($user1);

            $actual->removeUser($user1Key);

            expect($actual->containsUser($user1Key))->to->be->false;

        });
    });


    //todo figure out update
    describe('->updateUser(swagzilla)', function() {
        it('should update a user in an owner user group', function () {
            $actual = new Owner();

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
        it('determines whether or not a group can create/edit notes if a user is added to the banned owner group then they cant create or edit notes', function() {
            $actual = new Owner();

            $actual->setName("banned");

            $actual->setCanManipulateNotes(false);


            expect($actual->canManipulateNotes())->to->be->false;


        });
    });*/
});


