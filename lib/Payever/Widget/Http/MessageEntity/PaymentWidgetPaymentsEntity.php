<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Widget
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Widget\Http\MessageEntity;

use Payever\Sdk\Core\Base\MessageEntity;

/**
 * This class represents Widget Payments Entity
 *
 * @method string         getId()
 * @method string         getPaymentMethod()
 * @method string         getConnectionId()
 * @method boolean        getEnabled()
 * @method boolean        getIsBNPL()
 * @method $this          setId(string $id)
 * @method $this          setPaymentMethod(string $paymentMethod)
 * @method $this          setConnectionId(string $connectionId)
 * @method $this          setEnabled(boolean $enabled)
 * @method boolean        setIsBNPL(boolean $isBNPL)
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class PaymentWidgetPaymentsEntity extends MessageEntity
{
    /** @var string $id */
    protected $id;

    /** @var string $paymentMethod */
    protected $paymentMethod;

    /** @var string $connectionId */
    protected $connectionId;

    /** @var boolean $enabled */
    protected $enabled;

    /** @var boolean $isBNPL */
    protected $isBNPL;
}
