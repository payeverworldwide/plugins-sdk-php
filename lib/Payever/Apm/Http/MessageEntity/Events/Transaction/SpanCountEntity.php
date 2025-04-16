<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Transaction
 * @package   Payever\Apm
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Apm\Http\MessageEntity\Events\Transaction;

use Payever\Sdk\Apm\Http\MessageEntity\ApmMessageEntity;

/**
 * This class represents SpanCountEntity
 *
 * @method integer getStarted()
 * @method integer getDropped()
 * @method $this   setStarted(integer $started)
 * @method $this   setDropped(integer $dropped)
 */
class SpanCountEntity extends ApmMessageEntity
{
    /** @var integer $started */
    protected $started = 0;

    /** @var integer $dropped */
    protected $dropped = 0;
}
