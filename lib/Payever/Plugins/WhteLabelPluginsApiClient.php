<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Plugins
 * @package   Payever\Plugins
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\Sdk\Plugins;

use Payever\Sdk\Core\Http\Client\CurlClient;
use Payever\Sdk\Core\Http\RequestBuilder;
use Payever\Sdk\Core\Http\RequestEntity;
use Payever\Sdk\Core\Http\Response;
use Payever\Sdk\Core\Http\ResponseEntity;
use Payever\Sdk\Plugins\Base\WhiteLabelPluginsApiClientInterface;
use Payever\Sdk\Plugins\Http\ResponseEntity\WhiteLabelPluginResponseEntity;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class WhtieLabelPluginsApiClient implements WhiteLabelPluginsApiClientInterface
{
    const URL_LIVE = 'http://localhost:3000/';
    const SUB_URL_WL_PLUGIN = '/api/wl/plugin/%s';

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function getWhiteLabelPluginByCode($code = null)
    {
        $request = RequestBuilder::get($this->buildWhiteLabelPluginUrl($code))
            ->setResponseEntity(new WhiteLabelPluginResponseEntity())
            ->build();

        return $this->getHttpClient()->execute($request);
    }

    /**
     * @param string $url
     * @param RequestEntity $requestEntity
     * @param ResponseEntity $responseEntity
     * @return Response
     *
     * @throws \Exception
     */
    private function doPublicJsonPostRequest($url, RequestEntity $requestEntity, ResponseEntity $responseEntity)
    {
        $request = RequestBuilder::post($url)
            ->contentTypeIsJson()
            ->setRequestEntity($requestEntity)
            ->setResponseEntity($responseEntity)
            ->build();

        return $this->getHttpClient()->execute($request);
    }

    /**
     * @return CurlClient
     */
    private function getHttpClient()
    {
        if ($this->httpClient === null) {
            $this->httpClient = new CurlClient();
        }

        return $this->httpClient;
    }

    /**
     * @param int|null $fromTimestamp
     * @return string
     */
    private function buildWhiteLabelPluginUrl($code = null)
    {
        return sprintf('%s%s', $this->getLiveBaseUrl(), sprintf(static::SUB_URL_WL_PLUGIN, $code));
    }

    /**
     * @return string
     */
    private function getLiveBaseUrl()
    {
        $url = static::URL_LIVE;

        if (substr($url, -1) != '/') {
            $url .= '/';
        }

        return $url;
    }
}
