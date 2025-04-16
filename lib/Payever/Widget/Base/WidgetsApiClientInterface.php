<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Base
 * @package   Payever\Widget
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Widget\Base;

use Payever\Sdk\Core\Http\Response;

/**
 * Interface describes functions of WidgetsApiClient
 */
interface WidgetsApiClientInterface
{
    /**
     * Receives list of widgets
     *
     * @param string $businessUuid
     * @param string $integration
     *
     * @return Response
     */
    public function getWidgets($businessUuid = '', $integration = '');
}
