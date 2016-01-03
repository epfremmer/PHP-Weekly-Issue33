<?php
/**
 * File ApplicationTest.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Tests;

use PHPWeekly\Application;
use PHPWeekly\Command\PrisonerDilemmaCommand;

/**
 * Class ApplicationTest
 *
 * @package PHPWeekly\Tests
 */
class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $application = new Application();

        $this->assertInstanceOf(PrisonerDilemmaCommand::class, $application->find(PrisonerDilemmaCommand::COMMAND_NAME));
    }

    public function testGetDefinition()
    {
        $application = new Application();

        $this->assertAttributeEmpty('arguments', $application->getDefinition());
    }
}
