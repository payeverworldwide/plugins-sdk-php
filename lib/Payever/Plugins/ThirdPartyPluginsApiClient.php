<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Plugins
 * @package   Payever\Plugins
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Plugins;

use Payever\Sdk\Core\CommonApiClient;
use Payever\Sdk\Core\Http\RequestBuilder;

/**
 * This class represents Third Party Plugins API Connector
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ThirdPartyPluginsApiClient extends CommonApiClient
{
    const URL_SANDBOX = 'https://plugins-third-party.staging.devpayever.com/';
    const URL_LIVE    = 'https://plugins-third-party.payever.org/';

    const SUB_URL_CREATE_PAYMENT = 'api/integration/%s/action/get-token';
    const SUB_URL_CREATE_PAYMENT_SUBMIT = 'api/integration/%s/action/submit-payment';
    const SUB_URL_RETRIEVE_PAYMENT = 'api/integration/%s/action/get-payment';
    const SUB_URL_REFUND_PAYMENT = 'api/integration/%s/action/refund-payment';
    const SUB_URL_SHIPPING_GOODS_PAYMENT = 'api/integration/%s/action/shipping-goods-payment';
    const SUB_URL_CANCEL_PAYMENT = 'api/integration/%s/action/cancel-payment';
    const SUB_URL_LIST_PAYMENT_OPTIONS = 'api/integration/%s/action/get-payment-options';
    const SUB_URL_LIST_PAYMENT_OPTIONS_VARIANTS = 'api/integration/%s/action/get-payment-options-variants';
    const SUB_URL_TRANSACTION = 'api/integration/%s/action/get-transaction';
    const SUB_URL_TOKEN_VALIDATION = 'api/business/%s/token/validation';

    /**
     * Token validation
     *
     * @param string $businessUuid
     * @param string $accessToken
     *
     * @return boolean
     */
    public function validateToken($businessUuid, $accessToken)
    {
        $this->configuration->assertLoaded();

        try {
            $request = RequestBuilder::post($this->getValidateTokenURL($businessUuid))
                 ->addRawHeader(
                     sprintf("Authorization: Bearer %s", $accessToken)
                 )
                 ->build();

            $this->getHttpClient()->execute($request);

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * Returns URL to the token validation
     *
     * @param string $businessUuid
     *
     * @return string
     */
    protected function getValidateTokenURL($businessUuid)
    {
        return $this->getBaseEntrypoint(true) . sprintf(self::SUB_URL_TOKEN_VALIDATION, $businessUuid);
    }
}
