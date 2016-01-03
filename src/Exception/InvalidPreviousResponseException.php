<?php
/**
 * File InvalidPreviousResponseException.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Exception;

use InvalidArgumentException;

/**
 * Class InvalidPreviousResponseException
 *
 * @package PHPWeekly\Exception
 */
class InvalidPreviousResponseException extends InvalidArgumentException
{
    /**
     * @var string
     */
    private $previousResponse;

    /**
     * @var string
     */
    private $name;

    /**
     * InvalidPreviousResponseException constructor
     *
     * @param string $name
     * @param string $previousResponse
     */
    public function __construct($name, $previousResponse)
    {
        $this->name = $name;
        $this->previousResponse = $previousResponse;

        parent::__construct(sprintf('Invalid previous response provided for %s. Got "%s"', $name, $previousResponse));
    }
}
