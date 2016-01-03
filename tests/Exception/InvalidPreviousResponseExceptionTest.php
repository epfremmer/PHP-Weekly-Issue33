<?php
/**
 * File InvalidPreviousResponseExceptionTest.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Tests\Exception;

use PHPWeekly\Exception\InvalidPreviousResponseException;

/**
 * Class InvalidPreviousResponseExceptionTest
 *
 * @package PHPWeekly\Tests\Exception
 */
class InvalidPreviousResponseExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $exception = new InvalidPreviousResponseException('epfremme', 'not_silent');

        $this->assertAttributeEquals('epfremme', 'name', $exception);
        $this->assertAttributeEquals('not_silent', 'previousResponse', $exception);
        $this->assertContains('epfremme', $exception->getMessage());
        $this->assertContains('not_silent', $exception->getMessage());
    }
}
