<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Authorization
 * @package   Payever\Apm
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Apm\Authorization;

/**
 * This class represents ApmApiClient
 * The ApmSecretService class provides methods to get and save the APM secret
 */
class ApmSecretService implements ApmSecretInterface
{
    /**
     * @inheritdoc
     */
    public function get()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function save($apmSecret)
    {
        return $this;
    }
}
