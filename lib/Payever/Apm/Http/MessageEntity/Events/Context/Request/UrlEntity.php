<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Request
 * @package   Payever\Apm
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Apm\Http\MessageEntity\Events\Context\Request;

use Payever\Sdk\Apm\Http\MessageEntity\ApmMessageEntity;

/**
 * This class represents UrlEntity
 *
 * @method string getProtocol()
 * @method string getHostname()
 * @method string getPort()
 * @method string getPathname()
 * @method string getSearch()
 * @method string getFull()
 * @method $this  setProtocol(string $protocol)
 * @method $this  setHostname(string $hostname)
 * @method $this  setPort(string $port)
 * @method $this  setPathname(string $pathname)
 * @method $this  setSearch(string $search)
 * @method $this  setFull(string $full)
 */
class UrlEntity extends ApmMessageEntity
{
    /** @var string $protocol */
    protected $protocol;

    /** @var string $hostname */
    protected $hostname;

    /** @var string $port */
    protected $port;

    /** @var string $pathname */
    protected $pathname;

    /** @var string $search */
    protected $search;

    /** @var string $full */
    protected $full;

    /**
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function __construct($data = [])
    {
        if (!isset($data['protocol'])) {
            $data['protocol'] = isset($_SERVER['HTTPS']) ? 'https' : 'http';
        }

        if (!isset($data['hostname'])) {
            $data['hostname'] = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';
        }

        if (!isset($data['port'])) {
            $data['port'] = isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : 0;
        }

        if (!isset($data['pathname'])) {
            $data['pathname'] = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';
        }

        if (!isset($data['search'])) {
            $data['search'] = '?' . (isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '');
        }

        parent::__construct($data);

        if (!isset($data['full'])) {
            $this->setFull($this->getFullRequestUri());
        }
    }

    /**
     * @return string
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    private function getFullRequestUri()
    {
        return $this->getProtocol() . '://' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') .
            (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '');
    }
}
