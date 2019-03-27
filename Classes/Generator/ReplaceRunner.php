<?php

namespace GeorgRinger\Faker\Generator;

use Faker\Factory;
use Faker\Generator;
use GeorgRinger\Faker\Property\PropertyInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ReplaceRunner implements SingletonInterface
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
     * Execute
     *
     * @return void
     */
    public function execute()
    {
        /** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder$queryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($this->table);
        $queryBuilder->select('*')->from($this->table);

        if ($this->pid > -1) {
            $queryBuilder->where($queryBuilder->expr()->eq('pid', $this->pid));
        }

        $records = $queryBuilder->execute();

        $dataMap = [];
        foreach ($records as $record) {
            $dataMap[$this->table][$record['uid']] = $this->createRecordFields();
        }

        $GLOBALS['BE_USER']->user['admin'] = true;
        $this->dataHandler->start($dataMap, []);
        $this->dataHandler->admin = true;
        $this->dataHandler->process_datamap();
    }

    /**
     * @return array
     */
    protected function createRecordFields()
    {
        $filled = [];
        foreach ($this->getFakerFields() as $name => $config) {
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
            if (isset($field['faker']) && empty($field['fakerDoNotReplace'])) {
                $fields[$name] = $field['faker'];
            }
        }

        return $fields;
    }
}