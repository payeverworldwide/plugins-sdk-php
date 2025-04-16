<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Events
 * @package   Payever\Apm
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Apm\Http\MessageEntity\Events;

use Payever\Sdk\Apm\Http\MessageEntity\ApmMessageEntity;
use Payever\Sdk\Apm\Http\MessageEntity\Events\Error\ExceptionEntity;
use Payever\Sdk\Apm\Http\MessageEntity\Events\Error\LogEntity;

/**
 * This class represents Error
 *
 * @method string          getId()
 * @method string          getTimestamp()
 * @method string          getCulprit()
 * @method ContextEntity   getContext()
 * @method LogEntity       getLog()
 * @method ExceptionEntity getException()
 * @method $this           setId(string $id)
 * @method $this           setTimestamp(string $id)
 * @method $this           setCulprit(string $id)
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class Error extends ApmMessageEntity
{
    /** @var string $id */
    protected $id;

    /** @var string $timestamp */
    protected $timestamp;

    /** @var string $culprit */
    protected $culprit;

    /** @var ContextEntity $context */
    protected $context;

    /** @var LogEntity $log */
    protected $log;

    /** @var ExceptionEntity $exception */
    protected $exception;

    /** @var string $transactionId */
    protected $transactionId;

    /** @var string $parentId */
    protected $parentId;

    /** @var string $traceId */
    protected $traceId;

    /**
     * @param array $data
     */
    public function __construct($data = [])
    {
        if (!isset($data['log'])) {
            $data['log'] = new LogEntity();
        }

        if (!isset($data['exception'])) {
            $data['exception'] = new ExceptionEntity();
        }

        if (!isset($data['context'])) {
            $data['context'] = new ContextEntity();
        }

        parent::__construct($data);
    }

    /**
     * @param ContextEntity|array|string $context
     *
     * @return $this
     */
    public function setContext($context)
    {
        $this->context = $this->getClassInstance(ContextEntity::class, $context);

        return $this;
    }

    /**
     * @param LogEntity|array|string $log
     *
     * @return $this
     */
    public function setLog($log)
    {
        $this->log = $this->getClassInstance(LogEntity::class, $log);
        $this->exception = null;

        return $this;
    }

    /**
     * @param ExceptionEntity|array|string $exception
     *
     * @return $this
     */
    public function setException($exception)
    {
        $this->exception = $this->getClassInstance(ExceptionEntity::class, $exception);
        $this->log = null;

        return $this;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setTransactionId($id)
    {
        $this->transactionId = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setParentId($id)
    {
        $this->parentId = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setTraceId($id)
    {
        $this->traceId = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTraceId()
    {
        return $this->traceId;
    }
}
