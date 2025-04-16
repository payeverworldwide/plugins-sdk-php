<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Result
 * @package   Payever\Widget
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Widget\Http\ResponseEntity\Result;

use Payever\Sdk\Core\Http\MessageEntity\ResultEntity;
use Payever\Sdk\Widget\Http\MessageEntity\PaymentWidgetPaymentsEntity;

/**
 * This class represents PaymentWidgetsResult Entity
 *
 * @method string                        getId()
 * @method string                        getBusinessId()
 * @method string                        getCheckoutId()
 * @method string                        getCheckoutMode()
 * @method string                        getType()
 * @method boolean                       getIsVisible()
 * @method PaymentWidgetPaymentsEntity[] getPayments()
 * @method $this                         setId(string $id)
 * @method $this                         setBusinessId(string $businessId)
 * @method $this                         setCheckoutId(string $checkoutId)
 * @method $this                         setCheckoutMode(string $checkoutMode)
 * @method $this                         setType(string $type)
 * @method $this                         setIsVisible(boolean $isVisible)
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class PaymentWidgetsResult extends ResultEntity
{
    /** @var string $id */
    protected $id;

    /** @var string $businessId */
    protected $businessId;

    /** @var string $checkoutId */
    protected $checkoutId;

    /** @var string $checkoutMode */
    protected $checkoutMode;

    /** @var string $type */
    protected $type;

    /** @var boolean $isVisible */
    protected $isVisible;

    /** @var PaymentWidgetPaymentsEntity[] $payments */
    protected $payments;

    /**
     * Set Payments.
     *
     * @param array $payments
     *
     * @return $this
     */
    public function setPayments($payments)
    {
        $this->payments = [];

        if (is_array($payments)) {
            foreach ($payments as $payment) {
                $this->payments[] = new PaymentWidgetPaymentsEntity($payment);
            }
        }

        return $this;
    }
}
