<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Metadata
 * @package   Payever\Apm
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\Apm\Http\MessageEntity\Events\Metadata;

use Payever\Sdk\Apm\Http\MessageEntity\ApmMessageEntity;
use Payever\Sdk\Apm\Http\MessageEntity\Events\Metadata\Service\AgentEntity;

/**
 * This class represents ServiceEntity
 *
 * @method string      getName()
 * @method string      getVersion()
 * @method AgentEntity getAgent()
 * @method string      getEnvironment()
 * @method $this       setName(string $name)
 * @method $this       setVersion(string $version)
 * @method $this       setEnvironment(string $version)
 */
class ServiceEntity extends ApmMessageEntity
{
    /** @var string $name */
    protected $name;

    /** @var string $version */
    protected $version;

    /** @var AgentEntity $agent */
    protected $agent;

    /** @var string $environment */
    protected $environment;

    /**
     * @param array $data
     */
    public function __construct($data = [])
    {
        if (!isset($data['agent'])) {
            $data['agent'] = new AgentEntity();
        }

        parent::__construct($data);
    }

    /**
     * Sets agent
     *
     * @param AgentEntity|string|array $agent
     *
     * @return $this
     */
    public function setAgent($agent)
    {
        $this->agent = $this->getClassInstance(AgentEntity::class, $agent);

        return $this;
    }
}
