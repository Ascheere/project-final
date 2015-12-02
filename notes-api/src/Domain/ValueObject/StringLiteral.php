<?php

namespace Notes\Domain\ValueObject;

/**
 * Class StringLiteral
 * @package Notes\Domain\ValueObject
 */
class StringLiteral
{
	const EMPTY_STR = '';

	/** @var string */ 
	protected $value;

    /**
     * @param string $value
     */
	public function __construct($value = self::EMPTY_STR) // if no value is put in then it fills the value with an empty string
	{
		if(!is_string($value))
		{
			throw new \InvalidArgumentException(
				__METHOD__ . '(): $value must be a string'
				);
		}

		$this->value = $value;
	}

    /**
     * @return string
     */
	public function __toString()
	{
		return $this->value;
	}
}
