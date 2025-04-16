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

use Payever\Sdk\Core\Http\Response;

/**
 * Interface describes functions of PluginsApiClient
 */
interface PluginsApiClientInterface
{
    /**
     * @return PluginRegistryInfoProviderInterface
     */
    public function getRegistryInfoProvider();

    /**
     * @return Response
     */
    public function registerPlugin();

    /**
     * @return Response
     */
    public function unregisterPlugin();

    /**
     * @param string $commandId
     *
     * @return Response
     */
    public function acknowledgePluginCommand($commandId);

    /**
     * @param int|null $fromTimestamp
     *
     * @return Response
     */
    public function getCommands($fromTimestamp = null);

    /**
     * Retrieve the latest plugin info for current CMS.
     *
     * @return Response
     */
    public function getLatestPluginVersion();
}
