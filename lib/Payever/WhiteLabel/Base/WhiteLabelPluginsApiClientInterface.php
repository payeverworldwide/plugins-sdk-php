<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  WhiteLabel
 * @package   Payever\WhiteLabel
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\WhiteLabel\Base;

use Payever\Sdk\Core\Http\Response;

/**
 * Interface describes functions of WhiteLabelPluginsApiClient
 */
interface WhiteLabelPluginsApiClientInterface
{
    /**
     * @param string $code
     * @param string $shopsystem
     *
     * @return Response
     */
    public function getWhiteLabelPlugin($code, $shopsystem);
}
