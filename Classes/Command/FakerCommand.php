<?php

namespace GeorgRinger\Faker\Command;

use Faker\Factory;
use GeorgRinger\Faker\Generator\ReplaceRunner;
use GeorgRinger\Faker\Generator\Runner;
use Symfony\Component\Console\Input\InputOption;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FakerCommand extends Command
{
    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * Configure the command by defining the name, options and arguments
     */
    protected function configure(): void
    {
        $this->setDescription('Generates fake test data.')
            ->setHelp('Generates database entries with fake data using Faker engine.')
            ->addOption(
                'replace',
                'r',
                InputOption::VALUE_NONE,
                'Choose to replace existing records with fake data.')
            ->addArgument(
                'table',
                InputArgument::REQUIRED,
                'The table to process'
            )->addArgument(
                'pid',
                InputArgument::OPTIONAL,
                'The page id where to generate (or replace) the records'
            )->addArgument(
                'amount',
                InputArgument::OPTIONAL,
                'The amount of records to generate (default: 1)'
            )->addArgument(
                'locale',
                InputArgument::OPTIONAL,
                'The locale to generate records for'
            )->addArgument(
                'seed',
                InputArgument::OPTIONAL,
                'Seed for the random number generator to produce the same results on each run'
            );
    }

    /**
     * @param $string
     * @param $arguments
     */
    protected function outputLine($message, $arguments = null): void
    {
        $this->output->writeln(vsprintf($message, $arguments));
    }

    /**
     * Executes the command for showing sys_log entries
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int error code
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->output = new SymfonyStyle($input, $output);

        $locale = $input->getArgument('locale') ?: Factory::DEFAULT_LOCALE;
        $amount = $input->getArgument('amount') ?: 1;
        $pid = $input->getArgument('pid') ?: -1;
        $table = $input->getArgument('table');
        $seed = $input->getArgument('seed') ?: 0;

        \TYPO3\CMS\Core\Core\Bootstrap::initializeBackendAuthentication();
        if ($input->getOption('replace')) {
            $return = $this->executeReplaceFaker($table, $pid, $locale);
        } else {
            $return = $this->executeFaker($table, $pid, $locale, $amount, $seed);
        }

        return $return ? 0 : 1;
    }

    /**
     * @param string $table
     * @param int $pid
     * @param string $locale
     * @param $amount
     * @param int $seed
     * @return boolean
     */
    protected function executeFaker($table, $pid, $locale, $amount, $seed)
    {
        if (! $this->checkValidTableName($table)) {
            return false;
        }
        /** @var Runner $runner */
        $runner = GeneralUtility::makeInstance(Runner::class, $table, $pid, $locale, $seed);
        $runner->execute($amount);
        return true;
    }

    /**
     * @param string $table
     * @param int $pid
     * @param string $locale
     * @return boolean
     */
    protected function executeReplaceFaker($table, $pid, $locale)
    {
        if (! $this->checkValidTableName($table)) {
            return false;
        }
        /** @var ReplaceRunner $runner */
        $runner = GeneralUtility::makeInstance(ReplaceRunner::class, $table, $pid, $locale);
        $runner->execute();
        return true;
    }

    /**
     * Check if table can be filled with faker data
     *
     * @param string $table
     * @return boolean
     */
    protected function checkValidTableName($table): bool
    {
        if (empty($table)) {
            $this->outputLine('Missing argument: table');
            return false;
        }
        if (!isset($GLOBALS['TCA'][$table])) {
            $this->outputLine('<error>The table name "%s" is not valid!</error>', [$table]);
            return false;
        }
        if (!(bool)$GLOBALS['TCA'][$table]['ctrl']['faker']) {
            $this->outputLine('<error>The table "%s" is not enabled for faker!</error>', [$table]);
            return false;
        }
        $countOfFakerFields = 0;
        foreach ($GLOBALS['TCA'][$table]['columns'] as $field) {
            if (isset($field['faker']) && (bool)$field['faker'] === true) {
                $countOfFakerFields++;
            }
        }
        if ($countOfFakerFields === 0) {
            $this->outputLine('<error>The table "%s" got no fields enabled for faker!</error>', [$table]);
            return false;
        }
        return true;
    }
}
