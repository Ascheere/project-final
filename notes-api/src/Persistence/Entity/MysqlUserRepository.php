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
//require_once 'dblogin.php'; require file not being recognized. not sure why


class MysqlUserRepository implements UserRepositoryInterface
{
    protected $dsn;
    protected $username;
    protected $password;
    protected $db_server;



    public function __construct(){

        // wasnt able to use the require statement to use the dblogin.php file which is a config file.
        // so i am hardcoding the mysql here which is bad practice but for time im figuring it out
        $this->dsn = '127.0.0.1:8889';
        $this->password = 'python2';
        $this->username = 'root';

        $this->db_server = mysql_connect('127.0.0.1:8889', 'root', 'python2');
        if(!$this->db_server)die("Can't connect to the database yo:". mysql_error());
        mysql_select_db('formdb')or die("Can't select that database mane:". mysql_error());
    }


    public function __destruct()
    {
        //mysql_close($this->db_server);
    }
    /**
     * @param User $user
     * @return mixed
     */
    public function add(User $user)
    {
        $userID = $user->getUserID();
        $userName = $user->getUserName();
        $userPassword = $user->getPassword();
        $userFirst = $user->getFirstName();
        $userLast = $user->getLastName();
        $userEmail = $user->getEmail();

        $query = "INSERT INTO USERS(UserID, UserName, UserPassword, UserFirst, UserLast, UserEmail) VALUES('$userID', '$userName', '$userPassword', '$userFirst', '$userLast', '$userEmail') ";

        mysql_query($query) or die("Database access failed: " . mysql_error());
    }

    public function getUsers()
    {
        $query = "SELECT * FROM USERS";

        $result = mysql_query($query);
        if(!result) die ("Database access failed: " . mysql_error());

        $users = [];

        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            $userID = new Uuid($row['UserID']);
            $user = new User($userID, $row['UserName'], $row['UserPassword'], $row['UserEmail'], $row['UserFirst'], $row['UserLast']);


            $users[$user->getUserID()] = $user;
            //die(print_r(json_encode($users,true)));
        }

        return $users;
    }

    public function modify($userID,
        $newFirstName = '',
        $newLastName = '',
        $newPassword = '',
        $newEmail = '',
        $newUsername = '')
    {
        if($this->containsUser($userID) == false)
        {
            return false;
        }

        $id = $userID->__toString();

        $setStatement = 'UPDATE USERS SET ';

        // i know youre going to hate me but time is running out here

        $flag = false;

        if ($newFirstName != '') {
           $setStatement .=  " UserFirst='$newFirstName'" ;

            $flag = true;
        }
        if ($newLastName != '') {
            if($flag)
            {
                $setStatement .= ', ';
            }
            $setStatement  .=  " UserLast='$newLastName'" ;
            $flag = true;
        }
        if ($newPassword != '') {

            if($flag)
            {
                $setStatement .= ', ';
            }
            $setStatement .= "UserPassword='$newPassword'" ;
            $flag = true;
        }
        if ($newEmail != '') {
            if($flag)
            {
                $setStatement .= ', ';
            }
            $setStatement  .=  "UserEmail='$newEmail'" ;
            $flag = true;
        }
        if ($newUsername != '') {
            if($flag)
            {
                $setStatement .= ', ';
            }
            $setStatement  .=  "UserName='$newUsername'" ;
        }

        $whereStatement = " WHERE UserID= '$id'";

        $query = $setStatement . $whereStatement;

        mysql_query($query);

        return true;
    }


    /**
     * @param \Notes\Domain\ValueObject\Uuid $id
     * @return bool
     */
    public function removeById(Uuid $id)
    {
        $userID = $id->__toString();
        $query = "DELETE FROM USERS WHERE UserID = '$userID'";
        mysql_query($query);

        return $this;
    }

    public function count()
    {
        $query = 'SELECT COUNT(*) FROM USERS';

        $result = mysql_query($query);
        if(!result) die ("Database access failed: " . mysql_error());


        //$resultArray = $result->fetch_array();

        // if this doesnt work then use a count function
        return (int) mysql_result($result, 0);
    }

    public function getUser($userID)
    {
        $id = $userID->__toString();


        $query = "SELECT UserID, UserName, UserPassword, UserFirst, UserLast, UserEmail  FROM USERS WHERE UserID= '$id'";

        $result = mysql_query($query);
        if(!result) die ("Database access failed: " . mysql_error());

        $inuserID = new Uuid(mysql_result($result, 0, 'UserID'));
        $user = new User($inuserID, mysql_result($result, 0, 'UserName'), mysql_result($result, 0, 'UserPassword'), mysql_result($result, 0, 'UserEmail'), mysql_result($result, 0, 'UserFirst'), mysql_result($result, 0, 'UserLast'));

        return $user;
    }

    /**
     * @param \Notes\Domain\ValueObject\Uuid $id
     * @return bool
     */
    public function containsUser($userID)
    {
        $id = $userID->__toString();


        $query = "SELECT * FROM USERS WHERE UserID= '$id'";

        $result = mysql_query($query);
        if(!result) die ("Database access failed: " . mysql_error());

        $rows = mysql_num_rows($result);

        if($rows > 0)
        {
            return true;
        }

        return false;
    }
}
