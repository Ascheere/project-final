<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/19/15
 * Time: 9:34 PM
 */

namespace Notes\Domain\Entity\Roles;


class OwnerRole implements RoleInterface
{

    protected $name;
    protected $id;
    protected $permissions;

    public function __construct(Uuid $ownerRoleID, $name, $addPermission, $deletePermission, $readPermission )
    {
        $this->name = new StringLiteral($name);
        $this->id = $ownerRoleID;

        $this->permissions["Can Add"] = $addPermission;
        $this->permissions["Can Delete"] = $deletePermission;
        $this->permissions["Can Read"] = $readPermission;
    }

    public function getID()
    {
        return $this->id->__toString();
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function setAddPermission($addPermission)
    {
        $this->permissions["Can Add"] = $addPermission;
    }
    public function setReadPermission($readPermission)
    {
        $this->permissions["Can Read"] = $readPermission;
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
}
