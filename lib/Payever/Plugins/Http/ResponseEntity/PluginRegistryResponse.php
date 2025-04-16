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

/**
 * This class represents PluginRegistryResponse
 *
 * @method string      getId()
 * @method string      getPluginVersion()
 * @method string      getCmsVersion()
 * @method string      getChannel()
 * @method string      getHost()
 * @method string[]    getSupportedCommands()
 * @method string|null getCommandEndpoint()
 * @method string[]    getBusinessIds()
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class PluginRegistryResponse extends ResponseEntity
{
    /** @var string $id */
    protected $id;

    /** @var string $pluginVersion */
    protected $pluginVersion;

    /** @var string $cmsVersion */
    protected $cmsVersion;

    /** @var string $channel - {@see ChannelSet} */
    protected $channel;

    /** @var string $host */
    protected $host;

    /**@var array $supportedCommands - {@see PluginCommandNameEnum} */
    protected $supportedCommands;

    /** @var string $commandEndpoint */
    protected $commandEndpoint;

    /** @var string[] $businessIds */
    protected $businessIds;

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'pluginVersion',
            'cmsVersion',
            'host',
            'channel',
        ];
    }
}
