<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/24/15
 * Time: 6:14 PM
 */

namespace Notes\Db\Adapter;
use PDO;
use Prophecy\Exception\Exception;

class PdoAdapter implements RdbmsAdapterInterface
{
    // don't need stringliterals for these because its a wrapper class to the pdo method
    protected $dsn;
    protected $username;
    protected $password;
    protected $pdo;


    public function __construct($dsn, $username, $password)
    {
        $this->dsn = $dsn;
        $this->password = $password;
        $this->username = $username;
    }


    public function connect()
    {
        try{
            $this->pdo = new \PDO($this->dsn, $this->username, $this->password);
        }catch(Exception $e)
        {
            die($e->getCode() . ": " . $e->getMessage());
        }

    }

    public function close()
    {
        unset($this->pdo);
    }

    public function delete($table, $criteria)
    {
        // TODO: Implement delete() method.
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }

    public function insert($table, $data)
    {
        // TODO: Implement insert() method.
    }

    public function update($table, $data, $criteria)
    {
        // TODO: Implement update() method.
    }

    public function select($table, $criteria)
    {
        // TODO: Implement select() method.
    }

    public function sql($sql)
    {
        // TODO: Implement sql() method.
    }
}
