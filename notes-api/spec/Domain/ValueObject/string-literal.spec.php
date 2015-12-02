<?php
//create uuid test for version 4 uuid. 

use  Notes\Domain\ValueObject\StringLiteral;

describe('StringLiteral', function(){
	describe('->__construct()', function(){
		it('should return a StringLiteral object', function(){
			$actual = new StringLiteral();

			expect($actual)->to->be->instanceof('Notes\Domain\ValueObject\StringLiteral');
		});
	});



describe('->__construct("foo")', function(){
	it('should return a StringLiteral object with the value of "foo"', function(){
		$value = 'foo';
		$actual = new StringLiteral($value);


		expect($actual)->to->be->instanceof('Notes\Domain\ValueObject\StringLiteral');

		expect($actual->__toString())->equal($value);

	});
});

describe('->construct(123)', function(){
	it('should return an InvalidArgumentException', function(){
		$value = 123;
		$exception = null; 

		try{
			new StringLiteral($value);
		}catch(Exception $e) {
			$exception = $e;
		}

		expect($exception)->to->be->instanceof(
			'\InvalidArgumentException'
			);
	});
});
describe('->__toString()', function() {
	it('should return the default', function(){
		$actual = new StringLiteral();

		expect($actual->__toString())->equal('');
		expect($actual->__toString())->empty();

	});
	it('should return "foo"', function() {
		$value = 'foo';
		$actual = new StringLiteral($value);


		expect($actual)->to->be->instanceof('Notes\Domain\ValueObject\StringLiteral');

		expect($actual->__toString())->equal($value);

	});
});
 
});
