<?php
/**
 * File PrisonerDilemmaCommandTest.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Tests\Command;

use PHPWeekly\Application;
use PHPWeekly\Command\PrisonerDilemmaCommand;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class PrisonerDilemmaCommandTest
 *
 * @package PHPWeekly\Tests\Command
 */
class PrisonerDilemmaCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CommandTester
     */
    private $commandTester;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $application = new Application();
        $command = $application->find(PrisonerDilemmaCommand::COMMAND_NAME);

        $this->commandTester = new CommandTester($command);
    }

    public function testExecute()
    {
        $this->commandTester->execute(array(
            PrisonerDilemmaCommand::PARTNER_NAME => 'jdoe',
            PrisonerDilemmaCommand::PARTNER_DISCIPLINE => 'php',
        ));

        $this->assertEquals(PrisonerDilemmaCommand::I_AINT_NO_RAT . PHP_EOL, $this->commandTester->getDisplay());
    }

    public function testExecuteWithPreviousSilence()
    {
        $this->commandTester->execute(array(
            PrisonerDilemmaCommand::PARTNER_NAME => 'jdoe',
            PrisonerDilemmaCommand::PARTNER_DISCIPLINE => 'php',
            PrisonerDilemmaCommand::PARTNER_PREVIOUS_RESPONSE => PrisonerDilemmaCommand::I_AINT_NO_RAT,
            PrisonerDilemmaCommand::YOUR_PREVIOUS_RESPONSE => PrisonerDilemmaCommand::FOLD_LIKE_A_LAWN_CHAIR,
        ));

        $this->assertEquals(PrisonerDilemmaCommand::I_AINT_NO_RAT . PHP_EOL, $this->commandTester->getDisplay());
    }

    public function testExecuteWithPreviousConfession()
    {
        $this->commandTester->execute(array(
            PrisonerDilemmaCommand::PARTNER_NAME => 'jdoe',
            PrisonerDilemmaCommand::PARTNER_DISCIPLINE => 'php',
            PrisonerDilemmaCommand::PARTNER_PREVIOUS_RESPONSE => PrisonerDilemmaCommand::FOLD_LIKE_A_LAWN_CHAIR,
            PrisonerDilemmaCommand::YOUR_PREVIOUS_RESPONSE => PrisonerDilemmaCommand::FOLD_LIKE_A_LAWN_CHAIR,
        ));

        $this->assertEquals(PrisonerDilemmaCommand::FOLD_LIKE_A_LAWN_CHAIR . PHP_EOL, $this->commandTester->getDisplay());
    }

    /** @expectedException \PHPWeekly\Exception\InvalidPreviousResponseException */
    public function testInvalidPreviousPartnerResponseException()
    {
        $this->commandTester->execute(array(
            PrisonerDilemmaCommand::PARTNER_NAME => 'jdoe',
            PrisonerDilemmaCommand::PARTNER_DISCIPLINE => 'php',
            PrisonerDilemmaCommand::PARTNER_PREVIOUS_RESPONSE => 'invalid',
            PrisonerDilemmaCommand::YOUR_PREVIOUS_RESPONSE => PrisonerDilemmaCommand::I_AINT_NO_RAT,
        ));
    }

    /** @expectedException \PHPWeekly\Exception\InvalidPreviousResponseException */
    public function testInvalidPreviousYourResponseException()
    {
        $this->commandTester->execute(array(
            PrisonerDilemmaCommand::PARTNER_NAME => 'jdoe',
            PrisonerDilemmaCommand::PARTNER_DISCIPLINE => 'php',
            PrisonerDilemmaCommand::PARTNER_PREVIOUS_RESPONSE => PrisonerDilemmaCommand::I_AINT_NO_RAT,
            PrisonerDilemmaCommand::YOUR_PREVIOUS_RESPONSE => 'invalid',
        ));
    }

    /** @expectedException \InvalidArgumentException */
    public function testMissingYourPreviousResponseException()
    {
        $this->commandTester->execute(array(
            PrisonerDilemmaCommand::PARTNER_NAME => 'jdoe',
            PrisonerDilemmaCommand::PARTNER_DISCIPLINE => 'php',
            PrisonerDilemmaCommand::PARTNER_PREVIOUS_RESPONSE => PrisonerDilemmaCommand::I_AINT_NO_RAT,
        ));
    }
}
