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
 * Interface describes functions of ApmSecretService
 */
interface ApmSecretInterface
{
    /**
     * @return string|null
     */
    public function get();

    /**
     * @param string $apmSecret
     *
     * @return $this
     */
    public function save($apmSecret);
}
