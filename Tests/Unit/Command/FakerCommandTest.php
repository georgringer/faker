<?php

namespace GeorgRinger\Faker\Tests\Unit\Command;

use Faker\Factory;
use GeorgRinger\Faker\Command\FakerCommand;
use GeorgRinger\Faker\Generator\Runner;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FakerCommandTest extends UnitTestCase
{

    /**
     * @test
     */
    public function checkValidTableNameFailsForInvalidTableName()
    {
        $mockedCommand = $this->getAccessibleMock(FakerCommand::class, ['outputLine', 'sendAndExit']);
        $mockedCommand->expects($this->once())->method('outputLine');

        $this->assertFalse($mockedCommand->_call('checkValidTableName', 'invalid'));
    }


    /**
     * @test
     */
    public function fakerGeneratorIsCalled()
    {
        /** @var Runner $mockedRunner */
        $mockedRunner = $this->getAccessibleMock(Runner::class, ['execute'], [], '', false);
        $this->resetSingletonInstances = true;
        GeneralUtility::setSingletonInstance(Runner::class, $mockedRunner);
        /** @var MockObject $mockedRunner */
        $mockedRunner->expects($this->once())->method('execute');

        $mockedCommand = $this->getAccessibleMock(FakerCommand::class, ['checkValidTableName']);
        $mockedCommand->method('checkValidTableName')->willReturn(true);
        $mockedCommand->expects($this->once())->method('checkValidTableName');

        $mockedCommand->_call('executeFaker', 'table', 123, Factory::DEFAULT_LOCALE, 1);
    }
//

    /**
     * @test
     */
    public function checkValidTableNameFailsForNotActiveTable()
    {
        $mockedCommand = $this->getAccessibleMock(FakerCommand::class, ['outputLine', 'sendAndExit']);
        $mockedCommand->expects($this->once())->method('outputLine');

        $GLOBALS['TCA'] = [
            'notactive' => [
                'ctrl' => [
                    'faker' => false
                ]
            ]
        ];
        $this->assertFalse($mockedCommand->_call('checkValidTableName', 'notactive'));
    }


    /**
     * @test
     */
    public function checkValidTableNameFailsForNoFieldsUsingFaker()
    {
        $mockedCommand = $this->getAccessibleMock(FakerCommand::class, ['outputLine']);
        $mockedCommand->expects($this->once())->method('outputLine');

        $GLOBALS['TCA'] = [
            'notactive' => [
                'ctrl' => [
                    'faker' => true
                ],
                'columns' => [
                    'title' => [
                        'faker' => 0,
                        'config' => [
                            'type' => 'input'
                        ]
                    ],
                    'description' => [
                        'config' => [
                            'type' => 'text'
                        ]
                    ]
                ]
            ]
        ];
        $this->assertFalse($mockedCommand->_call('checkValidTableName', 'notactive'));
    }
}