<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Widget
 * @package   Payever\Widget
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Widget;

use Payever\Sdk\Core\Base\OauthTokenInterface;
use Payever\Sdk\Core\CommonApiClient;
use Payever\Sdk\Core\Http\RequestBuilder;
use Payever\Sdk\Widget\Base\WidgetsApiClientInterface;
use Payever\Sdk\Widget\Http\RequestEntity\PaymentWidgetsRequest;
use Payever\Sdk\Widget\Http\ResponseEntity\PaymentWidgetsResponse;

/**
 * This class represents payever PaymentWidget API Connector
 * WidgetsApiClient manages the retrieval of payment widgets in the payever API
 */
class WidgetsApiClient extends CommonApiClient implements WidgetsApiClientInterface
{
    const URL_SANDBOX = 'https://web-widgets-backend.staging.devpayever.com/';
    const URL_LIVE    = 'https://web-widgets-backend.payever.org/';

    const FINANCE_EXPRESS_WIDGET = 'finance-express';

    const SUB_URL_GET_WIDGETS = 'api/widgets';

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function getWidgets($businessUuid = '', $integration = '')
    {
        $this->configuration->assertLoaded();

        $businessUuid = $businessUuid ?: $this->getConfiguration()->getBusinessUuid();
        $integration = $integration ?: self::FINANCE_EXPRESS_WIDGET;

        $widgetsRequest = new PaymentWidgetsRequest();
        $widgetsRequest
            ->setBusinessId($businessUuid)
            ->setIntegration($integration);

        $request = RequestBuilder::post($this->getWidgetsURL())
            ->addRawHeader(
                $this->getToken(OauthTokenInterface::SCOPE_PAYMENT_INFO)->getAuthorizationString()
            )
            ->contentTypeIsJson()
            ->setRequestEntity($widgetsRequest)
            ->setResponseEntity(new PaymentWidgetsResponse())
            ->build();

        return $this->executeRequest($request, OauthTokenInterface::SCOPE_PAYMENT_INFO);
    }

    /**
     * Returns URL to get the widgets
     *
     * @return string
     */
    protected function getWidgetsURL()
    {
        return $this->getBaseEntrypoint(true) . self::SUB_URL_GET_WIDGETS;
    }
}
