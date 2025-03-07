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

    public static function fakerInstructionDataProvider(): iterable
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

    public static function seedDataProvider(): iterable
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

    public static function seedPriorPhp83DataProvider(): iterable
    {
        yield 'Categories' => [
            'tableName' => 'sys_category',
            'seed' => 1234,
            'columns' => [
                'title' => 'dolores dolorum amet',
            ],
        ];
        yield 'Frontend Users' => [
            'tableName' => 'fe_users',
            'seed' => 1234,
            'columns' => [
                'username' => 'qkunze',
                'name' => 'Justice Moore',
                'first_name' => 'Orville',
                'middle_name' => '',
                'last_name' => 'Satterfield',
                'address' => '715 Douglas Stravenue',
                'telephone' => '850.553.3310',
                'email' => 'lennie.boyle@example.org',
                'zip' => '50308-3165',
                'city' => 'North Cordie',
                'country' => 'Fiji',
                'www' => 'http://roob.biz/',
            ],
        ];
        yield 'News' => [
            'tableName' => 'tx_news_domain_model_news',
            'seed' => 4321,
            'columns' => [
                'title' => 'Dolor magnam assumenda vel quis ut vel quibusdam.',
                'teaser' => 'Quaerat repellendus enim laboriosam aut quia. Hic aspernatur quo qui autem ratione eum expedita. Aut earum architecto non quasi ab. Iste distinctio earum nam doloribus ipsa dolorum. Enim error sunt beatae fugit. Aut qui animi nulla consequatur aut consequuntur enim. At quo non mollitia placeat et accusantium et repellat. Rerum facere numquam reprehenderit necessitatibus libero sequi. Quis minima rerum consectetur eaque aut et. Similique vero tenetur nostrum itaque qui minus. Molestiae voluptatum consequatur asperiores quod harum adipisci quis. Saepe rerum nulla a ducimus et eos. Quidem veniam nulla exercitationem iusto aut consequatur esse consequuntur. Nemo voluptatem voluptatibus impedit delectus alias cum. Itaque odio enim nam dolorem dignissimos assumenda modi. Optio voluptatum ea iste. Quasi consectetur ut rerum quis.',
                'bodytext' => 'Non culpa doloremque placeat suscipit. Et odio error deleniti est ipsam. Dolor nostrum eveniet sit enim sit voluptatum. Magnam error accusantium et eligendi necessitatibus aut sunt. Ut sint consequatur autem qui consectetur soluta. Mollitia atque nisi est numquam autem. Excepturi reiciendis perspiciatis aspernatur incidunt vitae sunt. Est itaque sed laborum vel sit. Rerum eveniet dolor iste fuga sit magni enim. Occaecati animi ex quia. Consequatur molestiae mollitia culpa labore necessitatibus. Rerum nisi beatae nesciunt voluptas. Eum cumque dolore sunt. Officiis aut illum deleniti voluptatem sed nesciunt. Distinctio et iure dolores dolorum ut eos. Illum voluptatem illum dolorem excepturi quibusdam eos ipsam. Vel dicta commodi fugiat nihil esse delectus. Aut cupiditate porro facere eveniet nihil sit harum. Iure quas sint qui nam cumque similique sint. Non porro veritatis a perferendis voluptate. Aut quidem illum enim minus odit voluptas. Tempora nam ea eaque placeat doloribus aperiam. Explicabo et expedita ea omnis beatae voluptatem. Odit assumenda ut ut doloremque ut. Est modi ut in soluta iure. Iste earum laborum consequatur quaerat consequuntur qui. Voluptas alias non quo saepe et voluptates rerum. Eum reiciendis dolore ad laborum ipsam dolore veniam. Ab est cum itaque fuga. Omnis perspiciatis magnam ut aliquam itaque voluptas nostrum. Sed et accusantium dolorem est doloremque quisquam. Aperiam molestiae velit magnam labore ut unde doloribus. Est consequuntur corporis quia cupiditate est quod omnis. Qui sit incidunt inventore laborum est et odio. Est blanditiis quis consequatur. Impedit id voluptas soluta ea aut ipsum. Qui at qui ipsa in. Magni sint debitis amet fugiat doloribus eos. Amet magni aut et hic dolores placeat libero. Molestias quia aliquid dolores harum tenetur dolores. Quibusdam consequatur rerum qui quaerat suscipit quia. Nesciunt voluptatum dicta necessitatibus. Necessitatibus temporibus iusto nulla. Iusto quo quod eius pariatur voluptatem. Blanditiis consequatur facere nobis esse placeat iste quia. Hic hic sed sed a. A similique nostrum et reiciendis vel autem perferendis. Corrupti dolores accusantium veritatis explicabo corrupti laboriosam. Quia id magni ipsam accusantium delectus qui aliquam aliquid. Consequatur deserunt voluptatem et atque dolor. Est molestias qui quaerat officia ut facere quia. Et quia repudiandae nihil omnis nam. Dolores sed hic quas incidunt quod. Facilis cupiditate aut nemo vitae debitis libero. Et maxime enim et neque ad sed quibusdam. Quia rerum assumenda deserunt voluptatum nobis. Aut sunt dolores rerum laborum officiis aut porro dolorem. Sint magnam quo et recusandae illum rem est qui. Aliquam dolorum veritatis porro autem a. Aspernatur sit cumque iusto repellendus quae repellat quisquam. Aut aut tempora nostrum dolores rerum. Libero eveniet possimus aut id sunt. Nisi fugiat saepe sed libero omnis odit. Qui cupiditate error ut nihil eius. Quisquam quisquam doloremque qui consequuntur ut officia. Sed voluptate non reprehenderit et non et. Assumenda temporibus consequatur iusto et omnis. Totam rem aut omnis non beatae amet. Labore autem ut quae neque perferendis. Dicta rerum quia et aliquid accusamus et vel libero. Tempora id et excepturi sed debitis. A in exercitationem illum ea nisi mollitia ut. Qui commodi aut iusto quia dolores aliquam non. Explicabo consectetur quia est commodi natus. Quis dolorem voluptatem qui id recusandae. Tempore eos magnam non aliquid. Et porro omnis ipsam vel. Velit voluptatem tempore eaque blanditiis et. Et reiciendis sed fugit deserunt quo voluptate. Quis et numquam eum id vitae. Veritatis occaecati provident nisi natus doloribus. Ipsam possimus quod beatae ratione nulla dolor quo. Ea est quia ea sit sint debitis. Voluptatem sit praesentium id cupiditate quidem eum quis rerum. Temporibus et eaque atque vero nam vel. Quaerat commodi nulla molestiae ea. Dolor autem ut fuga illo est. Maxime sed nihil modi consequatur. Maiores sit aut repudiandae culpa. In aperiam harum reiciendis id autem. Eos quae aut voluptatem vero itaque. Similique ducimus qui rerum distinctio aut. Dolorem itaque quaerat nam consequuntur et adipisci sapiente explicabo. Sapiente soluta illo culpa id est. Autem necessitatibus accusamus ipsam quia. Ut omnis nisi vel voluptatem placeat sed. Modi non odit et accusamus aliquam in placeat. Est libero vel et odio corrupti. Earum aliquam autem exercitationem eum similique magnam. Sed ut nesciunt aspernatur. Cupiditate ut et laboriosam laudantium. Et numquam dolore nulla nobis. Cumque sequi tempora eius asperiores. Qui quia dolorem unde qui omnis ipsam. Aliquid adipisci quo alias voluptatem repudiandae aliquid illum laborum. Doloribus provident eius aut ab autem error. Et voluptatum amet quaerat veritatis quibusdam non. Aperiam ea accusantium qui aut mollitia. Repellat est possimus sed ut qui dolores. Magni qui consectetur veniam est porro. Fugit ipsa laboriosam fugit temporibus exercitationem voluptas. Assumenda ab expedita facilis sed in. Ipsam quo nemo modi quisquam laborum molestiae. Tenetur neque doloribus animi accusamus laborum. Rerum exercitationem rerum facere et. Modi omnis repellat et quam distinctio sunt nesciunt. Esse culpa veritatis perspiciatis illo corporis. Et omnis et neque quidem nulla eum dolorem. Ab ab et et vel. Eum sint dolor veritatis laudantium. Quas minus minima dolorem aliquam quidem. Accusamus rerum accusantium aliquid sed molestiae adipisci architecto qui. Nihil magnam aliquid repellat laudantium. Cumque aut et voluptatem aut et. Deleniti et mollitia natus atque libero nobis omnis et. Qui eaque suscipit quaerat at et nulla id. Incidunt quidem vel dolores earum. Illo dolorem id nihil. Odio dolore voluptatem vitae qui praesentium maiores. Dolores ut qui sunt quos et iusto numquam. Deleniti sit alias quo ut consequatur repellendus voluptates. Enim ea recusandae asperiores ut aliquam. Consequatur ut qui occaecati nulla similique. Vel facere assumenda maxime beatae consectetur officia. Non totam est quae totam assumenda eius. Veritatis minus praesentium repellat quisquam adipisci dicta. Doloremque tempora eum quo recusandae aperiam perspiciatis quaerat. Iusto reprehenderit voluptatem maxime fuga cum nemo. Aut vel eos dolor. Est et nemo dolorem eius rem. Similique tempore commodi iste possimus. In mollitia culpa cum dignissimos debitis. Numquam voluptatum vel molestias sint. Tenetur doloremque neque pariatur exercitationem voluptatem velit. Qui explicabo eius repellat qui est at blanditiis. Placeat explicabo dicta numquam perspiciatis. Quod non corrupti reprehenderit laboriosam sunt amet. Excepturi vero voluptatum alias ducimus. Natus cumque aut sed quibusdam modi asperiores. Minima optio repudiandae sapiente quia voluptates sint necessitatibus in. Dolores rerum dolor quia blanditiis maxime dignissimos voluptatum. Consequuntur non quia provident dolorem. Harum ratione sit et. Laboriosam deserunt cupiditate velit quia explicabo est. Nulla aut id esse.',
                'author' => 'Alda Abernathy',
                'categories' => 3,
            ],
        ];
    }

    /**
     * @dataProvider fakerInstructionDataProvider
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
     * @dataProvider seedPriorPhp83DataProvider
     * @requires PHP < 8.3
     */
    public function testFakerSeedPriorPhp83(string $tableName, int $seed, array $columns): void
    {
        $this->executeFakerSeedCommand($tableName, $seed, $columns);
    }

    protected function executeFakerSeedCommand(string $tableName, int $seed, array $columns): void
    {
        $this->commandTester->execute([
            'table' => $tableName,
            'pid' => '2',
            'amount' => '1',
            'locale' => 'en_US',
            'seed' => (string)$seed,
        ]);

        $qb = $this->getConnectionPool()->getQueryBuilderForTable($tableName);
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

    /**
     * @dataProvider seedDataProvider
     * @requires PHP >= 8.3
     */
    public function testFakerSeed(string $tableName, int $seed, array $columns): void
    {
        $this->executeFakerSeedCommand($tableName, $seed, $columns);
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