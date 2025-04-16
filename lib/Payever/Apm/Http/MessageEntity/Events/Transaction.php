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
use Payever\Sdk\Apm\Http\MessageEntity\Events\Transaction\SpanCountEntity;

/**
 * This class represents Transaction
 *
 * @method null|string getId()
 * @method null|int    getTimestamp()
 * @method null|string getName()
 * @method int         getDuration()
 * @method string      getType()
 * @method $this       setId(string $id)
 * @method $this       setTimestamp(string $timestamp)
 * @method $this       setName(string $name)
 * @method $this       setDuration(int $duration)
 * @method $this       setType(string $type)
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class Transaction extends ApmMessageEntity
{
    /** @var null|string $id */
    protected $id;

    /** @var null|int $timestamp */
    protected $timestamp;

    /** @var null|string $name */
    protected $name;

    /** @var int $duration */
    protected $duration = 0;

    /** @var string $type */
    protected $type = 'background_job';

    /** @var string $traceId */
    protected $traceId;

    /** @var SpanCountEntity $spanCount */
    protected $spanCount;

    /** @var ContextEntity $context */
    protected $context;

    /**
     * @param array $data
     */
    public function __construct($data = [])
    {
        if (!isset($data['context'])) {
            $data['context'] = new ContextEntity();
        }

        if (!isset($data['trace_id'])) {
            $data['trace_id'] = uniqid(microtime(true));
        }

        if (!isset($data['span_count'])) {
            $data['span_count'] = new SpanCountEntity();
        }

        parent::__construct($data);
    }

    /**
     * @param SpanCountEntity|array|string $spanCount
     *
     * @return $this
     */
    public function setSpanCount($spanCount)
    {
        $this->spanCount = $this->getClassInstance(SpanCountEntity::class, $spanCount);

        return $this;
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
     * @return SpanCountEntity
     */
    public function getSpanCount()
    {
        return $this->spanCount;
    }

    /**
     * @return string
     */
    public function getTraceId()
    {
        return $this->traceId;
    }

    /**
     * @param string $traceId
     *
     * @return $this
     */
    public function setTraceId($traceId)
    {
        $this->traceId = $traceId;

        return $this;
    }
}
