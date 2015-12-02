<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/3/15
 * Time: 7:22 PM
 */

namespace Notes\Domain\Entity\UserGroup;

use Notes\Domain\Entity\User;

interface UserGroupInterface
{
    //want user groups
     // complete usergroupinterface file. fill out the interface

    // construct doesn't need to be added to interface because there isnt going to be multiple inheritance


    public function setName($name);

    /**
     * @return String
     */
    public function getName();
    public function getGroupID();

    /**
     * @return array
     */
    public function getUsers();

    //public function deleteGroup(); should be in adminusergroup only
    /**
     * @param User $user
     * @return bool
     */
    public function addUser(User $user); // users are unique by their uuid, in the add user their userids are put in another field as the key for their entry
    // could make an addall function later

    // find old user with the userId and input one or more new values to change values for the user.
    /**
     * @param $userID
     * @param string $newFirstName
     * @param string $newLastName
     * @param string $newPassword
     * @param string $newEmail
     * @param string $newUsername
     * @return bool
     */
    public function updateUser($userID, $newFirstName = '', $newLastName = '', $newPassword = '', $newEmail = '', $newUsername = '');

    /**
     * @return int
     */
    public function count();

    /**
     * @param $userID
     * @return bool
     */
    public function containsUser($userID); // returns true if the userID is in the group and false if not

    /**
     * @param $userID
     * @return bool
     */
    public function removeUser($userID); // remove the user from the group using their uuid key

    /**
     * @param $userID
     * @return User
     */
    public function getUser($userID); // get a user from the grou using their uuid key




    // could put in a find user later that searches for a name or something in a user, not needed until theres alot of users
    // and a full get of all users becomes to much.




}
