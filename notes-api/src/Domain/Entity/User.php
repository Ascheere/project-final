<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/7/15
 * Time: 8:51 PM
 */
/*
 * User is a mutable object (entity) that holds attributes about a user. A user can be an owner and or an admin.
 */

namespace Notes\Domain\Entity;


use Notes\Domain\ValueObject\StringLiteral;
use Notes\Domain\ValueObject\Uuid;

class User
{

    protected $userName;
    protected $password;
    protected $email;
    protected $firstName;
    protected $lastName;
    protected $userID;

    public function __construct(Uuid $uuid, $userName = '', $password = '', $email = '', $firstName = '', $lastName = '')
    {
        //if password is initialized to and doesnt have atleast 8 characters, a special character and a number throw an error
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $special = preg_match('/[!@#$%^\'&*_=+{};:,<.>]/', $password);


        if(!empty($password) && ( ($uppercase != 1) || strlen($password) < 8 ||$lowercase != 1 || $number != 1 || ($special != 1) ))
        {
            throw new \InvalidArgumentException(
                __METHOD__ . '(): Password must be atleast 8 characters long, have 1 number and 1 special character '
            );
        }

        // if email is initialized and doesnt match a valid email throw an exception
        if( !empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new \InvalidArgumentException(
                __METHOD__ . '():  Invalid email'
            );
        }

        $this->userName = new StringLiteral($userName);
        $this->password = new StringLiteral(hash(sha256, $password));
        $this->email = new StringLiteral($email);
        $this->firstName = new StringLiteral($firstName);
        $this->lastName = new StringLiteral($lastName);
        $this->userID = $uuid; // create new uuid
    }

    /**
     * @return null
     */
    public function getUserName()
    {
        return $this->userName->__toString();
    }

    /**
     * @param null $userName
     * @return $this
     */
    public function setUserName($userName)
    {
        $this->userName = new StringLiteral($userName);

        return $this; // putting this in a setter allows you to chain sets together.
        // $user->setUserName('swag')->setFirstName("tyler"); etc
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email->__toString();
    }

    /**
     * @param null $email
     */
    public function setEmail($email)
    {
        // if email is initialized and doesnt match a valid email throw an exception
        if( !empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new \InvalidArgumentException(
                __METHOD__ . '():  Invalid email'
            );
        }

        $this->email = new StringLiteral($email);
        return $this;
    }

    /**
     * @return null
     */
    public function getPassword()
    {
        return $this->password->__toString();
    }

    /**
     * @param null $password
     */
    public function setPassword($password )
    {

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $special = preg_match('/[!@#$%^\'&*_=+{};:,<.>]/', $password);


        if(!empty($password) && ( ($uppercase != 1) || strlen($password) < 8 ||$lowercase != 1 || $number != 1 || ($special != 1) ))
        {
            throw new \InvalidArgumentException(
                __METHOD__ . '(): Password must be atleast 8 characters long, have 1 number and 1 special character '
            );
        }

        $this->password = new StringLiteral(hash(sha256, $password));
        return $this;
    }

    /**
     * @return StringLiteral
     */
    public function getFirstName()
    {
        return $this->firstName->__toString();
    }

    /**
     * @param StringLiteral $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = new StringLiteral($firstName);
        return $this;
    }

    /**
     * @return StringLiteral
     */
    public function getLastName()
    {
        return $this->lastName->__toString();
    }

    /**
     * @param StringLiteral $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = new StringLiteral($lastName);
        return $this;
    }

    /**
     * @return Uuid
     */
    public function getUserID()
    {
        return $this->userID->__toString();
    }

}
