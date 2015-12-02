<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/24/15
 * Time: 6:47 PM
 */


use Notes\Persistence\Entity\MysqlUserRepository;
use Notes\Domain\Entity\UserFactory;

describe( 'Notes\Persistence\Entity\MysqlUserRepository', function() {
    beforeEach(function(){
        $this->repo = new MysqlUserRepository();
        $this->userFactory = new UserFactory();
    });
    describe('->__constructr()', function() {
        it('should construct an MysqlUserRepository object', function() {
            expect($this->repo)->to->be->instanceof('Notes\Persistence\Entity\MysqlUserRepository');
        });
    });
    describe('->add()', function() {
        it('Should add 1 user to the repository', function() {
            $this->repo->add($this->userFactory->create());

            expect($this->repo->count())->to->equal(1); // this is an acceptable way to test an add
        });
    });

    describe('->getByUsername()', function() {
        it('Should return a single User object', function() {
            /**
             * @var \Notes\Domain\Entity\User $user
             */
            $user = $this->userFactory->create();
            $user->setUsername(new \Notes\Domain\ValueObject\StringLiteral('harrie'));

            $this->repo->add($user);

            $actual =  $this->repo->getByUsername('harrie');

            expect($actual)->to->be->instanceof('Notes\Domain\Entity\User');
            expect($actual->getUsername())->to->be->equal(new StringLiteral('harrie'));
        });
    });
    /*
     public function add(User $user);
     public function getByUsername($username);
     public function getUsers();
     public function modify(User $user);
     public function remove(User $user);
     public function removeByUsername($username);
    */
});
