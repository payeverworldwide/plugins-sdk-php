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

use Payever\Sdk\Plugins\Http\MessageEntity\PluginCommandEntity;

/**
 * Interface describes functions of PluginCommandExecutor
 */
interface PluginCommandExecutorInterface
{
    /**
     * @param PluginCommandEntity $command
     *
     * @return bool
     *
     * @throws \Exception when command could not be executed at the moment
     */
    public function executeCommand(PluginCommandEntity $command);
}
