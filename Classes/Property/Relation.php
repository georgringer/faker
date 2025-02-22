<?php

namespace GeorgRinger\Faker\Property;

use Faker\Generator;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Relation implements PropertyInterface
{
    static public function getSettings(array $configuration = []): array
    {
        return [
            'type' => self::class,
            'table' => $configuration['table'] ?? null,
            'pid' => isset($configuration['pid']) ? $configuration['pid'] : 'current',
            'min' => $configuration['min'] ?? 0,
            'max' => $configuration['max'] ?? 99,
        ];
    }

    public function generate(Generator $faker, array $configuration = [])
    {
        return $value = $this->getRelationUids($configuration);
    }


    protected function getRelationUids(array $configuration): string
    {
        $table = $configuration['table'];

        /** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder$queryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        $queryBuilder->select('uid')->from($table)->where(
            $queryBuilder->expr()->eq('pid', (int)$configuration['pid'])
        );
        $rows= $queryBuilder->execute();

        $list = [];
        foreach ($rows->fetchAllAssociative() as $row) {
            $list[] = $row['uid'];
        }
        $randList = $this->array_random($list, rand($configuration['min'], $configuration['max']));
        if (is_array($randList)) {
            return implode(',', $randList);
        }
        return '';
    }

    /**
     * @param array $arr
     * @param int $num
     *
     * @return array Returns an array with random $num elements from original array
     */
    protected function array_random($arr, $num = 1): array
    {
        if ($num === 0) {
            return [];
        }
        shuffle($arr);

        $r = array();
        for ($i = 0; $i < $num; $i++) {
            $r[] = $arr[$i];
        }
        return $r;
    }
}
