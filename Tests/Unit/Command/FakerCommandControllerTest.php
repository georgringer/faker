<?php

namespace GeorgRinger\Faker\Tests\Unit\Command;

use GeorgRinger\Faker\Command\FakerCommandController;
use GeorgRinger\Faker\Generator\Runner;
use TYPO3\CMS\Core\Tests\UnitTestCase;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FakerCommandControllerTest extends UnitTestCase
{

    /**
     * @test
     */
    public function checkValidTableNameFailsForInvalidTableName()
    {
        $mockedCommandController = $this->getAccessibleMock(FakerCommandController::class, ['outputLine', 'sendAndExit']);
        $mockedCommandController->expects($this->once())->method('outputLine');

        $mockedCommandController->_call('checkValidTableName', 'invalid');
    }


    /**
     * @test
     */
    public function fakerGeneratorIsCalled()
    {
        $mockedRunner = $this->getAccessibleMock(Runner::class, ['execute'], [], '', false);
        GeneralUtility::setSingletonInstance(Runner::class, $mockedRunner);
        $mockedCommandController = $this->getAccessibleMock(FakerCommandController::class, ['outputLine', 'sendAndExit', 'checkValidTableName']);
        $mockedCommandController->expects($this->once())->method('checkValidTableName');
        $mockedRunner->expects($this->once())->method('execute');

        $mockedCommandController->_call('runCommand', 'table', 123, 1);
    }
//

    /**
     * @test
     */
    public function checkValidTableNameFailsForNotActiveTable()
    {
        $mockedCommandController = $this->getAccessibleMock(FakerCommandController::class, ['outputLine', 'sendAndExit']);
        $mockedCommandController->expects($this->once())->method('outputLine');

        $GLOBALS['TCA'] = [
            'notactive' => [
                'ctrl' => [
                    'faker' => false
                ]
            ]
        ];
        $mockedCommandController->_call('checkValidTableName', 'notactive');
    }


    /**
     * @test
     */
    public function checkValidTableNameFailsForNoFieldsUsingFaker()
    {
        $mockedCommandController = $this->getAccessibleMock(FakerCommandController::class, ['outputLine', 'sendAndExit']);
        $mockedCommandController->expects($this->once())->method('outputLine');

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
        $mockedCommandController->_call('checkValidTableName', 'notactive');
    }
}