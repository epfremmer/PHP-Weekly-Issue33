<?php
/**
 * File PrisonerDilemmaCommand.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Command;

use PHPWeekly\Exception\InvalidPreviousResponseException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PrisonerDilemmaCommand
 *
 * @package PHPWeekly\Command
 */
class PrisonerDilemmaCommand extends Command
{
    const COMMAND_NAME = 'prisoner-dilemma';

    const I_AINT_NO_RAT = 'silent';
    const FOLD_LIKE_A_LAWN_CHAIR = 'confess';

    const YOUR_NAME = 'epfremme';
    const YOUR_DISCIPLINE = 'php';
    const YOUR_PREVIOUS_RESPONSE = 'yourPreviousResponse';
    const PARTNER_NAME = 'partnerName';
    const PARTNER_DISCIPLINE = 'partnerDiscipline';
    const PARTNER_PREVIOUS_RESPONSE = 'partnerPreviousResponse';

    private $validResponses = [
        self::I_AINT_NO_RAT,
        self::FOLD_LIKE_A_LAWN_CHAIR,
    ];

    protected function configure()
    {
        parent::configure();

        $this->setName(self::COMMAND_NAME)
            ->setDescription('Determines whether to confess to the accused crime')
            ->addArgument(
                self::PARTNER_NAME,
                InputArgument::REQUIRED,
                'Partner in crime'
            )
            ->addArgument(
                self::PARTNER_DISCIPLINE,
                InputArgument::REQUIRED,
                'Partner in crime\'s discipline'
            )
            ->addArgument(
                self::PARTNER_PREVIOUS_RESPONSE,
                InputArgument::OPTIONAL,
                'Partner previous response'
            )
            ->addArgument(
                self::YOUR_PREVIOUS_RESPONSE,
                InputArgument::OPTIONAL,
                'Your previous response'
            );
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $partnerName = $input->getArgument(self::PARTNER_NAME);
        $yourPreviousResponse = $input->getArgument(self::YOUR_PREVIOUS_RESPONSE);
        $partnerPreviousResponse = $input->getArgument(self::PARTNER_PREVIOUS_RESPONSE);

        if ($partnerPreviousResponse && !in_array($partnerPreviousResponse, $this->validResponses)) {
            throw new InvalidPreviousResponseException($partnerName, $partnerPreviousResponse);
        }

        if ($yourPreviousResponse && !in_array($yourPreviousResponse, $this->validResponses)) {
            throw new InvalidPreviousResponseException(self::YOUR_NAME, $yourPreviousResponse);
        }

        if ($partnerPreviousResponse && !$yourPreviousResponse) {
            throw new \InvalidArgumentException(sprintf('Missing argument "%s"', self::YOUR_PREVIOUS_RESPONSE));
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $previousResponse = $input->getArgument(self::PARTNER_PREVIOUS_RESPONSE);

        if (!$previousResponse) {
            return $output->writeln(self::I_AINT_NO_RAT);
        }

        return $output->writeln($previousResponse);
    }
}
