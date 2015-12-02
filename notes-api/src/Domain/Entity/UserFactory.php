<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/17/15
 * Time: 6:17 PM
 */

namespace Notes\Domain\Entity;


use Notes\Domain\FactoryInterface;
use Notes\Domain\ValueObject\Uuid;

class UserFactory implements FactoryInterface
{
    /**
     * @return User
     */
    public function create()
    {
        return new User(new Uuid());
    }
}
