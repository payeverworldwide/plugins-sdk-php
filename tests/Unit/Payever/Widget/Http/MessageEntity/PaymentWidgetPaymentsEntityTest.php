<?php

namespace Payever\Tests\Unit\Payever\Widget\Http\MessageEntity;

use Payever\Sdk\Widget\Http\MessageEntity\PaymentWidgetPaymentsEntity;
use Payever\Tests\Unit\Payever\Core\Http\AbstractMessageEntityTest;

/**
 * Class PaymentWidgetPaymentsEntityTest
 *
 * @see \Payever\Sdk\Widget\Http\MessageEntity\PaymentWidgetPaymentsEntity
 */
class PaymentWidgetPaymentsEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'id' => 'stub',
        'payment_method' => 'stripe',
        'connection_id' => '123',
        'enabled' => true,
        'is_bnpl' => false,
    );

    public function getEntity()
    {
        return new PaymentWidgetPaymentsEntity();
    }
}
