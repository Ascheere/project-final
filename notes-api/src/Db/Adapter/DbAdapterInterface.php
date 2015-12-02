<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/24/15
 * Time: 6:30 PM
 */

namespace Notes\Db\Adapter;


interface DbAdapterInterface
{
    public function connect();
    public function close();
}
