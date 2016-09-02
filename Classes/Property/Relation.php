<?php

namespace GeorgRinger\Faker\Property;

use Faker\Generator;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Database\DatabaseConnection;

class Relation implements PropertyInterface
{
    static public function getSettings(array $configuration = [])
    {
        return [
            'type' => self::class,
            'table' => $configuration['table'],
            'pid' => $configuration['pid'],
            'min' => $configuration['min'],
            'max' => $configuration['max'],
        ];
    }

    public function generate(Generator $faker, array $configuration = [])
    {
        return $value = $this->getRelationUids($configuration);
    }


    protected function getRelationUids(array $configuration)
    {
        $table = $configuration['table'];
        $rows = $this->getDatabaseConnection()->exec_SELECTgetRows(
            'uid',
            $table,
            'pid=' . (int)$configuration['pid'] . BackendUtility::deleteClause($table)
        );
        $list = [];
        foreach ($rows as $row) {
            $list[] = $row['uid'];
        }
        $randList = $this->array_random($list, rand($configuration['min'], $configuration['max']));
        if (is_array($randList)) {
            return implode(',', $randList);
        }
        return '';
    }

    protected function array_random($arr, $num = 1)
    {
        if ($num === 0) {
            return [];
        }
        shuffle($arr);

        $r = array();
        for ($i = 0; $i < $num; $i++) {
            $r[] = $arr[$i];
        }
        return $num == 1 ? $r[0] : $r;
    }

    /**
     * @return DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }
}