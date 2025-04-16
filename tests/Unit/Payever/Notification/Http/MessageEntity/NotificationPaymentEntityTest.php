<?php

namespace Payever\Tests\Unit\Payever\Notification\Http\MessageEntity;

use Payever\Sdk\Notification\Http\MessageEntity\NotificationPaymentEntity;
use Payever\Tests\Unit\Payever\Core\Http\AbstractMessageEntityTest;

/**
 * Class NotificationPaymentEntityTest
 *
 * @see NotificationPaymentEntity
 */
class NotificationPaymentEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'id' => 'stub',
        'status' => 'success',
        'specific_status' => 'success',
        'merchant_name' => 'stub_merchant',
        'customer_name' => 'stub_customer',
        'customer_email' => 'test@example.com',
        'payment_type' => 'sofort',
        'created_at' => self::DEFAULT_STUB_DATE,
        'updated_at' => self::DEFAULT_STUB_DATE,
        'channel' => 'stub_channel',
        'channel_type' => 'stub_channel_type',
        'channel_source' => 'stub_channel_source',
        'reference' => 'stub_reference',
        'amount' => 100.5,
        'total' => 110.5,
        'currency' => 'EUR',
        'delivery_fee' => 10,
        'payment_fee' => 0,
        'down_payment' => 0,
        'payment_details' => array(),
        'payment_details_array' => array(),
        'address' => array(),
        'shipping_address' => array(),
        'items' => [
            [
                'name' => 'stub_name',
                'unit_price' => 90,
                'tax_rate' => 10.55,
                'quantity' => 1,
                'total_amount' => 100.55,
                'total_tax_amount' => 10.55,
                'description' => 'stub_description',
                'category' => 'Goods',
                'image_url' => 'stub',
                'product_url' => 'stub',
                'sku' => 'stub_sku',
                'identifier' => 'stub_sku',
                'brand' => 'brand',
            ]
        ],
        'refund_amount' => 0,
        'captured_amount' => 0,
        'refunded_items' => array(),
        'captured_items' => array(),
    );

    public function getEntity()
    {
        return new NotificationPaymentEntity();
    }
}
