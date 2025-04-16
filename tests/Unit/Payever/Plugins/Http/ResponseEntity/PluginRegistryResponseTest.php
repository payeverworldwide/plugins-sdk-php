<?php

namespace Payever\Tests\Unit\Payever\Plugins\Http\ResponseEntity;

use Payever\Sdk\Plugins\Http\ResponseEntity\PluginRegistryResponse;
use Payever\Tests\Unit\Payever\Core\Http\AbstractMessageEntityTest;
use Payever\Tests\Unit\Payever\Plugins\Http\RequestEntity\PluginRegistryRequestTest;

class PluginRegistryResponseTest extends AbstractMessageEntityTest
{
    public static function getScheme()
    {
        static::$scheme = PluginRegistryRequestTest::getScheme();
        static::$scheme['_id'] = 'stub-id';

        return parent::getScheme();
    }

    public function getEntity()
    {
        return new PluginRegistryResponse();
    }
}
