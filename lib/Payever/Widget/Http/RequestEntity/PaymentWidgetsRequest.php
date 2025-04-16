<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  RequestEntity
 * @package   Payever\Widget
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Widget\Http\RequestEntity;

use Payever\Sdk\Core\Http\MessageEntity\RequestEntity;

/**
 * This class represents Payment Widgets Entity
 *
 * @method string getBusinessId()
 * @method string getIntegration()
 * @method $this  setBusinessId(string $businessId)
 * @method $this  setIntegration(string $integration)
 */
class PaymentWidgetsRequest extends RequestEntity
{
    const UNDERSCORE_ON_SERIALIZATION = false;

    /** @var string $businessId */
    protected $businessId;

    /** @var string $integration */
    protected $integration;

    /**
     * {@inheritdoc}
     */
    public function getRequired()
    {
        return [
            'businessId',
            'integration'
        ];
    }
}
