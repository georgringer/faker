<?php

namespace GeorgRinger\Faker\Generator;

use Faker\Factory;
use Faker\Generator;
use GeorgRinger\Faker\Property\PropertyInterface;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Runner implements SingletonInterface
{

    /** @var DataHandler */
    protected $dataHandler;

    /** @var string */
    protected $table;

    /** @var int */
    protected $pid;

    /** @var Generator */
    protected $faker;

    /**
     * Runner constructor.
     * @param string $table
     * @param int $pid
     * @param string $locale
     */
    public function __construct($table, $pid, $locale)
    {
        $this->dataHandler = GeneralUtility::makeInstance(DataHandler::class);
        $this->table = $table;
        $this->pid = $pid;
        $this->faker = Factory::create($locale);
    }

    /**
     * @param int $amount
     * @return void
     */
    public function execute($amount = 1)
    {
        $dataMap = [];
        for ($i = 1; $i <= $amount; $i++) {
            $dataMap[$this->table]['NEW' . $i] = $this->createRecordFields();
        }

        $GLOBALS['BE_USER']->user['admin'] = true;
        $this->dataHandler->start($dataMap, []);
        $this->dataHandler->admin = true;
        $this->dataHandler->bypassWorkspaceRestrictions = true;
        $this->dataHandler->process_datamap();
    }

    /**
     * @return array
     */
    protected function createRecordFields()
    {
        $filled = [
            'pid' => $this->pid
        ];

        foreach ($this->getFakerFields() as $name => $config) {
            if (!empty($config['pid']) && $config['pid'] === 'current') {
                $config['pid'] = $this->pid;
            }

            /** @var PropertyInterface $property */
            $property = GeneralUtility::makeInstance($config['type']);
            $filled[$name] = $property->generate($this->faker, $config);
        }
        return $filled;
    }

    /**
     * @return array
     */
    protected function getFakerFields()
    {
        $fields = [];
        foreach ($GLOBALS['TCA'][$this->table]['columns'] as $name => $field) {
            if (isset($field['faker'])) {
                $fields[$name] = $field['faker'];
            }

            // Workaround so DataHandler doesn't set crdate to $GLOBALS['EXEC_TIME']
            if ($GLOBALS['TCA'][$this->table]['ctrl']['crdate'] &&
                $GLOBALS['TCA'][$this->table]['ctrl']['crdate'] == $name) {
                unset($GLOBALS['TCA'][$this->table]['ctrl']['crdate']);
            }
        }

        return $fields;
    }
}