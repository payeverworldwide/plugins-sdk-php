<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  RequestEntity
 * @package   Payever\Notification
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Notification\Http\RequestEntity;

use Payever\Sdk\Core\Http\MessageEntity\RequestEntity;
use Payever\Sdk\Notification\Http\MessageEntity\NotificationActionEntity;
use Payever\Sdk\Notification\Http\MessageEntity\NotificationPaymentEntity;

/**
 * @method $this                         setNotificationType(string $notificationType)
 * @method $this                         setNotificationTypesAvailable(array $notificationTypes)
 * @method string                        getNotificationType()
 * @method array                         getNotificationTypesAvailable()
 * @method \DateTime|false               getCreatedAt()
 * @method NotificationPaymentEntity     getPayment()
 * @method null|NotificationActionEntity getAction()
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class NotificationRequest extends RequestEntity
{
    /** @var string $notificationType */
    protected $notificationType;

    /** @var array $notificationTypesAvailable */
    protected $notificationTypesAvailable;

    /** @var \DateTime|bool $createdAt */
    protected $createdAt;

    /** @var NotificationPaymentEntity $payment */
    protected $payment;

    /** @var null|NotificationActionEntity $action */
    protected $action;

    /**
     * @param string $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        if ($createdAt) {
            $this->createdAt = date_create($createdAt);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $types = $this->getNotificationTypesAvailable();

        return is_array($types) && in_array($this->getNotificationType(), $types);
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setData(array $data)
    {
        $this->payment = new NotificationPaymentEntity($data['payment']);

        if (array_key_exists('action', $data)) {
            $this->action = new NotificationActionEntity($data['action']);
        }

        return $this;
    }
}
