<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Features
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Features\Http\MessageEntity;

use Payever\Sdk\Payments\Http\MessageEntity\PaymentOptionOptionsEntity;
use Payever\Sdk\Payments\Http\ResponseEntity\Result\ListPaymentOptionsResult;

/**
 * This class represents ConvertedPaymentOptionEntity
 *
 * @method string                          getVariantId()
 * @method string                          getVariantName()
 * @method PaymentOptionOptionsEntity|null getVariantOptions()
 * @method $this                           setVariantId(string $variantId)
 * @method $this                           setVariantName(string $variantName)
 * @method $this                           setVariantOptions(PaymentOptionOptionsEntity $variantOptions)
 */
class ConvertedPaymentOptionEntity extends ListPaymentOptionsResult
{
    /** @var string $variantId */
    protected $variantId;

    /** @var string $variantName */
    protected $variantName;

    /** @var PaymentOptionOptionsEntity $variantOptions */
    protected $variantOptions;
}
