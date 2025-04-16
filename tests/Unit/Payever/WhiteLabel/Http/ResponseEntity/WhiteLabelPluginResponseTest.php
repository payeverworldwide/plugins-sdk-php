<?php

namespace Payever\Tests\Unit\Payever\WhiteLabel\Http\ResponseEntity;

use Payever\Sdk\WhiteLabel\Http\ResponseEntity\WhiteLabelPluginResponse;
use Payever\Tests\Unit\Payever\Core\Http\AbstractResponseEntityTest;

/**
 * Class WhiteLabelPluginResponseEntityTest
 *
 * @see \Payever\Sdk\WhiteLabel\Http\ResponseEntity\WhiteLabelPluginResponse
 */
class WhiteLabelPluginResponseTest extends AbstractResponseEntityTest
{
    protected static $scheme = array(
        'code' => 'stub_code',
        'name_en' => 'plugin_name_en',
        'name_de' => 'plugin_name_de',
        'short_description_en' => 'short_description_en',
        'short_description_de' => 'short_description_de',
        'description_en' => 'short_description_en',
        'description_de' => 'short_description_de',
        'supported_methods' => ['stripe'],
        'countries' => ['DE'],
        'currencies' => ['EUR'],
        'company_email' => 'test@company.com',
        'company_name' => 'Company',
        'company_url' => 'company.com',
        'images' => ['test.jpg'],
        'allow_iframe' => true,
    );

    public function getEntity()
    {
        return new WhiteLabelPluginResponse();
    }
}
