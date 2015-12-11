<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/10/15
 * Time: 7:06 PM
 */

namespace Notes\Domain\Entity\UserGroup;


use Notes\Domain\Entity\User;
use Notes\Persistence\Entity\InMemoryUserRepository;
use Notes\Domain\Entity\Roles\OwnerRole;

use Notes\Domain\ValueObject\StringLiteral;
use Notes\Domain\ValueObject\Uuid;

class Owner implements UserGroupInterface
{
    protected $ownerRepository; // is an in memory user repository
    protected $groupRole;
    protected $name;
    protected $id;

    public function __construct(Uuid $ownerGroupID, $name = '', $initialUsers)
    {
        $this->id = $ownerGroupID;

        $this->name = new StringLiteral($name);

        $this->ownerRepository = new InMemoryUserRepository($initialUsers);
    }


    public function setRole(RoleInterface $role)
    {
        $this->groupRole = $role;
        return $this;
    }

    public function getRole()
    {
        return $this->groupRole;
    }
    public function setName($name)
    {
        $this->name = new StringLiteral($name);
        return $this;
    }

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name->__toString();
    }

    public function getGroupID()
    {
        return $this->id->__toString();
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->ownerRepository->getUsers();
    }

    /**
     * @param User $user
     * @return bool
     */
    public function addUser(User $user)
    {
        $this->ownerRepository->add($user);
        return $this;
    }

    /**
     * @param $userID
     * @param string $newFirstName
     * @param string $newLastName
     * @param string $newPassword
     * @param string $newEmail
     * @param string $newUsername
     * @return bool
     */
    public function updateUser(
        $userID,
        $newFirstName = '',
        $newLastName = '',
        $newPassword = '',
        $newEmail = '',
        $newUsername = ''
    ) {
        /*
         * @var $user Notes\Domain\Entity\User;
         */
        // $user = $this->ownerRepository[$userID];

        return $this->ownerRepository->modify($userID, $newFirstName, $newLastName, $newPassword, $newEmail, $newUsername);
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->ownerRepository->count();
    }

    /**
     * @param $userID
     * @return bool
     */
    public function containsUser($userID)
    {
        return $this->ownerRepository->containsUser($userID);

    }

    /**
     * @param $userID
     * @return bool
     */
    public function removeUser($userID)
    {
        return $this->ownerRepository->removeById($userID);
    }

    /**
     * @param $userID
     * @return User
     */
    public function getUser($userID)
    {
        return $this->ownerRepository->getUser($userID);
    }
}
