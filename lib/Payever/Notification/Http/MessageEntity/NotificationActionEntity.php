<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Notification
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Notification\Http\MessageEntity;

use Payever\Sdk\Core\Base\MessageEntity;

/**
 * @method null|float  getAmount()
 * @method null|string getReference()
 * @method null|string getSource()
 * @method null|string getType()
 * @method null|string getUniqueIdentifier()
 * @method $this       setAmount(float $amount)
 * @method $this       setReference(string $reference)
 * @method $this       setSource(string $source)
 * @method $this       setType(string $type)
 * @method $this       setUniqueIdentifier(string $uniqueIdentifier)
 */
class NotificationActionEntity extends MessageEntity
{
    /** @var null|float $amount */
    protected $amount;

    /** @var null|string $reference */
    protected $reference;

    /** @var null|string $source */
    protected $source;

    /** @var null|string $type */
    protected $type;

    /** @var null|string $uniqueIdentifier */
    protected $uniqueIdentifier;
}
