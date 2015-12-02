<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/19/15
 * Time: 2:59 PM
 */

namespace Notes\Domain\Entity\Roles;


interface RoleInterface
{
  public function getID();

    public function getName();
    public function setName($name);
}
