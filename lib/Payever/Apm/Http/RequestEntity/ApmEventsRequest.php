<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  RequestEntity
 * @package   Payever\Apm
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Apm\Http\RequestEntity;

use Payever\Sdk\Apm\Http\MessageEntity\Events\Error as ErrorEvent;
use Payever\Sdk\Apm\Http\MessageEntity\Events\Metadata;
use Payever\Sdk\Apm\Http\MessageEntity\Events\Transaction;
use Payever\Sdk\Core\Http\MessageEntity\RequestEntity;

/**
 * This class represents ApmEventsRequest
 */
class ApmEventsRequest extends RequestEntity
{
    /** @var null|Metadata $metadata */
    protected $metadata;

    /** @var null|ErrorEvent $error */
    protected $error;

    /** @var null|Transaction $transaction */
    protected $transaction;

    /**
     * @param Metadata $metadata
     *
     * @return $this
     */
    public function setMetaEvent(Metadata $metadata)
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * @param ErrorEvent $error
     *
     * @return $this
     */
    public function setErrorEvent(ErrorEvent $error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * @param Transaction $transaction
     *
     * @return $this
     */
    public function setTransactionEvent(Transaction $transaction)
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * @return null|Metadata
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @return null|ErrorEvent
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return null|Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }
}
