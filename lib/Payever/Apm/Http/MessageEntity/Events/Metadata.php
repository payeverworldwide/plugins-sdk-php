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
use Payever\Sdk\Apm\Http\MessageEntity\Events\Metadata\ServiceEntity;
use Payever\Sdk\Apm\Http\MessageEntity\Events\Metadata\SystemEntity;

/**
 * This class represents Metadata
 *
 * @method ServiceEntity getService()
 * @method SystemEntity  getSystem()
 */
class Metadata extends ApmMessageEntity
{
    /** @var ServiceEntity $service */
    protected $service;

    /** @var SystemEntity $system */
    protected $system;

    /**
     * @param array $data
     */
    public function __construct($data = [])
    {
        if (!isset($data['service'])) {
            $data['service'] = new ServiceEntity();
        }
        if (!isset($data['system'])) {
            $data['system'] = new SystemEntity();
        }

        parent::__construct($data);
    }

    /**
     * Sets service entity
     *
     * @param ServiceEntity|array|string $service
     *
     * @return $this
     */
    public function setService($service)
    {
        $this->service = $this->getClassInstance(ServiceEntity::class, $service);

        return $this;
    }

    /**
     * Sets system entity
     *
     * @param SystemEntity|array|string $system
     *
     * @return $this
     */
    public function setSystem($system)
    {
        $this->system = $this->getClassInstance(SystemEntity::class, $system);

        return $this;
    }
}
