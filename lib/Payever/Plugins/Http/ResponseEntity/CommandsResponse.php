<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  ResponseEntity
 * @package   Payever\Plugins
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Plugins\Http\ResponseEntity;

use Payever\Sdk\Core\Http\MessageEntity\ResponseEntity;
use Payever\Sdk\Plugins\Http\MessageEntity\PluginCommandEntity;

/**
 * This class represents CommandsResponse
 */
class CommandsResponse extends ResponseEntity
{
    /** @var PluginCommandEntity[] $commands */
    protected $commands = [];

    /**
     * @inheritdoc
     */
    public function load($data)
    {
        if (is_array($data)) {
            foreach ($data as $plainCommand) {
                $this->commands[] = new PluginCommandEntity($plainCommand);
            }
        }
    }

    /**
     * @return PluginCommandEntity[]
     */
    public function getCommands()
    {
        return $this->commands;
    }
}
