<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Enum
 * @package   Payever\Plugins
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Plugins\Enum;

use Payever\Sdk\Core\Base\EnumerableConstants;

/**
 * This class represents PluginCommandNameEnum
 */
class PluginCommandNameEnum extends EnumerableConstants
{
    const SET_SANDBOX_HOST = 'set-sandbox-host';

    const SET_LIVE_HOST = 'set-live-host';

    const SET_COMMAND_POLLING_DELAY = 'set-command-polling-delay';

    const NOTIFY_NEW_PLUGIN_VERSION = 'notify-new-plugin-version';

    const SET_API_VERSION = 'set-api-version';
}
