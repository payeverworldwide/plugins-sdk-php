<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  RequestEntity
 * @package   Payever\Plugins
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Plugins\Http\RequestEntity;

use Payever\Sdk\Core\Enum\ChannelSet;
use Payever\Sdk\Core\Http\MessageEntity\RequestEntity;
use Payever\Sdk\Plugins\Enum\PluginCommandNameEnum;

/**
 * This class represents PluginRegistryRequest
 *
 * @method $this setPluginVersion(string $pluginVersion)
 * @method $this setCmsVersion(string $cmsVersion)
 * @method $this setChannel(string $channel)
 * @method $this setHost(string $host)
 * @method $this setSupportedCommands(string[] $commands)
 * @method $this setCommandEndpoint(string $endpoint)
 * @method $this setBusinessIds(string[] $ids)
 */
class PluginRegistryRequest extends RequestEntity
{
    const UNDERSCORE_ON_SERIALIZATION = false;

    /**
     * @required only for registration
     * @var string $pluginVersion
     */
    protected $pluginVersion;

    /**
     * @required only for registration
     * @var string $cmsVersion
     */
    protected $cmsVersion;

    /**
     * @required
     * @var string $channel
     * @see ChannelSet
     */
    protected $channel;

    /**
     * @required
     * @var string $host
     */
    protected $host;

    /**
     * @var array $supportedCommands
     * @see PluginCommandNameEnum
     */
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
            'channel',
            'host',
        ];
    }
}
