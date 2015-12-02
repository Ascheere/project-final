<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/17/15
 * Time: 6:45 PM
 */

namespace Notes\Persistence\Entity;


use Notes\Domain\Entity\User;
use Notes\Domain\Entity\UserRepositoryInterface;
use Notes\Domain\ValueObject\Uuid;

class InMemoryUserRepository implements UserRepositoryInterface
{

    protected $users;
    // an array of users


    public function __construct($initialUsers)
    {
        $this->users = []; // creates a new empty array
        $this->users = $initialUsers;
    }
    /**
     * @param User $user
     * @return mixed
     */
    public function add(User $user)
    {
        if(!$user instanceof User){
            throw new \InvalidArgumentException(
                __METHOD__. '():$user has to be a User Object'
            );
        }
        $userID = $user->getUserID();
        $this->users["$userID"] = $user;
        return $this;
    }

    /*
    public function getByUsername($username)
    {
        $results = [];
        foreach($this->users as $user){
            /**
             * @var \Notes\Domain\Entity\User $user
             *
            if ($user->getUsername()->__toString() === $username)
            {
                $results[] = $user;
            }
        }
        if(count($results) == 1)
        {
            return $results[0];
        }
        return $results;
    }
 */


    public function cointainsUser($userID)
    {
        if(array_key_exists($userID, $this->users))
            return true;
        else
            return false;
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function modify($userID,
        $newFirstName = '',
        $newLastName = '',
        $newPassword = '',
        $newEmail = '',
        $newUsername = '')
    {
        if($this->users[$userID] == null)
        {
            return false;
        }
        else {
            if ($newFirstName != '') {
                $this->users[$userID]->setFirstName($newFirstName);
            }
            if ($newLastName != '') {
                $this->users[$userID]->setLastName($newLastName);
            }
            if ($newPassword != '') {
                $this->users[$userID]->setPassword($newPassword);
            }
            if ($newEmail != '') {
                $this->users[$userID]->setEmail($newEmail);
            }
            if ($newUsername != '') {
                $this->users[$userID]->setUsername($newUsername);
            }

            return true;
        }
    }

    /**
     * @param \Notes\Domain\ValueObject\Uuid $id
     * @return bool
     */
    public function removeById(Uuid $userID)
    {
        if($this->users[$userID] == null)
        {
            return false;
        }
        else
        {
            unset($this->users[$userID]);
            return true;
        }
    }






    public function count()
    {
        return count($this->users);
    }

    /**
     * @param \Notes\Domain\ValueObject\Uuid $id
     * @param \Notes\Domain\Entity\User $user
     * @return bool
     */

    public function getUser($userID)
    {
        return $this->users[$userID];
    }
}
