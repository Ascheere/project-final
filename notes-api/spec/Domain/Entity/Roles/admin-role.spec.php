<?php
/**
 * Created by PhpStorm.
 * User: andrewscheerenberger
 * Date: 11/19/15
 * Time: 11:29 PM
 */
use Notes\Domain\Entity\UserGroup\Admin;
use Notes\Domain\ValueObject\Uuid;
use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\StringLiteral;
use Notes\Domain\Entity\Roles\AdminRole;


describe('Notes\Domain\Entity\Roles\AdminRole', function() {
    describe('->__construct()', function () {
        it('should return a Admin object', function () {
            $actual = new AdminRole();

            expect($actual)->to->be->instanceof('Notes\Domain\Entity\Roles\AdminRole');
        });
    });

        // this tests what exists of this class atm im not sure if i will  have to add the other methods to it later or if im on the right track
        describe('->__construct(params)', function () {
            it('should return a AdminRole object', function () {
                $roleID = new Uuid();
                $name = "Full admins";
                $createPermission = true;
                $deletePermission = true;

                $permissions = array("Can Create" => $createPermission, "Can Delete" => $deletePermission);

                $actual = new AdminRole($roleID, $name, $createPermission, $deletePermission);

                expect($actual)->to->be->instanceof('Notes\Domain\Entity\Roles\AdminRole');

                expect($actual->getID())->equal($roleID->__toString());

                expect($actual->getPermissions())->equal($permissions);

                expect($actual->getName())->equal($name);
            });
        });

}); // end tests
