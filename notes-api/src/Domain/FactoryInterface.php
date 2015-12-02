<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/17/15
 * Time: 6:07 PM
 */

namespace Notes\Domain;


interface FactoryInterface
{
    /**
     * @return mixed
     */
    public function create();
}
