<?php

namespace Payever\Tests\Unit\Payever\Widget\Http\ResponseEntity;

use Payever\Sdk\Widget\Http\ResponseEntity\PaymentWidgetsResponse;
use Payever\Tests\Unit\Payever\Core\Http\AbstractResponseEntityTest;
use Payever\Tests\Unit\Payever\Widget\Http\ResponseEntity\Result\PaymentWidgetsResultTest;

/**
 * Class PaymentWidgetsResponseTest
 *
 * @see \Payever\Sdk\Widget\Http\ResponseEntity\PaymentWidgetsResponse
 */
class PaymentWidgetsResponseTest extends AbstractResponseEntityTest
{
    public static function getScheme()
    {
        return array(
            'result' => [
                PaymentWidgetsResultTest::getScheme(),
            ],
        );
    }

    public function getEntity()
    {
        return new PaymentWidgetsResponse();
    }
}
