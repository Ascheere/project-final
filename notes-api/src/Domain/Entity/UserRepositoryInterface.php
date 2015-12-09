<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/17/15
 * Time: 5:50 PM
 */

namespace Notes\Domain\Entity;
use Notes\Domain\ValueObject\Uuid;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     * @return mixed
     */
    public function add(User $user);


    public function getUser($userID);

    public function getUsers();


    public function modify($userID,
        $newFirstName = '',
        $newLastName = '',
        $newPassword = '',
        $newEmail = '',
        $newUsername = '');

    /**
     * @param \Notes\Domain\ValueObject\Uuid $id
     * @return bool
     */

    public function containsUser($userID);

    public function removeById(Uuid $id);

    public function count();
}
