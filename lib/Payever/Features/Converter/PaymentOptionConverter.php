<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Converter
 * @package   Payever\Features
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Features\Converter;

use Payever\Sdk\Features\Http\MessageEntity\ConvertedPaymentOptionEntity;
use Payever\Sdk\Payments\Http\ResponseEntity\Result\ListPaymentOptionsVariantsResult;

/**
 * This class represents PaymentOptionConverter
 */
class PaymentOptionConverter
{
    /**
     * @param array|ListPaymentOptionsVariantsResult[] $poWithVariants
     *
     * @return array|ConvertedPaymentOptionEntity[]
     */
    public static function convertPaymentOptionVariants(array $poWithVariants)
    {
        $result = [];

        foreach ($poWithVariants as $poWithVariant) {
            $result = array_merge($result, self::toConvertedPaymentOptions($poWithVariant));
        }

        return $result;
    }

    /**
     * @param ListPaymentOptionsVariantsResult $poWithVariant
     *
     * @return array|ConvertedPaymentOptionEntity[]
     */
    private static function toConvertedPaymentOptions($poWithVariant)
    {
        $result = [];
        $baseData = $poWithVariant->toArray();

        foreach ($poWithVariant->getVariants() as $variant) {
            $convertedOption = new ConvertedPaymentOptionEntity($baseData);
            $convertedOption->setVariantId($variant->getId());
            $convertedOption->setAcceptFee($variant->getAcceptFee());
            $convertedOption->setShippingAddressAllowed($variant->getShippingAddressAllowed());
            $convertedOption->setShippingAddressEquality($variant->getShippingAddressEquality());
            $convertedOption->setVariantName($variant->getName());
            $convertedOption->setVariantOptions($variant->getOptions());

            $result[$variant->getId()] = $convertedOption;
        }

        return $result;
    }
}
