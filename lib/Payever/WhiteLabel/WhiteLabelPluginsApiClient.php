<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  WhiteLabel
 * @package   Payever\WhiteLabel
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\WhiteLabel;

use Payever\Sdk\Core\Base\HttpClientInterface;
use Payever\Sdk\Core\Http\Client\CurlClient;
use Payever\Sdk\Core\Http\RequestBuilder;
use Payever\Sdk\WhiteLabel\Base\WhiteLabelPluginsApiClientInterface;
use Payever\Sdk\WhiteLabel\Http\ResponseEntity\WhiteLabelPluginResponse;
use Psr\Log\NullLogger;

/**
 * This class represents payever White Label API Connector
 * WhiteLabelPluginsApiClient retrieves white label plugin details based on the given shop system
 */
class WhiteLabelPluginsApiClient implements WhiteLabelPluginsApiClientInterface
{
    const URL_LIVE = 'https://plugins-third-party.payever.org/';
    const SUB_URL_WL_PLUGIN = 'api/wl/plugin/%s/shopsystem/%s';

    /** @var HttpClientInterface|null $httpClient */
    private $httpClient;

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function getWhiteLabelPlugin($code, $shopsystem)
    {
        $request = RequestBuilder::get($this->buildWhiteLabelPluginUrl($code, $shopsystem))
            ->setResponseEntity(new WhiteLabelPluginResponse())
            ->build();

        return $this->getHttpClient()->execute($request);
    }

    /**
     * Set http client
     *
     * @param HttpClientInterface $httpClient
     *
     * @return $this
     */
    public function setHttpClient(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * @return CurlClient
     */
    private function getHttpClient()
    {
        if ($this->httpClient === null) {
            $this->httpClient = new CurlClient();
        }

        $this->httpClient->setLogger(new NullLogger());

        return $this->httpClient;
    }

    /**
     * @param string $code
     * @param string $shopsystem
     *
     * @return string
     */
    private function buildWhiteLabelPluginUrl($code, $shopsystem)
    {
        return sprintf(
            '%s%s',
            static::URL_LIVE,
            sprintf(static::SUB_URL_WL_PLUGIN, $code, $shopsystem)
        );
    }
}
