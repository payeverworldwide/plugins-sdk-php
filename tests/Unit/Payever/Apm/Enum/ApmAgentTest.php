<?php

namespace Payever\Tests\Unit\Payever\Apm\Enum;

use PHPUnit\Framework\TestCase;
use Payever\Sdk\Apm\Enum\ApmAgent;

class ApmAgentTest extends TestCase
{
    public function testCommandNames()
    {
        $this->assertEquals(
            $this->collectConstants('Payever\Sdk\Apm\Enum\ApmAgent'),
            ApmAgent::enum()
        );
    }

    /**
     * @return array
     *
     * @throws \ReflectionException
     */
    private function collectConstants($className)
    {
        $reflection = new \ReflectionClass($className);

        return $reflection->getConstants();
    }
}
