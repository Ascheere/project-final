<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/24/15
 * Time: 6:46 PM
 */

namespace Notes\Persistence\Entity;
use Notes\Db\Adapter\PdoAdapter;
use Notes\Domain\Entity\User;
use Notes\Domain\Entity\UserRepositoryInterface;
use Notes\Domain\ValueObject\Uuid;

class MysqlUserRepository implements UserRepositoryInterface
{
    protected $dsn;
    protected $username;
    protected $password;
    protected $link;

    public function __construct($dsn, $username, $password){
        $this->dsn = $dsn;
        $this->password = $password;
        $this->username = $username;

        $this->link = mysqli_connect($this->dsn, $this->username, $this->password);
    }


    public function __destruct()
    {
        $this->link->close();
    }
    /**
     * @param User $user
     * @return mixed
     */
    public function add(User $user)
    {
        // TODO: Implement add() method.
    }

    public function getByUsername($username)
    {
        // TODO: Implement getByUsername() method.
    }

    public function getUsers()
    {
        // TODO: Implement getUsers() method.
    }

    public function modify($userID,
        $newFirstName = '',
        $newLastName = '',
        $newPassword = '',
        $newEmail = '',
        $newUsername = '')
    {
        // TODO: Implement modify() method.
    }

    /**
     * @param \Notes\Domain\ValueObject\Uuid $id
     * @param \Notes\Domain\Entity\User $user
     * @return bool
     */
    public function modifyById(Uuid $id, User $user)
    {
        // TODO: Implement modifyById() method.
    }

    /**
     * @param \Notes\Domain\ValueObject\Uuid $id
     * @return bool
     */
    public function removeById(Uuid $id)
    {
        // TODO: Implement removeById() method.
    }

    public function count()
    {
        $sql = 'SELECT COUNT(*) FROM USERS';

        $result = mysqli_query($this->link, $sql);

        if ($result == false) {
            echo 'database query failed';
            return false;
        }

        $resultArray = $result->fetch_array();

        // if this doesnt work then use a count function
        return $resultArray[0];
    }

    public function getUser($userID)
    {
        // TODO: Implement getUser() method.
    }

    /**
     * @param \Notes\Domain\ValueObject\Uuid $id
     * @return bool
     */
    public function cointainsUser($userID)
    {
        // TODO: Implement cointainsUser() method.
    }
}
