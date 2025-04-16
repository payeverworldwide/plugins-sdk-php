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
 * This class represents HeadersEntity
 *
 * @method string getCookie()
 * @method $this  setCookie(string $cookie)
 */
class HeadersEntity extends ApmMessageEntity
{
    /** @var string $cookie */
    protected $cookie = '';

    /**
     * @param array $data
     */
    public function __construct($data = [])
    {
        if (!isset($data['cookie']) && function_exists('getallheaders')) {
            $headers = getallheaders();
            $data['cookie'] = isset($headers['Cookie']) ? $headers['Cookie'] : '';
        }

        parent::__construct($data);
    }
}
