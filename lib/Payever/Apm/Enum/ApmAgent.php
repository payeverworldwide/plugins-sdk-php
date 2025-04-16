<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Enum
 * @package   Payever\Apm
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Apm\Enum;

use Payever\Sdk\Core\Base\EnumerableConstants;

/**
 * This class represents Apm Agent
 * The ApmAgent class defines constants for the APM logger
 */
class ApmAgent extends EnumerableConstants
{
    const NAME = 'payever-amp-php-agent';
    const VERSION = '1.0.0';
    const MICROTIME_MULTIPLIER = 1000000;
}
