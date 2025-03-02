<?php

namespace GeorgRinger\Faker\Tests\Functional\Command;

use GeorgRinger\Faker\Command\FakerCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;
use TYPO3\CMS\Core\Localization\LanguageServiceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

class FakerCommandTest extends FunctionalTestCase
{
    protected CommandTester $commandTester;

    protected array $testExtensionsToLoad = [
        'typo3conf/ext/faker',
        'typo3conf/ext/news',
    ];

    public static function fakerInstractionDataProvider(): iterable
    {
        yield 'Categories' => [
            'tableName' => 'sys_category',
            'amount' => 10,
            'columns' => [
                'text' => ['title'],
            ],
        ];
        yield 'Frontend Users' => [
            'tableName' => 'fe_users',
            'amount' => 1,
            'columns' => [
                'text' => [
                    'username',
                    'password',
                    'name',
                    'first_name',
                    'last_name',
                    'address',
                    'telephone',
                    'email',
                    'zip',
                    'city',
                    'country',
                    'www',
                ],
            ],
        ];
        yield 'News' => [
            'tableName' => 'tx_news_domain_model_news',
            'amount' => 5,
            'columns' => [
                'text' => ['title', 'teaser', 'bodytext', 'author'],
                'relation' => ['categories'],
                'date' => ['datetime'],
            ],
        ];
    }

    /**
     * @dataProvider fakerInstractionDataProvider
     */
    public function testFakerCommand(string $tableName, int $amount, array $columns): void
    {
        $this->commandTester->execute([
            'table' => $tableName,
            'pid' => '2',
            'amount' => (string)$amount,
        ]);

        $qb = $this->getConnectionPool()->getQueryBuilderForTable($tableName);
        $records = $qb->select('*')
            ->from($tableName)
            ->executeQuery()
            ->fetchAllAssociative();

        self::assertEquals(Command::SUCCESS, $this->commandTester->getStatusCode());
        self::assertCount($amount, $records);

        $record = $records[0];
        foreach ($columns['text'] ?? [] as $textField) {
            self::assertIsString($record[$textField]);
            self::assertNotEmpty($record[$textField]);
        }
        foreach ($coumns['relation'] ?? [] as $relationField) {
            self::assertIsInt($record[$relationField]);
            self::assertGreaterThan(0, $record[$relationField]);
        }
        foreach ($coumns['date'] ?? [] as $dateField) {
            self::assertIsInt($record[$dateField]);
            self::assertGreaterThan(0, $record[$dateField]);
        }
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->importCSVDataSet(__DIR__ . '/../Fixtures/pages.csv');
        $this->importCSVDataSet(__DIR__ . '/../Fixtures/be_users.csv');
        $this->setUpBackendUser(1);

        $languageFactory = GeneralUtility::makeInstance(LanguageServiceFactory::class);
        $GLOBALS['LANG'] = $languageFactory->create('en');

        $command = GeneralUtility::makeInstance(FakerCommand::class);
        $this->commandTester = new CommandTester($command);
    }
}