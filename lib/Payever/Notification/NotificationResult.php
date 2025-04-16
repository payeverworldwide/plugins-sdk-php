<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Notification
 * @package   Payever\Notification
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Notification;

/**
 * Utility class for unified notifications result representation
 * NotificationResult holds order status, messages, and errors, with methods to update and check status.
 */
class NotificationResult
{
    /** @var string $orderId */
    protected $orderId;

    /** @var bool $orderHasBeenCreated */
    protected $orderHasBeenCreated = false;

    /** @var string $previousOrderStatus */
    protected $previousOrderStatus;

    /** @var string $currentOrderStatus */
    protected $currentOrderStatus;

    /** @var string[] $messages */
    protected $messages = [];

    /** @var string[] $errors */
    protected $errors = [];

    /**
     * @param string $orderId
     *
     * @return $this
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return $this
     */
    public function orderHasBeenCreated()
    {
        $this->orderHasBeenCreated = true;

        return $this;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setPreviousOrderStatus($status)
    {
        $this->previousOrderStatus = $status;

        return $this;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setCurrentOrderStatus($status)
    {
        $this->currentOrderStatus = $status;

        return $this;
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function addMessage($message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * @param string $error
     *
     * @return $this
     */
    public function addError($error)
    {
        $this->errors[] = $error;

        return $this;
    }

    /**
     * @param \Exception $exception
     *
     * @return $this
     */
    public function addException(\Exception $exception)
    {
        $this->addError(sprintf('%s: %s', $exception->getCode(), $exception->getMessage()));

        return $this;
    }

    /**
     * @return bool
     */
    public function isFailed()
    {
        return !empty($this->errors);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $pieces = [];

        if ($this->isFailed()) {
            $pieces[] = 'FAILED';
        }

        if (!empty($this->errors)) {
            $pieces[] = sprintf('[errors=%s]', implode(';', $this->errors));
        }

        if ($this->orderHasBeenCreated) {
            $pieces[] = '[orderCreated]';
        }

        if ($this->orderId) {
            $pieces[] = sprintf('[orderId=%s]', $this->orderId);
        }

        if ($this->previousOrderStatus) {
            $pieces[] = sprintf('[previousStatus=%s]', $this->previousOrderStatus);
        }

        if ($this->currentOrderStatus) {
            $pieces[] = sprintf('[currentStatus=%s]', $this->currentOrderStatus);
        }

        if (!empty($this->messages)) {
            $pieces[] = sprintf('[messages=%s]', implode(';', $this->messages));
        }

        return sprintf('Result: %s', implode(' ', $pieces));
    }
}
