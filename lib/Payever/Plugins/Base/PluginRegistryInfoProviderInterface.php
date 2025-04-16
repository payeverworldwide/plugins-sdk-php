<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Plugins
 * @package   Payever\Plugins
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Plugins\Base;

use Payever\Sdk\Core\Enum\ChannelSet;
use Payever\Sdk\Plugins\Enum\PluginCommandNameEnum;

/**
 * Interface describes functions of PluginRegistryInfoProvider
 */
interface PluginRegistryInfoProviderInterface
{
    /**
     * @return string - MUST return a semver (https://semver.org/) value of plugin version
     */
    public function getPluginVersion();

    /**
     * @return string - MUST return a semver (https://semver.org/) value of CMS version
     */
    public function getCmsVersion();

    /**
     * @return string - hostname of a CMS installation
     */
    public function getHost();

    /**
     * @return string
     *
     * @see ChannelSet
     */
    public function getChannel();

    /**
     * @return string[]
     *
     * @see PluginCommandNameEnum
     */
    public function getSupportedCommands();

    /**
     * A URL which must be called whenever new command created. Useful when there is no cron schedule available
     * in the user's system.
     * NOTE: It will be a POST request with no payload, you still need to poll for suitable commands.
     * NOTE: Trust no one - Please include some kind of secret token in this URL and check if it is valid
     * when handling this request.
     *
     * @return string|null
     */
    public function getCommandEndpoint();

    /**
     * @return string[] - List of business UUID's used by plugin
     */
    public function getBusinessIds();
}
