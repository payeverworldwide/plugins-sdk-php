<?php

namespace Payever\Tests\Unit\Payever\Widget\Http\ResponseEntity\Result;

use Payever\Sdk\Widget\Http\ResponseEntity\Result\PaymentWidgetsResult;
use Payever\Tests\Unit\Payever\Core\Http\AbstractMessageEntityTest;
use Payever\Tests\Unit\Payever\Widget\Http\MessageEntity\PaymentWidgetPaymentsEntityTest;

/**
 * Class PaymentWidgetsResultTest
 *
 * @see \Payever\Sdk\Widget\Http\MessageEntity\PaymentWidgetsResult
 */
class PaymentWidgetsResultTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'id' => 'stub',
        'business_id' => 'stub_business',
        'checkout_id' => 'stub_checkout',
        'checkout_mode' => 'mode',
        'type' => 'type',
        'is_visible' => true,
        'payments' => [],
    );

    public static function getScheme()
    {
        $scheme = static::$scheme;

        $scheme['payments'][] = PaymentWidgetPaymentsEntityTest::getScheme();

        return $scheme;
    }

    public function getEntity()
    {
        return new PaymentWidgetsResult();
    }
}
