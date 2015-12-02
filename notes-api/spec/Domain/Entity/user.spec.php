<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/3/15
 * Time: 7:12 PM
 */
use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\Uuid;

describe('Notes\Domain\Entity\User', function() {
    describe('->__construct()', function() {
        it('should return a User object', function () {
            $actual = new User();

            expect($actual)->to->be->instanceof('Notes\Domain\Entity\User');
        });
    });

    //tests to see if correct values are initialized and input
    describe('->construct("Swagzilla", "Yeezy2020!", "swagzillablaze@gmail.com", "Gary", "Grice")', function(){
        it('should return a User object instantiated with username Swagzilla, email swagzillablaze@gmail.com, password Yeezy2020, First name Gary, and last name Grice, password hashed', function (){

            $userID = new Uuid();

            $username = "Swagzilla";
            $password = "Yeezy2020!";
            $email = "swagzillablaze@gmail.com";
            $firstName = "Gary";
            $lastName = "Grice";
            $actual = new User($userID, $username, $password, $email, $firstName, $lastName);

            expect($actual)->to->be->instanceof('Notes\Domain\Entity\User');

            expect($actual->getUsername())->equal($username);

            expect($actual->getEmail())->equal($email);

            $hashpass = hash(sha256, $password); // the costructor will hash the password im not adding a random salt at this point so it will be easier to implement and test

            expect($actual->getPassword())->equal($hashpass);

            expect($actual->getFirstName())->equal($firstName);

            expect($actual->getLastName())->equal($lastName);

            expect($actual->getUserID())->equal($userID->__toString());
        });

    });

    // anything should be allowed to be passed into username aslong as its original this will be implemented later.
    // except escape characters but i wont check for that here.
    // inputs an invalid password that isnt long enough and doesn't have any numbers or special characters
    // inputs and invalid email. these invalid arguments should create an error
    describe('->construct("Andrew", "pass", "Idontneedtoinputanemail")', function(){
    it('Should return an invalid argument exception', function(){
        $username = "Andrew";
        $invalidPassword = "pass";
        $invalidEmail = "IDontNeedToInputAnEmail";
        $exception = null;

        try {
            new User($username, $invalidPassword, $invalidEmail);
        }
        catch(exception $e ){
            $exception = $e;
        }

        expect($exception)->to->be->instanceof(
            '\InvalidArgumentException'
        );
    });

    });


    // tests set and get user
    describe('->getUsername()', function() {
        it('should return the users user name', function () {
            $faker = \Faker\Factory::create();
            $username = $faker->userName;

            $user = new User();

            $user->setUsername($username); // set method would likely be used by an admin to change the user's name if they have an inappropriate username
            //or if a user account is created by an admin without information it can be set later

            expect($user->getUsername())->equal($username);
        });

    });

    // tests set and get password
    describe('->getPassword()', function() {
        it('shoud return the users hashed password', function () {
            //$faker = \Faker\Factory::create(); wasnt creating the properly formatted password
            $password = '@Swagtastic5';

            $user = new User();

            $user->setPassword($password); // setPassword would likely only be used for empty user objects made by an admin or to reset a password

            $hashpass = hash(sha256, $password);
            expect($user->getPassword())->equal($hashpass);
        });

    });

    // tests password validation
    describe('->setPassword()', function() {
        it('should throw and invalid argument exception', function () {

            $invalidPass = "badpass";

            $user = new User();

            $exception = null;

            try {
                $user->setPassword($invalidPass);
            }
            catch(exception $e ){
                $exception = $e;
            }

            expect($exception)->to->be->instanceof(
                '\InvalidArgumentException'
            );
        });

    });

    // tests set and get password
    describe('->getEmail()', function() {
        it('should return the users email address', function () {
            $faker = \Faker\Factory::create();
            $email = $faker->freeEmail;

            $user = new User();

            $user->setEmail($email); // setPassword would likely only be used for empty user objects made by an admin or to reset a password

            expect($user->getEmail())->equal($email);
        });

    });

    // tests email validation
    describe('->setEmail()', function() {
        it('should throw an invalid argument exception', function () {

            $invalidEmail = "IAmNotGivingMyEmailToAMachine";

            $user = new User();

            $exception = null;

            try {
                $user->setEmail($invalidEmail);
            }
            catch(exception $e ){
                $exception = $e;
            }

            expect($exception)->to->be->instanceof(
                '\InvalidArgumentException'
            );
        });

    });

    // don't need to test set and get name info. that is already tested with the stringliteral tests

});
