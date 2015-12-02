<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/24/15
 * Time: 6:11 PM
 */

namespace Notes\Db\Adapter;


interface RdbmsAdapterInterface extends DbAdapterInterface
{
        public function connect();
        public function close();
        public function delete($table, $criteria);
        public function execute();
        public function insert($table, $data);
        public function update($table, $data, $criteria);
        public function select($table, $criteria);
        public function sql($sql);

}
