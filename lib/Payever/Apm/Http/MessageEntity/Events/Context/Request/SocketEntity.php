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
 * This class represents SocketEntity
 *
 * @method bool  getEncrypted()
 * @method $this setEncrypted(bool $encrypted)
 */
class SocketEntity extends ApmMessageEntity
{
    /** @var bool $encrypted */
    protected $encrypted;

    /** @var string $remoteAddress */
    protected $remoteAddress;

    /**
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __construct($data = [])
    {
        if (!isset($data['remote_address'])) {
            $data['remote_address'] = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
        }

        if (!isset($data['encrypted'])) {
            $data['encrypted'] = isset($_SERVER['HTTPS']);
        }

        parent::__construct($data);
    }

    /**
     * @param string $address
     *
     * @return $this
     */
    public function setRemoteAddress($address)
    {
        $this->remoteAddress = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getRemoteAddress()
    {
        return $this->remoteAddress;
    }
}
