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
            'expect' => 10,
            'columns' => [
                'text' => ['title'],
            ],
        ];
        yield 'Frontend Users' => [
            'tableName' => 'fe_users',
            'expect' => 5,
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
            'expect' => 5,
            'columns' => [
                'text' => ['title', 'teaser', 'bodytext', 'author'],
                'relation' => ['categories'],
                'date' => ['datetime'],
            ],
        ];
    }

    public static function fakerSeedDataProvider(): iterable
    {
        yield 'Categories' => [
            'tableName' => 'sys_category',
            'seed' => 1234,
            'columns' => [
                'title' => 'eius',
            ],
        ];
        yield 'Frontend Users' => [
            'tableName' => 'fe_users',
            'seed' => 1234,
            'columns' => [
                'username' => 'gbailey',
                'name' => 'Ashly Rempel',
                'first_name' => 'Chadrick',
                'middle_name' => '',
                'last_name' => 'Ernser',
                'address' => '80841 Mya Lane Apt. 042',
                'telephone' => '+1-432-214-4902',
                'email' => 'alayna44@example.org',
                'zip' => '07365',
                'city' => 'Careymouth',
                'country' => 'Morocco',
                'www' => 'http://www.stokes.com/tempora-ex-voluptatem-laboriosam-praesentium-quis.html',
            ],
        ];
        yield 'News' => [
            'tableName' => 'tx_news_domain_model_news',
            'seed' => 4321,
            'columns' => [
                'title' => 'Aut quisquam qui ut quasi rerum officia itaque.',
                'teaser' => 'Dolor ea rerum molestiae aut. Perspiciatis iusto et rerum nemo quia ut quaerat. Blanditiis quod doloribus dolorem impedit. Id ipsum ullam architecto eos. Quis ut placeat similique adipisci magnam. Sed iure amet ducimus. Minus architecto ducimus enim ratione. Velit nemo eos reiciendis ad et corrupti. Temporibus nulla qui sunt et non odit veritatis. Ut nihil recusandae nobis qui. Ratione sed rem magni assumenda id nostrum quo. Consequuntur quisquam dignissimos quidem sunt pariatur. Culpa voluptatum aspernatur repudiandae aperiam id tenetur officiis. Et voluptate quam architecto nihil rerum voluptatum a. Qui non molestiae molestiae vero consequatur. Quaerat vel repellat incidunt ducimus qui. Eum ullam in velit ducimus quae. Illum dolor mollitia esse quibusdam impedit distinctio fuga. Natus et hic amet nobis. Iusto quis qui aut quia. Quidem nisi dolore incidunt aliquam molestiae. Explicabo laboriosam quaerat id.',
                'bodytext' => 'Excepturi numquam ratione voluptas quis. Sunt ex sed maxime vitae earum est earum. Odio esse neque debitis quam. Corporis ut inventore sit suscipit sit architecto rem at. Illo consequatur quia unde et voluptatem. Occaecati officiis reprehenderit minima est ut error doloremque ipsam. Soluta dolor molestiae quidem ratione. Sunt animi sit tenetur dolorem laudantium molestiae. Voluptas ipsum assumenda alias. Qui non nihil ea recusandae nobis facilis voluptas. Ratione qui asperiores consequatur iure esse velit at. Tenetur ut vel veritatis consequatur et provident enim. Ipsum atque dicta eligendi. Architecto perferendis ab quia dolorum dolor quas qui aut. Eveniet assumenda provident mollitia veniam ab. Iure dolor placeat voluptas voluptas. Est voluptatem qui at ipsam molestias dolor aliquid. Consequuntur et doloremque beatae unde neque dolor tempore distinctio. Vitae id reprehenderit corrupti quidem tempora. Libero consequatur fugiat est amet veniam vel. Ipsum a quia omnis ea. Quasi sequi amet pariatur id asperiores. Sint inventore et id voluptatem odio quidem ipsam sed. Voluptatem modi libero et et. Voluptas voluptates beatae autem veritatis. Eos sit quibusdam aut exercitationem dolorem. Voluptas impedit aut odit qui aut ut nemo. Ut ut libero vitae et. Odit sed et perferendis in repudiandae. Suscipit debitis molestias vel magni omnis. Eveniet omnis sit sint. Autem consequuntur cum iste ea. Qui unde earum quas eum quis aspernatur sunt reprehenderit. Omnis aperiam itaque dolor optio sed in. Voluptatem aut recusandae possimus non est recusandae porro. Labore repellat eius aliquam. Sapiente quas in qui dignissimos deserunt vitae maiores. Est possimus qui vero officiis iure. Possimus nam beatae repellat aspernatur. Repellat voluptas accusamus praesentium consequatur velit. Necessitatibus doloribus ut aut odio dolorem repudiandae. Velit quo repellendus aperiam occaecati recusandae id repellat in. Itaque ea voluptatem numquam atque quod temporibus. Vel vel aut optio molestiae excepturi dolore dolores quis. Sed inventore in ut voluptas officiis repellat. Neque eos ratione sint dolor excepturi quisquam voluptatem pariatur. Quia officia cum consequatur eum beatae et non sed. Itaque quo fugit repellendus aut temporibus. Natus sint at voluptatem et quasi. Aut est saepe dolores fugit exercitationem. Praesentium eos molestiae eligendi velit ipsam. Illo nam et quia veniam consequatur et. Et illum ab maxime. Sed commodi amet consequuntur velit. Sed velit temporibus sit itaque vel mollitia asperiores. Repudiandae fugit laudantium nemo molestiae perferendis voluptas debitis nemo. Tempore facilis odio eveniet doloremque quos. Rerum et praesentium aliquam ad. Voluptate repellendus sunt asperiores et sit repellat. Dignissimos aut aut ducimus accusantium molestias. Asperiores labore omnis totam est vel laudantium. Qui laudantium laborum non quibusdam esse molestiae. Vero aut quasi accusamus veniam sed. Porro delectus aut possimus nam explicabo aspernatur aliquam totam. Dolorum autem consequatur aspernatur ipsa ut. Reprehenderit ex incidunt consequatur possimus. Debitis et et ut inventore perferendis quidem velit velit. Tenetur rerum culpa odio omnis atque rem. Tempora qui quos ipsa et dicta temporibus debitis aperiam. In porro eos labore quod voluptatem vitae eligendi. Id quia laudantium voluptas rerum culpa aut. Id nisi rerum eius commodi. Perferendis delectus corrupti repellendus sit quia reprehenderit. Perferendis quis ducimus libero. Itaque atque officia deserunt velit laboriosam est. Aut commodi dolorum delectus odit quo voluptates eius. Quae quia eum id. Velit sint voluptate natus odio dolore aspernatur. Repudiandae odit qui reprehenderit earum assumenda. Iure temporibus tempora iusto quia aperiam ducimus sapiente. Et temporibus a doloremque sunt odit. Sit reiciendis laborum voluptate qui sed. Doloremque officiis aut itaque quasi. Enim nisi animi minima quo. Sed aspernatur reiciendis cupiditate porro. Impedit voluptatum dignissimos consectetur dignissimos voluptatibus. Corporis voluptatum a deleniti dolorem. Laboriosam odit odit minus. Eos odit velit qui nihil eos pariatur. Incidunt explicabo ipsa incidunt accusamus eos voluptates. Eaque quaerat deserunt sapiente nostrum. Soluta culpa vel aut sed. Suscipit sunt eaque illo et temporibus consequatur at. Non deleniti error ea laborum eum. Beatae itaque accusamus aut at assumenda. Ratione sequi vel suscipit sunt aliquid. Quae vel cupiditate illo distinctio iure saepe. Sint voluptas quam vero perferendis tempore deserunt sit. Alias magnam culpa dolorem rerum autem. Adipisci aut consequatur laudantium eos commodi neque. Autem alias dolores eaque fugiat debitis ut. Earum maiores fugit dolorem perspiciatis. Odio enim illum itaque ullam impedit et sint. Dolorem et possimus dignissimos a non nam minima sunt. Magni repudiandae dolorem magni. Et eum qui velit neque ipsam cumque veritatis. Tempora illo sint rerum placeat voluptatum. Et ducimus praesentium ea et facere. Ea esse voluptatem qui aperiam qui corporis accusantium voluptate. Quidem aliquid quia ut quidem illo nulla. Possimus sapiente esse sed qui. Occaecati nesciunt tempore vel expedita. Architecto eligendi consequatur repudiandae voluptatem consequuntur est recusandae quidem. Voluptate et repellat esse. Assumenda odio asperiores quis et sequi. Aliquid dolor et et. Natus voluptas numquam quis est. Vitae eveniet ullam nihil quasi quis. Et accusamus totam omnis nihil quia. Sed molestias illo inventore ea. Similique et rerum vel perspiciatis ut quos dicta. Necessitatibus ipsam sed architecto quam. Voluptas placeat ex esse laboriosam. Inventore sit numquam rerum aut optio. Iure aperiam aut quaerat aut aliquid nihil quo. Occaecati deleniti eos dolores error vitae ut doloribus. Repellendus eaque est ex voluptates. Sequi nulla aut qui neque quae. Odio et quae officia quia incidunt autem odit. Debitis ut deleniti eos explicabo. Sunt deserunt corporis deleniti consequuntur. Sapiente magni perspiciatis est id quia. Totam consequatur quo consequuntur veniam. Cumque qui nisi modi velit repellat et. Aut asperiores architecto delectus atque. Architecto aliquam quis et. Molestiae fuga illum molestiae ipsam quia voluptas officia.',
                'author' => 'Kellen Hermiston',
                'categories' => 5,
            ],
        ];
    }

    /**
     * @dataProvider fakerInstractionDataProvider
     */
    public function testFakerCommand(string $tableName, int $expect, array $columns): void
    {
        $this->commandTester->execute([
            'table' => $tableName,
            'pid' => '2',
            'amount' => '5',
        ]);

        $qb = $this->getConnectionPool()->getQueryBuilderForTable($tableName);
        $records = $qb->select('*')
            ->from($tableName)
            ->executeQuery()
            ->fetchAllAssociative();

        self::assertEquals(Command::SUCCESS, $this->commandTester->getStatusCode());
        self::assertCount($expect, $records);

        $record = $records[0];
        foreach ($columns['text'] ?? [] as $textField) {
            self::assertIsString($record[$textField]);
            self::assertNotEmpty($record[$textField]);
        }
        foreach ($columns['relation'] ?? [] as $relationField) {
            self::assertIsInt($record[$relationField]);
            self::assertLessThanOrEqual(5, $record[$relationField]);
        }
        foreach ($columns['date'] ?? [] as $dateField) {
            self::assertIsInt($record[$dateField]);
            self::assertGreaterThan(0, $record[$dateField]);
        }
    }

    /**
     * @dataProvider fakerSeedDataProvider
     */
    public function testFakerSeedCommand(string $tableName, int $seed, array $columns): void
    {
        $this->commandTester->execute([
            'table' => $tableName,
            'pid' => '2',
            'amount' => '1',
            'locale' => 'en_US',
            'seed' => (string)$seed,
        ]);

        $qb = $this->getConnectionPool()->getQueryBuilderForTable('sys_category');
        $record = $qb->select('*')
            ->from($tableName)
            ->orderBy('uid', 'DESC')
            ->setMaxResults(1)
            ->executeQuery()
            ->fetchAssociative();

        self::assertEquals(Command::SUCCESS, $this->commandTester->getStatusCode());
        foreach ($columns as $field => $value) {
            self::assertEquals($value, $record[$field]);
        }
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->importCSVDataSet(__DIR__ . '/../Fixtures/pages.csv');
        $this->importCSVDataSet(__DIR__ . '/../Fixtures/be_users.csv');
        $this->importCSVDataSet(__DIR__ . '/../Fixtures/sys_category.csv');
        $this->setUpBackendUser(1);

        $languageFactory = GeneralUtility::makeInstance(LanguageServiceFactory::class);
        $GLOBALS['LANG'] = $languageFactory->create('en');

        $command = GeneralUtility::makeInstance(FakerCommand::class);
        $this->commandTester = new CommandTester($command);
    }
}