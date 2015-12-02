<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/24/15
 * Time: 6:10 PM
 */
use Notes\Db\Adapter\PdoAdapter;

describe('Notes\Db\Adapter\PdoAdapter', function() {
    beforeEach(function (){
        $this->dsn = 'mysql:dbname=testdb; host=127.0.0.1';
        $this->username = 'joe';;
        $this->password = "1234pass";


        // code to create the database and tables and datain the table!

    });

   describe('->__construct()', function() {
        it('should return a pdoadapter object', function() {
            $actual = new PdoAdapter($this->dsn, $this->username, $this->password);

            expect($actual)->to->be->instanceof('Notes\Db\Adapter\PdoAdapter');
        });
   });

    describe('->delete()', function(){
        it('it should delete the correct row', function() {
            $actual = new PdoAdapter($this->dsn, $this->username, $this->password);


        });
    });
});
