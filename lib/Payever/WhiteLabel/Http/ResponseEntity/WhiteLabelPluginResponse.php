<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  ResponseEntity
 * @package   Payever\WhiteLabel
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2025 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\WhiteLabel\Http\ResponseEntity;

use Payever\Sdk\Core\Http\MessageEntity\ResponseEntity;

/**
 * This class represents WhiteLabelPluginResponse
 *
 * @method string            getCode()
 * @method string            getNameEn()
 * @method string            getNameDe()
 * @method string            getShortDescriptionEn()
 * @method string            getShortDescriptionDe()
 * @method string            getDescriptionEn()
 * @method string            getDescriptionDe()
 * @method array             getSupportedMethods()
 * @method array             getCountries()
 * @method array             getCurrencies()
 * @method string            getCompanyEmail()
 * @method string            getCompanyName()
 * @method string            getCompanyUrl()
 * @method array|null        getImages()
 * @method bool              getAllowIframe()
 * @method $this             setCode(string $code)
 * @method $this             setNameEn(string $nameEn)
 * @method $this             setNameDe(string $nameDe)
 * @method $this             setShortDescriptionEn(string $shortDescriptionEn)
 * @method $this             setShortDescriptionDe(string $shortDescriptionDe)
 * @method $this             setDescriptionEn(string $descriptionEn)
 * @method $this             setDescriptionDe(string $descriptionDe)
 * @method $this             setSupportedMethods(array $supportedMethods)
 * @method $this             setCountries(array $countries)
 * @method $this             setCurrencies(array $currencies)
 * @method $this             setCompanyEmail(string $email)
 * @method $this             setCompanyName(string $name)
 * @method $this             setCompanyUrl(string $url)
 * @method $this             setImages(array $images)
 * @method $this             setAllowIframe(bool $allowIframe)
 */
class WhiteLabelPluginResponse extends ResponseEntity
{
    /** @var string $code */
    protected $code;

    /** @var string $nameEn */
    protected $nameEn;

    /** @var string $nameDe */
    protected $nameDe;

    /** @var string $shortDescriptionEn */
    protected $shortDescriptionEn;

    /** @var string $shortDescriptionDe */
    protected $shortDescriptionDe;

    /** @var string $descriptionEn */
    protected $descriptionEn;

    /** @var string $descriptionDe */
    protected $descriptionDe;

    /** @var array $supportedMethods */
    protected $supportedMethods = [];

    /** @var array $countries */
    protected $countries = [];

    /** @var array $currencies */
    protected $currencies = [];

    /** @var string $companyEmail */
    protected $companyEmail;

    /** @var string $companyName */
    protected $companyName;

    /** @var string $companyUrl */
    protected $companyUrl;

    /** @var array $images */
    protected $images = [];

    /** @var bool $allowIframe */
    protected $allowIframe;
}
