<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Notification
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Notification\Http\MessageEntity;

use Payever\Sdk\Payments\Http\ResponseEntity\Result\PaymentResult;

/**
 * This class represents Notification Result Entity
 *
 * @method float       getRefundAmount()
 * @method float       getCaptureAmount()
 * @method float       getCancelAmount()
 * @method float       getTotalCapturedAmount()
 * @method float       getTotalRefundedAmount()
 * @method float       getTotalCanceledAmount()
 * @method array       getRefundedItems()
 * @method array       getCapturedItems()
 * @method $this       setRefundAmount()
 * @method $this       setCaptureAmount()
 * @method $this       setCancelAmount()
 * @method $this       setRefundedItems()
 * @method $this       setCapturedItems()
 * @method $this       setTotalCapturedAmount()
 * @method $this       setTotalRefundedAmount()
 * @method $this       setTotalCanceledAmount()
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class NotificationPaymentEntity extends PaymentResult
{
    /**
     * Returns the total (partial) refunded amount for this transaction
     *
     * @var float|null
     */
    protected $refundAmount;

    /**
     * Returns the total (partial) captured amount for this transaction
     *
     * @var float|null
     */
    protected $captureAmount;

    /**
     * Returns the total (partial) cancelled amount for this transaction
     *
     * @var float|null
     */
    protected $cancelAmount;

    /**
     * Refunded items (only when cart was provided)
     *
     * @var array
     */
    protected $refundedItems;

    /**
     * Captured items (only when cart was provided)
     *
     * @var array
     */
    protected $capturedItems;

    /**
     * Returns the total captured amount for payment
     *
     * @var float|null
     */
    protected $totalCapturedAmount;

    /**
     * Returns the total refunded amount for payment
     *
     * @var float|null
     */
    protected $totalRefundedAmount;

    /**
     * Returns the total cancelled amount for payment
     *
     * @var float|null
     */
    protected $totalCanceledAmount;
}
