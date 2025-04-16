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

use Payever\Sdk\Notification\Http\RequestEntity\NotificationRequest;

/**
 * Interface describes functions of NotificationHandler
 */
interface NotificationHandlerInterface
{
    /**
     * Must process notification and fill given NotificationResult instance.
     * Must handle all exceptions internally and put exception messages inside result object.
     *
     * @param NotificationRequest $notification
     * @param NotificationResult  $notificationResult
     *
     * @return void
     */
    public function handleNotification(
        NotificationRequest $notification,
        NotificationResult $notificationResult
    );
}
