<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/19/15
 * Time: 3:02 PM
 */

namespace Notes\Domain\Entity\Roles;


use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\StringLiteral;

class AdminRole implements RoleInterface
{
    protected $name;
    protected $id;
    protected $permissions;

    public function __construct(Uuid $adminRoleID, $name = '', $createPermission = false, $deletePermission = false )
    {
        $this->name = new StringLiteral($name);
        $this->id = $adminRoleID;

        $this->permissions["Can Create"] = $createPermission;
        $this->permissions["Can Delete"] = $deletePermission;
    }

    public function getID()
    {
       return $this->id->__toString();
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function setCreatePermission($createPermission)
    {
        $this->permissions["Can Create"] = $createPermission;
    }

    public function setDeletePermission($deletePermission)
    {
        $this->permissions["Can Delete"] = $deletePermission;
    }
    public function getName()
    {
       return $this->name->__toString();
    }

    public function setName($name)
    {
        $this->name = new StringLiteral($name);
        return $this;
    }

    /*
    public function createUser(Uuid $uuid, $userName = '', $password = '', $email = '', $firstName = '', $lastName = '')
    {
        return new User($uuid, $userName, $password, $email, $firstName, $lastName);
    }

    public function removeUser($userID, $groupID)
    {
        // would either need a database or a collection of groups
        /*
         * something like
         * foreach( $
         *
    }
  */ // i dont think this is needed in here im not entirely sure

}
