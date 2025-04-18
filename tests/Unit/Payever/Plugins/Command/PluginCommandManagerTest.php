<?php

namespace Payever\Tests\Unit\Payever\Plugins\Command;

use Payever\Sdk\Core\Http\Response;
use Payever\Sdk\Plugins\Base\PluginRegistryInfoProviderInterface;
use Payever\Sdk\Plugins\Command\PluginCommandExecutorInterface;
use Payever\Sdk\Plugins\Command\PluginCommandManager;
use Payever\Sdk\Plugins\Enum\PluginCommandNameEnum;
use Payever\Sdk\Plugins\Http\ResponseEntity\CommandsResponse;
use Payever\Sdk\Plugins\PluginsApiClient;
use Payever\Tests\Integration\features\bootstrap\PluginRegistryIntoProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class PluginCommandManagerTest extends TestCase
{
    /** @var PluginCommandManager */
    private $pluginCommandManager;

    /** @var PluginsApiClient|MockObject */
    private $pluginApiClient;

    /** @var PluginCommandExecutorInterface|MockObject */
    private $pluginCommandExecutor;

    /** @var PluginRegistryInfoProviderInterface */
    private $registryInfoProvider;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        $this->pluginApiClient = $this->getMockBuilder(PluginsApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->pluginCommandExecutor = $this->getMockForAbstractClass(PluginCommandExecutorInterface::class);
        $this->registryInfoProvider = new PluginRegistryIntoProvider();
        $this->pluginCommandManager = new PluginCommandManager(
            $this->pluginApiClient,
            $this->pluginCommandExecutor,
            new NullLogger()
        );
    }

    /**
     * @param $commands
     * @param $shouldExecute
     * @throws \Exception
     *
     * @dataProvider commandDataProvider
     */
    public function testExecutePluginCommands($commands, $shouldExecute)
    {
        $commandsResponseEntity = new CommandsResponse($commands);
        $response = new Response();
        $response->setResponseEntity($commandsResponseEntity);

        $this->pluginApiClient->expects($this->once())
            ->method('getCommands')
            ->willReturn($response);

        $this->pluginApiClient->expects($this->once())
            ->method('getRegistryInfoProvider')
            ->willReturn($this->registryInfoProvider);

        $this->pluginCommandExecutor->expects($shouldExecute ? $this->once() : $this->never())
            ->method('executeCommand')
            ->with($commandsResponseEntity->getCommands()[0]);

        $this->pluginApiClient->expects($shouldExecute ? $this->once() : $this->never())
            ->method('acknowledgePluginCommand')
            ->with($commands[0]['_id']);

        $this->pluginCommandManager->executePluginCommands();
    }

    /**
     * @param string $notifyVersion
     * @param bool $shouldExecute
     * @throws \Exception
     *
     * @dataProvider notifyVersionDataProvider
     */
    public function testVersionCommandHandling($notifyVersion, $shouldExecute)
    {
        $commands = [
            [
                '_id' => 'stub-command-id',
                'name' => PluginCommandNameEnum::NOTIFY_NEW_PLUGIN_VERSION,
                'value' => $notifyVersion,
            ]
        ];

        $this->testExecutePluginCommands($commands, $shouldExecute);
    }

    /**
     * @return array
     */
    public function commandDataProvider()
    {
        return [
            [
                [
                    [
                        '_id' => 'stub-command-id',
                        'name' => PluginCommandNameEnum::SET_LIVE_HOST,
                        'value' => 'https://some.host.com',
                    ]
                ],
                true,
            ],
            [
                [
                    [
                        '_id' => 'stub-command-id',
                        'name' => PluginCommandNameEnum::SET_COMMAND_POLLING_DELAY,
                        'value' => '36',
                    ]
                ],
                false,
            ],
        ];
    }

    /**
     * @return array
     */
    public function notifyVersionDataProvider()
    {
        // version inside data provider is 1.0.0
        return [
            ['0.0.1', false],
            ['0.1.0', false],
            ['1.0.0', false],
            ['1.0.1', true],
            ['1.2.0', true],
            ['2.0.0', true],
        ];
    }
}
