<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Context
 * @package   Payever\Apm
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Apm\Http\MessageEntity\Events\Context;

use Payever\Sdk\Apm\Http\MessageEntity\ApmMessageEntity;
use Payever\Sdk\Apm\Http\MessageEntity\Events\Context\Request\HeadersEntity;
use Payever\Sdk\Apm\Http\MessageEntity\Events\Context\Request\SocketEntity;
use Payever\Sdk\Apm\Http\MessageEntity\Events\Context\Request\UrlEntity;

/**
 * This class represents RequestEntity
 *
 * @method string        getMethod()
 * @method SocketEntity  getSocket()
 * @method UrlEntity     getUrl()
 * @method HeadersEntity getHeaders()
 * @method $this         setMethod(string $method)
 */
class ContextMessageEntity extends ApmMessageEntity
{
    const METHOD_CLI = 'cli';

    /** @var string $httpVersion */
    protected $httpVersion;

    /** @var string $method */
    protected $method;

    /** @var SocketEntity $socket */
    protected $socket;

    /** @var UrlEntity $url */
    protected $url;

    /** @var HeadersEntity $headers */
    protected $headers;

    /**
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __construct($data = [])
    {
        if (!isset($data['http_version'])) {
            $data['http_version'] = $this->getProtocolVersion();
        }

        if (!isset($data['method'])) {
            $data['method'] = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : self::METHOD_CLI;
        }

        if (!isset($data['socket'])) {
            $data['socket'] = new SocketEntity();
        }

        if (!isset($data['url'])) {
            $data['url'] = new UrlEntity();
        }

        if (!isset($data['headers'])) {
            $data['headers'] = new HeadersEntity();
        }

        parent::__construct($data);
    }

    /**
     * @param SocketEntity|string|array $socket
     *
     * @return $this
     */
    public function setSocket($socket)
    {
        $this->socket = $this->getClassInstance(SocketEntity::class, $socket);

        return $this;
    }

    /**
     * @param UrlEntity|string|array $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $this->getClassInstance(UrlEntity::class, $url);

        return $this;
    }

    /**
     * @param HeadersEntity|string|array $headers
     *
     * @return $this
     */
    public function setHeaders($headers)
    {
        $this->headers = $this->getClassInstance(HeadersEntity::class, $headers);

        return $this;
    }

    /**
     * @param string $version
     *
     * @return $this
     */
    public function setHttpVersion($version)
    {
        $this->httpVersion = $version;

        return $this;
    }

    /**
     * @return string
     */
    public function getHttpVersion()
    {
        return $this->httpVersion;
    }

    /**
     * @return false|string|null
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     * @SuppressWarnings(PHPMD.CamelCaseVariableName)
     */
    private function getProtocolVersion()
    {
        $protocolVersion = null;
        if (isset($_SERVER['SERVER_PROTOCOL'])) {
            $SERVER_PROTOCOL = $_SERVER['SERVER_PROTOCOL'] ?: '';
            $protocolVersion = substr($SERVER_PROTOCOL, strpos($SERVER_PROTOCOL, DIRECTORY_SEPARATOR) + 1);
        }

        return $protocolVersion;
    }
}
