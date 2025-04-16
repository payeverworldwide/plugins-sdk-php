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

use Payever\Sdk\Apm\Http\MessageEntity\ApmMessageEntity;

/**
 * This class represents ExceptionEntity
 *
 * @method null|string        getMessage()
 * @method null|string        getType()
 * @method null|string        getCode()
 * @method StacktraceEntity[] getStacktrace()
 * @method $this              setStacktrace(array $stacktrace)
 * @method $this              setMessage(string $message)
 * @method $this              setType(string $type)
 * @method $this              setCode(string $code)
 */
class ExceptionEntity extends ApmMessageEntity
{
    /** @var string $message */
    protected $message;

    /** @var string $type */
    protected $type;

    /** @var string $code */
    protected $code;

    /** @var StacktraceEntity[] $stacktrace */
    protected $stacktrace = [];

    /**
     * @param StacktraceEntity $stacktrace
     *
     * @return $this
     */
    public function addStacktrace(StacktraceEntity $stacktrace)
    {
        $this->stacktrace[] = $stacktrace;

        return $this;
    }

    /**
     * @return StacktraceEntity
     */
    public function getStacktraceEntity()
    {
        return new StacktraceEntity();
    }
}
