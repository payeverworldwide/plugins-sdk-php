<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Error
 * @package   Payever\Apm
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Apm\Http\MessageEntity\Events\Error;

/**
 * This class represents LogEntity
 *
 * @method null|string getLevel()
 * @method $this       setLevel(string $level)
 */
class LogEntity extends ExceptionEntity
{
    /** @var string $level */
    protected $level;
}
