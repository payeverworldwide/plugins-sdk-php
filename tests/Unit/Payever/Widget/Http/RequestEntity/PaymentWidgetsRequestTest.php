<?php

namespace Payever\Tests\Unit\Payever\Widget\Http\RequestEntity;

use Payever\Sdk\Widget\Http\RequestEntity\PaymentWidgetsRequest;
use Payever\Tests\Unit\Payever\Core\Http\AbstractMessageEntityTest;

/**
 * Class PaymentWidgetPaymentsEntityTest
 *
 * @see \Payever\Sdk\Widget\Http\RequestEntity\PaymentWidgetsRequest
 */
class PaymentWidgetsRequestTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'businessId' => 'stub_business',
        'integration' => 'shopware',
    );

    public function getEntity()
    {
        return new PaymentWidgetsRequest();
    }
}
