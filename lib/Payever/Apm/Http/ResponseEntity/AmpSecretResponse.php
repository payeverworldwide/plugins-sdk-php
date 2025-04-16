<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  ResponseEntity
 * @package   Payever\Apm
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Apm\Http\ResponseEntity;

use Payever\Sdk\Core\Http\MessageEntity\ResponseEntity;

/**
 * This class represents AmpSecretResponse
 */
class AmpSecretResponse extends ResponseEntity
{
    /** @var null|string $apmSecret */
    protected $apmSecret;

    /**
     * @return string|null
     */
    public function getApmSecret()
    {
        return $this->apmSecret;
    }

    /**
     * @param string $secret
     *
     * @return $this
     */
    public function setApmSecret($secret)
    {
        $this->apmSecret = $secret;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getRequired()
    {
        return [
            'apmSecret'
        ];
    }
}
