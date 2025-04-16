<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Command
 * @package   Payever\Plugins
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Plugins\Command;

use Payever\Sdk\Plugins\Base\PluginsApiClientInterface;
use Payever\Sdk\Plugins\Enum\PluginCommandNameEnum;
use Payever\Sdk\Plugins\Http\MessageEntity\PluginCommandEntity;
use Payever\Sdk\Plugins\Http\ResponseEntity\CommandsResponse;
use Psr\Log\LoggerInterface;

/**
 * This class represents PluginCommandManager
 */
class PluginCommandManager
{
    /** @var PluginsApiClientInterface $pluginsApiClient */
    private $pluginsApiClient;

    /** @var PluginCommandExecutorInterface $commandExecutor */
    private $commandExecutor;

    /** @var LoggerInterface $logger */
    private $logger;

    /**
     * @param PluginsApiClientInterface      $pluginsApiClient
     * @param PluginCommandExecutorInterface $commandExecutor
     * @param LoggerInterface                $logger
     */
    public function __construct(
        PluginsApiClientInterface $pluginsApiClient,
        PluginCommandExecutorInterface $commandExecutor,
        LoggerInterface $logger
    ) {
        $this->pluginsApiClient = $pluginsApiClient;
        $this->commandExecutor = $commandExecutor;
        $this->logger = $logger;
    }

    /**
     * Gets up to date commands and executes them
     *
     * @param int|null $lastCommandTimestamp
     *
     * @throws \Exception - bubbles up anything thrown by API or CommandExecutor
     *
     * @SuppressWarnings(PHPMD.ElseExpression)
     */
    public function executePluginCommands($lastCommandTimestamp = null)
    {
        $commandsResponse = $this->pluginsApiClient->getCommands($lastCommandTimestamp);
        /** @var CommandsResponse $responseEntity */
        $responseEntity = $commandsResponse->getResponseEntity();
        $commandsList = $responseEntity->getCommands();

        foreach ($commandsList as $commandEntity) {
            if ($this->isCommandSupported($commandEntity)) {
                $this->logger->info(
                    sprintf(
                        'Executing plugin command %s with value %s',
                        $commandEntity->getName(),
                        $commandEntity->getValue()
                    )
                );
                $this->commandExecutor->executeCommand($commandEntity);
                $this->pluginsApiClient->acknowledgePluginCommand($commandEntity->getId());
            } else {
                $this->logger->info(
                    sprintf(
                        'Plugin command %s with value %s is not supported',
                        $commandEntity->getName(),
                        $commandEntity->getValue()
                    )
                );
            }
        }
    }

    /**
     * @param PluginCommandEntity $commandEntity
     *
     * @return bool
     */
    private function isCommandSupported(PluginCommandEntity $commandEntity)
    {
        $infoProvider = $this->pluginsApiClient->getRegistryInfoProvider();

        if (!in_array($commandEntity->getName(), $infoProvider->getSupportedCommands())) {
            return false;
        }

        if (
            $commandEntity->getName() === PluginCommandNameEnum::NOTIFY_NEW_PLUGIN_VERSION
            && version_compare($commandEntity->getValue(), $infoProvider->getPluginVersion(), '<=')
        ) {
            return false;
        }

        return true;
    }
}
