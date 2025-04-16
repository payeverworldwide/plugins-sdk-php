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
use Payever\Sdk\Apm\Http\MessageEntity\Events\Context\ContextMessageEntity;

/**
 * This class represents ContextEntity
 *
 * @method ContextMessageEntity getRequest()
 */
class ContextEntity extends ApmMessageEntity
{
    /** @var ContextMessageEntity $request */
    protected $request;

    /**
     * @param array $data
     */
    public function __construct($data = [])
    {
        if (!isset($data['request'])) {
            $data['request'] = new ContextMessageEntity();
        }

        parent::__construct($data);
    }

    /**
     * @param ContextMessageEntity|array|string $request
     *
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $this->getClassInstance(ContextMessageEntity::class, $request);

        return $this;
    }
}
