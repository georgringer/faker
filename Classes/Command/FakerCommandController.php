<?php

namespace GeorgRinger\Faker\Command;

use Faker\Factory;
use GeorgRinger\Faker\Generator\ReplaceRunner;
use GeorgRinger\Faker\Generator\Runner;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

class FakerCommandController extends CommandController
{
    /**
     * Generate dummy data
     *
     * @param string $table table name
     * @param int $pid page id
     * @param string $locale locale
     * @param int $amount
     */
    public function runCommand($table, $pid, $amount, $locale = Factory::DEFAULT_LOCALE)
    {
        $this->checkValidTableName($table);
        $this->executeFaker($table, $pid, $locale, $amount);
    }

    /**
     * Replace existing data with dummy data
     *
     * @param string $table table name
     * @param int $pid page id
     * @param string $locale locale
     */
    public function replaceCommand($table, $pid = -1, $locale = Factory::DEFAULT_LOCALE)
    {
        $this->checkValidTableName($table);
        $this->executeReplaceFaker($table, $pid, $locale);
    }

    /**
     * @param string $table
     * @param int $pid
     * @param string $locale
     * @param $amount
     */
    protected function executeFaker($table, $pid, $locale, $amount)
    {
        /** @var Runner $runner */
        $runner = GeneralUtility::makeInstance(Runner::class, $table, $pid, $locale);
        $runner->execute($amount);
    }

    /**
     * @param string $table
     * @param int $pid
     * @param string $locale
     */
    protected function executeReplaceFaker($table, $pid, $locale)
    {
        /** @var ReplaceRunner $runner */
        $runner = GeneralUtility::makeInstance(ReplaceRunner::class, $table, $pid, $locale);
        $runner->execute();
    }

    /**
     * @param string $table
     */
    protected function checkValidTableName($table)
    {
        if (!isset($GLOBALS['TCA'][$table])) {
            $this->outputLine('<error>The table name "%s" is not valid!</error>', [$table]);
            $this->sendAndExit();
            return;
        }
        if (!(bool)$GLOBALS['TCA'][$table]['ctrl']['faker']) {
            $this->outputLine('<error>The table "%s" is not enabled for faker!</error>', [$table]);
            $this->sendAndExit();
            return;
        }
        $countOfFakerFields = 0;
        foreach ($GLOBALS['TCA'][$table]['columns'] as $field) {
            if (isset($field['faker']) && (bool)$field['faker'] === true) {
                $countOfFakerFields++;
            }
        }
        if ($countOfFakerFields === 0) {
            $this->outputLine('<error>The table "%s" got now fields enabled for faker!</error>', [$table]);
            $this->sendAndExit();
        }
    }
}