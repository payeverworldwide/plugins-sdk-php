<?php

namespace Payever\Tests\Unit\Payever\Features\Converter;

use PHPUnit\Framework\TestCase;
use Payever\Sdk\Features\Converter\PaymentOptionConverter;
use Payever\Sdk\Payments\Http\ResponseEntity\Result\ListPaymentOptionsVariantsResult;

class PaymentOptionConverterTest extends TestCase
{
    public function testConvert()
    {
        $paymentOptionWithVariant = new ListPaymentOptionsVariantsResult([
            'id' => 'stub',
            'name' => 'stub_name',
            'status' => false, // will be converted to ($status == 'active')
            'variable_fee' => 1.5,
            'fixed_fee' => 10,
            'description_offer' => 'stub_offer_description',
            'description_fee' => 'stub_fee_description',
            'min' => 100,
            'max' => 10000,
            'payment_method' => 'stripe',
            'type' => 'stripe',
            'slug' => 'stripe_slug',
            'thumbnail_1' => 'some_image',
            'thumbnail_2' => null,
            'thumbnail_3' => null,
            'options' => array(),
            'translations' => array(),
            'variants' => array(
                array(
                    'variant_id' => 'a69ae3ff-269b-44c4-83f0-2d3d01e86aa1',
                    'accept_fee' => true,
                ),
                array(
                    'variant_id' => 'a69ae3ff-269b-44c4-83f0-2d3d01e86aa2',
                    'name' => '24 months',
                    'accept_fee' => false,
                ),
                array(
                    'variant_id' => 'a69ae3ff-269b-44c4-83f0-2d3d01e86aa3',
                    'name' => '32 months',
                    'accept_fee' => false,
                ),
            ),
        ]);

        $result = PaymentOptionConverter::convertPaymentOptionVariants([$paymentOptionWithVariant]);

        $this->assertCount(3, $result);

        foreach ($paymentOptionWithVariant->getVariants() as $variant) {
            $this->assertArrayHasKey($variant->getId(), $result);

            $convertedVariant = $result[$variant->getId()];

            $this->assertEquals($variant->getAcceptFee(), $convertedVariant->getAcceptFee());
            $this->assertEquals($variant->getName(), $convertedVariant->getVariantName());
            $this->assertEquals($variant->getId(), $convertedVariant->getVariantId());
        }
    }
}
