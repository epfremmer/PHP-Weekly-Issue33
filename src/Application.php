<?php
/**
 * File Application.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly;

use PHPWeekly\Command\PrisonerDilemmaCommand;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Command\HelpCommand;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class Application
 *
 * @package PHPWeekly
 */
class Application extends BaseApplication
{
    /**
     * Override getting command name from input with
     * prisoner dilemma command
     *
     * {@inheritdoc}
     */
    protected function getCommandName(InputInterface $input)
    {
        return PrisonerDilemmaCommand::COMMAND_NAME;
    }

    /**
     * Return default application commands including help command
     * to support --help option
     *
     * {@inheritdoc}
     */
    protected function getDefaultCommands()
    {
        return [
            new HelpCommand(),
            new PrisonerDilemmaCommand(),
        ];
    }

    /**
     * Override input definition so application no longer expects
     * first argument as the command name
     *
     * {@inheritdoc}
     */
    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        $inputDefinition->setArguments();

        return $inputDefinition;
    }
}
