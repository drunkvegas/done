<?php
/**
 * Config model that is aware of all Mage_Paypal payment methods
 * Works with PayPal-specific system configuration
 */
class Ebcomm_PaypalMx_Model_Config
{
    /**
     * PayPal Standard
     * @var string
     */
	const METHOD_PPMX        = "ppmx";
	const METHOD_PPMX_DEBITO        = 'ppmx_debito2';
	const METHOD_PPMX_MENSUALIDADES        = 'ppmx_mensualidades2';
	
    const METHOD_WPS         = 'paypalmx_standard';
    /**
     * PayPal Website Payments Pro - Express Checkout
     * @var string
     */
    const METHOD_WPP_EXPRESS = 'paypalmx_express';

    /**
     * PayPal Website Payments Pro - Direct Payments
     * @var string
     */
    const METHOD_WPP_DIRECT  = 'paypalmx_direct';

    /**
     * Direct Payments (Payflow Edition)
     * @var string
     */
    const METHOD_WPP_PE_DIRECT  = 'paypaluk_direct';

    /**
     * Express Checkout (Payflow Edition)
     * @var string
     */
    const METHOD_WPP_PE_EXPRESS  = 'paypaluk_express';

    /**
     * Payflow Pro Gateway
     * @var string
     */
    const METHOD_PAYFLOWPRO         = 'verisign';

    const METHOD_PAYFLOWLINK        = 'payflow_link';
    const METHOD_PAYFLOWADVANCED    = 'payflow_advanced';

    const METHOD_HOSTEDPRO          = 'hosted_pro';

    const METHOD_BILLING_AGREEMENT  = 'paypal_billing_agreement';
	

    /**
     * Buttons and images
     * @var string
     */
    const EC_FLAVOR_DYNAMIC = 'dynamic';
    const EC_FLAVOR_STATIC  = 'static';
    const EC_BUTTON_TYPE_SHORTCUT = 'ecshortcut';
    const EC_BUTTON_TYPE_MARK     = 'ecmark';
    const PAYMENT_MARK_37x23   = '37x23';
    const PAYMENT_MARK_50x34   = '50x34';
    const PAYMENT_MARK_60x38   = '60x38';
    const PAYMENT_MARK_180x113 = '180x113';

    const DEFAULT_LOGO_TYPE = 'wePrefer_150x60';

    /**
     * Payment actions
     * @var string
     */
    const PAYMENT_ACTION_SALE  = 'Sale';
    const PAYMENT_ACTION_ORDER = 'Order';
    const PAYMENT_ACTION_AUTH  = 'Authorization';

    /**
     * Authorization amounts for Account Verification
     *
     * @deprecated since 1.6.2.0
     * @var int
     */
    const AUTHORIZATION_AMOUNT_ZERO = 0;
    const AUTHORIZATION_AMOUNT_ONE = 1;
    const AUTHORIZATION_AMOUNT_FULL = 2;

    /**
     * Require Billing Address
     * @var int
     */
    const REQUIRE_BILLING_ADDRESS_NO = 0;
    const REQUIRE_BILLING_ADDRESS_ALL = 1;
    const REQUIRE_BILLING_ADDRESS_VIRTUAL = 2;

    /**
     * Fraud management actions
     * @var string
     */
    const FRAUD_ACTION_ACCEPT = 'Acept';
    const FRAUD_ACTION_DENY   = 'Deny';

    /**
     * Refund types
     * @var string
     */
    const REFUND_TYPE_FULL = 'Full';
    const REFUND_TYPE_PARTIAL = 'Partial';

    /**
     * Express Checkout flows
     * @var string
     */
    const EC_SOLUTION_TYPE_SOLE = 'Sole';
    const EC_SOLUTION_TYPE_MARK = 'Mark';
	
    /**
     * PPMX method type from config.xml
     * @var int
     */
    const PPMX_METHOD_MENS = 1;
    const PPMX_METHOD_NORM = 2;
    const PPMX_METHOD_DEB = 3;
    /**
     * Payment data transfer methods (Standard)
     *
     * @var string
     */
    const WPS_TRANSPORT_IPN      = 'ipn';
    const WPS_TRANSPORT_PDT      = 'pdt';
    const WPS_TRANSPORT_IPN_PDT  = 'ipn_n_pdt';

    /**
     * Billing Agreement Signup
     *
     * @var string
     */
    const EC_BA_SIGNUP_AUTO     = 'auto';
    const EC_BA_SIGNUP_ASK      = 'ask';
    const EC_BA_SIGNUP_NEVER    = 'never';

    /**
     * Default URL for centinel API (PayPal Direct)
     *
     * @var string
     */
    public $centinelDefaultApiUrl = 'https://paypal.cardinalcommerce.com/maps/txns.asp';

    /**
     * Current payment method code
     * @var string
     */
    protected $_methodCode = null;

    /**
     * Current store id
     *
     * @var int
     */
    protected $_storeId = null;

    /**
     * Instructions for generating proper BN code
     *
     * @var array
     */
    protected $_buildNotationPPMap = array(
    		'paypalmx' => 'ppmx',
    		'paypalmx_standard'  => 'WPS',
    		'paypalmx_express'   => 'EC',
    		'paypalmx_direct'    => 'DP',
    		'paypaluk_express' => 'EC',
    		'paypaluk_direct'  => 'DP',
    );

    /**
     * Style system config map (Express Checkout)
     *
     * @var array
     */
    protected $_ecStyleConfigMap = array(
        'page_style'    => 'page_style',
        'paypalmx_hdrimg' => 'hdrimg',
        'paypalmx_hdrbordercolor' => 'hdrbordercolor',
        'paypalmx_hdrbackcolor'   => 'hdrbackcolor',
        'paypalmx_payflowcolor'   => 'payflowcolor',
    );

    /**
     * Currency codes supported by PayPal methods
     *
     * @var array
     */
    protected $_supportedCurrencyCodes = array('AUD', 'CAD', 'CZK', 'DKK', 'EUR', 'HKD', 'HUF', 'ILS', 'JPY', 'MXN',
        'NOK', 'NZD', 'PLN', 'GBP', 'SGD', 'SEK', 'CHF', 'USD', 'TWD', 'THB');

    /**
     * Merchant country supported by PayPal
     *
     * @var array
     */
    protected $_supportedCountryCodes = array('MX');

    /**
     * Buyer country supported by PayPal
     *
     * @var array
     */
    protected $_supportedBuyerCountryCodes = array('MX ');

    /**
     * Locale codes supported by misc images (marks, shortcuts etc)
     *
     * @var array
     * @link https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_ECButtonIntegration#id089QD0O0TX4__id08AH904I0YK
     */
    protected $_supportedImageLocales = array( 'es_ES',
    );

    /**
     * Set method and store id, if specified
     *
     * @param array $params
     */
    public function __construct($params = array())
    {
        if ($params) {
            $method = array_shift($params);
            $this->setMethod($method);
            if ($params) {
                $storeId = array_shift($params);
                $this->setStoreId($storeId);
            }
        }
    }

    /**
     * Method code setter
     *
     * @param string|Mage_Payment_Model_Method_Abstract $method
     * @return Mage_Paypal_Model_Config
     */
    public function setMethod($method)
    {
        if ($method instanceof Mage_Payment_Model_Method_Abstract) {
            $this->_methodCode = $method->getCode();
        } elseif (is_string($method)) {
            $this->_methodCode = $method;
        }
        return $this;
    }

    /**
     * Payment method instance code getter
     *
     * @return string
     */
    public function getMethodCode()
    {
        return $this->_methodCode;
    }

    /**
     * Store ID setter
     *
     * @param int $storeId
     * @return Mage_Paypal_Model_Config
     */
    public function setStoreId($storeId)
    {
        $this->_storeId = (int)$storeId;
        return $this;
    }

    /**
     * Check whether method active in configuration and supported for merchant country or not
     *
     * @param string $method Method code
     * @return bool
     */
    public function isMethodActive($method)
    {
        if ($this->isMethodSupportedForCountry($method)
            && Mage::getStoreConfigFlag("payment/{$method}/active", $this->_storeId)
        ) {
            return true;
        }
        return false;
    }
	public function isContextAvailable($contextpos = null,$method = null){
		if(!$contextpos){
			return false;
		}
		if ($method === null) {
			$method = $this->getMethodCode();
		}
		if (Mage::getStoreConfigFlag("payment/{$method}/{$contextpos}", $this->_storeId)) {
			return true;
		}
		return false;
		
	}
    /**
     * Check whether method available for checkout or not
     * Logic based on merchant country, methods dependence
     *
     * @param string $method Method code
     * @return bool
     */
    public function isMethodAvailable($methodCode = null)
    {	
    	
        if ($methodCode === null) {
            $methodCode = $this->getMethodCode();
        }
        /*
        if(($methodCode == self::METHOD_PPMX_DEBITO || $methodCode == self::METHOD_PPMX_MENSUALIDADES) && !$this->isMethodActive(self::METHOD_PPMX)){
        	return false;
        }*/
        
        $result = true;

        if (!$this->isMethodActive($methodCode)) {
            $result = false;
        }

        switch ($methodCode) {
        	case self::METHOD_PPMX:
        		break;
        	case self::METHOD_PPMX_DEBITO:
        		if ($this->isMethodActive(self::METHOD_PPMX)){
        			$result = false;
        		}
        		break;
        	case self::METHOD_PPMX_MENSUALIDADES:
        		if ($this->isMethodActive(self::METHOD_PPMX)){
        			$result = false;
        		}
        		break;
            case self::METHOD_WPS:
                if (!$this->businessAccount) {
                    $result = false;
                    break;
                }
                // check for direct payments dependence
                if ($this->isMethodActive(self::METHOD_WPP_DIRECT)
                    || $this->isMethodActive(self::METHOD_WPP_PE_DIRECT)) {
                    $result = false;
                }
                break;
            case self::METHOD_WPP_EXPRESS:
                // check for direct payments dependence
                if ($this->isMethodActive(self::METHOD_WPP_PE_DIRECT)) {
                    $result = false;
                } elseif ($this->isMethodActive(self::METHOD_WPP_DIRECT)) {
                    $result = true;
                }
                break;
            case self::METHOD_WPP_PE_EXPRESS:
                // check for direct payments dependence
                if ($this->isMethodActive(self::METHOD_WPP_PE_DIRECT)) {
                    $result = true;
                } elseif (!$this->isMethodActive(self::METHOD_WPP_PE_DIRECT)
                          && !$this->isMethodActive(self::METHOD_PAYFLOWPRO)) {
                    $result = false;
                }
                break;
            case self::METHOD_BILLING_AGREEMENT:
                $result = $this->isWppApiAvailabe();
                break;
            case self::METHOD_WPP_DIRECT:
            case self::METHOD_WPP_PE_DIRECT:
                break;
        }
        return $result;
    }

    /**
     * Config field magic getter
     * The specified key can be either in camelCase or under_score format
     * Tries to map specified value according to set payment method code, into the configuration value
     * Sets the values into public class parameters, to avoid redundant calls of this method
     *
     * @param string $key
     * @return string|null
     */
    public function __get($key)
    {
        $underscored = strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $key));
        $value = Mage::getStoreConfig($this->_getSpecificConfigPath($underscored), $this->_storeId);
        $value = $this->_prepareValue($underscored, $value);
        $this->$key = $value;
        $this->$underscored = $value;
        return $value;
    }

    /**
     * Perform additional config value preparation and return new value if needed
     *
     * @param string $key Underscored key
     * @param string $value Old value
     * @return string Modified value or old value
     */
    protected function _prepareValue($key, $value)
    {
        // Always set payment action as "Sale" for Unilateral payments in EC
        if ($key == 'payment_action'
            && $value != self::PAYMENT_ACTION_SALE
            && $this->shouldUseUnilateralPayments())
        {
            return self::PAYMENT_ACTION_SALE;
        }
        return $value;
    }

    /**
     * Return merchant country codes supported by PayPal
     *
     * @return array
     */
    public function getSupportedMerchantCountryCodes()
    {
        return $this->_supportedCountryCodes;
    }

    /**
     * Return buyer country codes supported by PayPal
     *
     * @return array
     */
    public function getSupportedBuyerCountryCodes()
    {
        return $this->_supportedBuyerCountryCodes;
    }

    /**
     * Return merchant country code, use default country if it not specified in General settings
     *
     * @return string
     */
    public function getMerchantCountry()
    {
        $countryCode = Mage::getStoreConfig($this->_mapGeneralFieldset('merchant_country'), $this->_storeId);
        if (!$countryCode) {
            $countryCode = Mage::helper('core')->getDefaultCountry($this->_storeId);
        }
        return $countryCode;
    }

    /**
     * Check whether method supported for specified country or not
     * Use $_methodCode and merchant country by default
     *
     * @return bool
     */
    public function isMethodSupportedForCountry($method = null, $countryCode = null)
    {
        if ($method === null) {
            $method = $this->getMethodCode();
        }
        if ($countryCode === null) {
            $countryCode = $this->getMerchantCountry();
        }
        $countryMethods = $this->getCountryMethods($countryCode);
        if (in_array($method, $countryMethods)) {
            return true;
        }
        return false;
    }

    /**
     * Return list of allowed methods for specified country iso code
     *
     * @param string $countryCode 2-letters iso code
     * @return array
     */
    public function getCountryMethods($countryCode = null)
    {
        $countryMethods = array(
        		'MX' => array(
        				self::METHOD_PPMX,
        		),
        );
        if ($countryCode === null) {
            return $countryMethods;
        }
        return isset($countryMethods[$countryCode]) ? $countryMethods[$countryCode] : $countryMethods['other'];    }

    /**
     * Get url for dispatching customer to express checkout start
     *
     * @param string $token
     * @return string
     */
    public function getExpressCheckoutStartUrl($token)
    {
        return $this->getPaypalUrl(array(
            'cmd'   => '_express-checkout',
            'token' => $token,
        ));
    }

    /**
     * Get url that allows to edit checkout details on paypal side
     *
     * @param $token
     * @return string
     */
    public function getExpressCheckoutEditUrl($token)
    {
        return $this->getPaypalUrl(array(
            'cmd'        => '_express-checkout',
            'useraction' => 'continue',
            'token'      => $token,
        ));
    }

    /**
     * Get url for additional actions that PayPal may require customer to do after placing the order.
     * For instance, redirecting customer to bank for payment confirmation.
     *
     * @param string $token
     * @return string
     */
    public function getExpressCheckoutCompleteUrl($token)
    {
        return $this->getPaypalUrl(array(
            'cmd'   => '_complete-express-checkout',
            'token' => $token,
        ));
    }

    /**
     * Retrieve url for initialization of billing agreement
     *
     * @param string $token
     * @return string
     */
    public function getStartBillingAgreementUrl($token)
    {
        return $this->getPaypalUrl(array(
            'cmd'   => '_customer-billing-agreement',
            'token' => $token,
        ));
    }

     /**
     * PayPal web URL generic getter
     *
     * @param array $params
     * @return string
     */
    public function getPaypalUrl(array $params = array())
    {
        return sprintf('https://www.%spaypal.com/webscr%s',
            $this->sandboxFlag ? 'sandbox.' : '',
            $params ? '?' . http_build_query($params) : ''
        );
    }

    /**
     * Whether Express Checkout button should be rendered dynamically
     *
     * @return bool
     */
    public function areButtonsDynamic()
    {
        return true;
    }

    /**
     * Express checkout shortcut pic URL getter
     * PayPal will ignore "pal", if there is no total amount specified
     *
     * @param string $localeCode
     * @param float $orderTotal
     * @param string $pal encrypted summary about merchant
     * @see Paypal_Model_Api_Nvp::callGetPalDetails()
     */
    public function getExpressCheckoutShortcutImageUrl($localeCode, $orderTotal = null, $pal = null)
    {
        if ($this->areButtonsDynamic()) {
            return $this->_getDynamicImageUrl(self::EC_BUTTON_TYPE_SHORTCUT, $localeCode, $orderTotal, $pal);
        }
        if ($this->buttonType === self::EC_BUTTON_TYPE_MARK) {
            return $this->getPaymentMarkImageUrl($localeCode);
        }
        return sprintf('https://www.paypal.com/%s/i/btn/btn_xpressCheckout.gif',
            $this->_getSupportedLocaleCode($localeCode));
    }

    /**
     * Get PayPal "mark" image URL
     * Supposed to be used on payment methods selection
     * $staticSize is applicable for static images only
     *
     * @param string $localeCode
     * @param float $orderTotal
     * @param string $pal
     * @param string $staticSize
     */
    public function getPaymentMarkImageUrl($localeCode, $orderTotal = null, $pal = null, $staticSize = null)
    {	
    	/*
        if ($this->areButtonsDynamic()) {
            return $this->_getDynamicImageUrl(self::EC_BUTTON_TYPE_MARK, $localeCode, $orderTotal, $pal);
        }*/

        if (null === $staticSize) {
            $staticSize = $this->paymentMarkSize;
        }
        switch ($staticSize) {
            case self::PAYMENT_MARK_37x23:
            case self::PAYMENT_MARK_50x34:
            case self::PAYMENT_MARK_60x38:
            case self::PAYMENT_MARK_180x113:
                break;
            default:
                $staticSize = self::PAYMENT_MARK_37x23;
        }
        return sprintf('https://www.paypal.com/%s/i/logo/PayPal_mark_%s.gif',
            $this->_getSupportedLocaleCode($localeCode), $staticSize);
    }

    /**
     * Get "What Is PayPal" localized URL
     * Supposed to be used with "mark" as popup window
     *
     * @param Mage_Core_Model_Locale $locale
     */
    public function getPaymentMarkWhatIsPaypalUrl(Mage_Core_Model_Locale $locale = null)
    {
        $countryCode = 'US';
        if (null !== $locale) {
            $shouldEmulate = (null !== $this->_storeId) && (Mage::app()->getStore()->getId() != $this->_storeId);
            if ($shouldEmulate) {
                $locale->emulate($this->_storeId);
            }
            $countryCode = $locale->getLocale()->getRegion();
            if ($shouldEmulate) {
                $locale->revert();
            }
        }
        return sprintf('https://www.paypal.com/%s/cgi-bin/webscr?cmd=xpt/Marketing/popup/OLCWhatIsPayPal-outside',
            strtolower($countryCode)
        );
    }

    /**
     * Getter for Solution banner images
     *
     * @param string $localeCode
     * @param bool $isVertical
     * @param bool $isEcheck
     */
    public function getSolutionImageUrl($localeCode, $isVertical = false, $isEcheck = false)
    {
        return sprintf('https://www.paypal.com/%s/i/bnr/%s_solution_PP%s.gif',
            $this->_getSupportedLocaleCode($localeCode),
            $isVertical ? 'vertical' : 'horizontal', $isEcheck ? 'eCheck' : ''
        );
    }

    /**
     * Getter for Payment form logo images
     *
     * @param string $localeCode
     */
    public function getPaymentFormLogoUrl($localeCode)
    {
        $locale = $this->_getSupportedLocaleCode($localeCode);

        $imageType = 'logo';
        $domain = 'paypal.com';
        list (,$country) = explode('_', $locale);
        $countryPrefix = $country . '/';

        switch ($locale) {
            case 'en_GB':
                $imageName = 'horizontal_solution_PP';
                $imageType = 'bnr';
                $countryPrefix = '';
                break;
            case 'de_DE':
                $imageName = 'lockbox_150x47';
                break;
            case 'fr_FR':
                $imageName = 'bnr_horizontal_solution_PP_327wx80h';
                $imageType = 'bnr';
                $locale = 'en_US';
                $domain = 'paypalobjects.com';
                break;
            case 'it_IT':
                $imageName = 'bnr_horizontal_solution_PP_178wx80h';
                $imageType = 'bnr';
                $domain = 'paypalobjects.com';
                break;
            default:
                $imageName='PayPal_mark_60x38';
                $countryPrefix = '';
                break;
        }
        return sprintf('https://www.%s/%s/%si/%s/%s.gif', $domain, $locale, $countryPrefix, $imageType, $imageName);
    }

    /**
     * Return supported types for PayPal logo
     *
     * @return array
     */
    public function getAdditionalOptionsLogoTypes()
    {
        return array(
            'wePrefer_150x60'       => Mage::helper('paypalmx')->__('We prefer PayPal (150 X 60)'),
            'wePrefer_150x40'       => Mage::helper('paypalmx')->__('We prefer PayPal (150 X 40)'),
            'nowAccepting_150x60'   => Mage::helper('paypalmx')->__('Now accepting PayPal (150 X 60)'),
            'nowAccepting_150x40'   => Mage::helper('paypalmx')->__('Now accepting PayPal (150 X 40)'),
            'paymentsBy_150x60'     => Mage::helper('paypalmx')->__('Payments by PayPal (150 X 60)'),
            'paymentsBy_150x40'     => Mage::helper('paypalmx')->__('Payments by PayPal (150 X 40)'),
            'shopNowUsing_150x60'   => Mage::helper('paypalmx')->__('Shop now using (150 X 60)'),
            'shopNowUsing_150x40'   => Mage::helper('paypalmx')->__('Shop now using (150 X 40)'),
        );
    }

    /**
     * Return PayPal logo URL with additional options
     *
     * @param string $localeCode Supported locale code
     * @param string $type One of supported logo types
     * @return string|bool Logo Image URL or false if logo disabled in configuration
     */
    public function getAdditionalOptionsLogoUrl($localeCode, $type = false)
    {
        $configType = Mage::getStoreConfig($this->_mapGenericStyleFieldset('logo'), $this->_storeId);
        if (!$configType) {
            return false;
        }
        $type = $type ? $type : $configType;
        $locale = $this->_getSupportedLocaleCode($localeCode);
        $supportedTypes = array_keys($this->getAdditionalOptionsLogoTypes());
        if (!in_array($type, $supportedTypes)) {
            $type = self::DEFAULT_LOGO_TYPE;
        }
        return sprintf('https://www.paypalobjects.com/%s/i/bnr/bnr_%s.gif', $locale, $type);
    }

    /**
     * BN code getter
     *
     * @param string $countryCode ISO 3166-1
     */
    public function getBuildNotationCode($countryCode = null)
    {
        $product = 'WPP';
        if ($this->_methodCode && isset($this->_buildNotationPPMap[$this->_methodCode])) {
            $product = $this->_buildNotationPPMap[$this->_methodCode];
        }
        if (null === $countryCode) {
            $countryCode = $this->_matchBnCountryCode($this->getMerchantCountry());
        }
        if ($countryCode) {
            $countryCode = '_' . $countryCode;
        }
        return sprintf('Varien_Cart_%s%s', $product, $countryCode);
    }

    /**
     * Express Checkout button "flavors" source getter
     *
     * @return array
     */
    public function getExpressCheckoutButtonFlavors()
    {
        return array(
            self::EC_FLAVOR_DYNAMIC => Mage::helper('paypalmx')->__('Dynamic'),
            self::EC_FLAVOR_STATIC  => Mage::helper('paypalmx')->__('Static'),
        );
    }

    /**
     * Express Checkout button types source getter
     *
     * @return array
     */
    public function getExpressCheckoutButtonTypes()
    {
        return array(
            self::EC_BUTTON_TYPE_SHORTCUT => Mage::helper('paypalmx')->__('Shortcut'),
            self::EC_BUTTON_TYPE_MARK     => Mage::helper('paypalmx')->__('Acceptance Mark Image'),
        );
    }

    /**
     * Payment actions source getter
     *
     * @return array
     */
    public function getPaymentActions()
    {
        $paymentActions = array(
            self::PAYMENT_ACTION_AUTH => Mage::helper('paypalmx')->__('Authorization'),
            self::PAYMENT_ACTION_SALE => Mage::helper('paypalmx')->__('Sale')
        );
        if (!is_null($this->_methodCode) && ($this->_methodCode == self::METHOD_PPMX ||$this->_methodCode == self::METHOD_PPMX_DEBITO ||$this->_methodCode == self::METHOD_PPMX_MENSUALIDADES)) {
            $paymentActions[self::PAYMENT_ACTION_ORDER] = Mage::helper('paypalmx')->__('Order');
        }
        return $paymentActions;
    }

    /**
     * Require Billing Address source getter
     *
     * @return array
     */
    public function getRequireBillingAddressOptions()
    {
        return array(
            self::REQUIRE_BILLING_ADDRESS_ALL       => Mage::helper('paypalmx')->__('Yes'),
            self::REQUIRE_BILLING_ADDRESS_NO        => Mage::helper('paypalmx')->__('No'),
            self::REQUIRE_BILLING_ADDRESS_VIRTUAL   => Mage::helper('paypalmx')->__('For Virtual Quotes Only'),
        );
    }

    /**
     * Mapper from PayPal-specific payment actions to Magento payment actions
     *
     * @return string|null
     */
    public function getPaymentAction()
    {
        switch ($this->paymentAction) {
            case self::PAYMENT_ACTION_AUTH:
                return Mage_Payment_Model_Method_Abstract::ACTION_AUTHORIZE;
            case self::PAYMENT_ACTION_SALE:
                return Mage_Payment_Model_Method_Abstract::ACTION_AUTHORIZE_CAPTURE;
            case self::PAYMENT_ACTION_ORDER:
                return Mage_Payment_Model_Method_Abstract::ACTION_ORDER;
        }
    }

    /**
     * Returns array of possible Authorization Amounts for Account Verification
     *
     * @deprecated since 1.6.2.0
     * @return array
     */
    public function getAuthorizationAmounts()
    {
        return array();
    }

    /**
     * Express Checkout "solution types" source getter
     * "sole" = "Express Checkout for Auctions" - PayPal allows guest checkout
     * "mark" = "Normal Express Checkout" - PayPal requires to checkout with PayPal buyer account only
     *
     * @return array
     */
    public function getExpressCheckoutSolutionTypes()
    {
        return array(
            self::EC_SOLUTION_TYPE_SOLE => Mage::helper('paypalmx')->__('Yes'),
            self::EC_SOLUTION_TYPE_MARK => Mage::helper('paypalmx')->__('No'),
        );
    }

    /**
     * Retrieve express checkout billing agreement signup options
     *
     * @return array
     */
    public function getExpressCheckoutBASignupOptions()
    {
        return array(
            self::EC_BA_SIGNUP_AUTO  => Mage::helper('paypalmx')->__('Auto'),
            self::EC_BA_SIGNUP_ASK   => Mage::helper('paypalmx')->__('Ask Customer'),
            self::EC_BA_SIGNUP_NEVER => Mage::helper('paypalmx')->__('Never')
        );
    }

    /**
     * Whether to ask customer to create billing agreements
     * Unilateral payments are incompatible with the billing agreements
     *
     * @return bool
     */
    public function shouldAskToCreateBillingAgreement()
    {
        return ($this->allow_ba_signup === self::EC_BA_SIGNUP_ASK) && !$this->shouldUseUnilateralPayments();
    }

    /**
     * Check whether only Unilateral payments (Accelerated Boarding) possible for Express method or not
     *
     * @return bool
     */
    public function shouldUseUnilateralPayments()
    {
        return $this->business_account && !$this->isWppApiAvailabe();
    }

    /**
     * Check whether WPP API credentials are available for this method
     *
     * @return bool
     */
    public function isWppApiAvailabe()
    {
        return $this->api_username && $this->api_password && ($this->api_signature || $this->api_cert);
    }

    /**
     * Payment data delivery methods getter for PayPal Standard
     *
     * @return array
     */
    public function getWpsPaymentDeliveryMethods()
    {
        return array(
            self::WPS_TRANSPORT_IPN      => Mage::helper('adminhtml')->__('IPN (Instant Payment Notification) Only'),
            // not supported yet:
//            self::WPS_TRANSPORT_PDT      => Mage::helper('adminhtml')->__('PDT (Payment Data Transfer) Only'),
//            self::WPS_TRANSPORT_IPN_PDT  => Mage::helper('adminhtml')->__('Both IPN and PDT'),
        );
    }

    /**
     * Return list of supported credit card types by Paypal Direct gateway
     *
     * @return array
     */
    public function getWppCcTypesAsOptionArray()
    {
        $model = Mage::getModel('payment/source_cctype')->setAllowedTypes(array('AE', 'VI', 'MC', 'SM', 'SO', 'DI'));
        return $model->toOptionArray();
    }

    /**
     * Return list of supported credit card types by Paypal Direct (Payflow Edition) gateway
     *
     * @return array
     */
    public function getWppPeCcTypesAsOptionArray()
    {
        $model = Mage::getModel('payment/source_cctype')->setAllowedTypes(array('VI', 'MC', 'SM', 'SO', 'OT', 'AE'));
        return $model->toOptionArray();
    }

    /**
     * Return list of supported credit card types by Payflow Pro gateway
     *
     * @return array
     */
    public function getPayflowproCcTypesAsOptionArray()
    {
        $model = Mage::getModel('payment/source_cctype')->setAllowedTypes(array('AE', 'VI', 'MC', 'JCB', 'DI'));
        return $model->toOptionArray();
    }

    /**
     * Check whether the specified payment method is a CC-based one
     *
     * @param string $code
     * @return bool
     */
    public static function getIsCreditCardMethod($code)
    {
        switch ($code) {
            case self::METHOD_WPP_DIRECT:
            case self::METHOD_WPP_PE_DIRECT:
            case self::METHOD_PAYFLOWPRO:
            case self::METHOD_PAYFLOWLINK:
            case self::METHOD_PAYFLOWADVANCED:
            case self::METHOD_HOSTEDPRO:
                return true;
        }
        return false;
    }

    /**
     * Check whether specified currency code is supported
     *
     * @param string $code
     * @return bool
     */
    public function isCurrencyCodeSupported($code)
    {
        if (in_array($code, $this->_supportedCurrencyCodes)) {
            return true;
        }
        if ($this->getMerchantCountry() == 'BR' && $code == 'BRL') {
            return true;
        }
        if ($this->getMerchantCountry() == 'MY' && $code == 'MYR') {
            return true;
        }
        return false;
    }

    /**
     * Export page style current settings to specified object
     *
     * @param Varien_Object $to
     */
    public function exportExpressCheckoutStyleSettings(Varien_Object $to)
    {
        foreach ($this->_ecStyleConfigMap as $key => $exportKey) {
            if ($this->$key) {
                $to->setData($exportKey, $this->$key);
            }
        }
    }

    /**
     * Dynamic PayPal image URL getter
     * Also can render dynamic Acceptance Mark
     *
     * @param string $type
     * @param string $localeCode
     * @param float $orderTotal
     * @param string $pal
     */
    protected function _getDynamicImageUrl($type, $localeCode, $orderTotal, $pal)
    {
        $params = array(
            'cmd'        => '_dynamic-image',
            'buttontype' => $type,
            'locale'     => $this->_getSupportedLocaleCode($localeCode),
        );
        if ($orderTotal) {
            $params['ordertotal'] = sprintf('%.2F', $orderTotal);
            if ($pal) {
                $params['pal'] = $pal;
            }
        }
        return sprintf('https://fpdbs%s.paypal.com/dynamicimageweb?%s',
            $this->sandboxFlag ? '.sandbox' : '', http_build_query($params)
        );
    }

    /**
     * Check whether specified locale code is supported. Fallback to en_US
     *
     * @param string $localeCode
     * @return string
     */
    protected function _getSupportedLocaleCode($localeCode = null)
    {
        if (!$localeCode || !in_array($localeCode, $this->_supportedImageLocales)) {
            return 'es_ES';
        }
        return $localeCode;
    }
	
    /**
     * Map any supported payment method into a config path by specified field name
     *
     * @param string $fieldName
     * @return string|null
     */
    protected function _getSpecificConfigPath($fieldName)
    {
        $path = null;
        switch ($this->_methodCode) {
        	case self::METHOD_PPMX_DEBITO:
        	case self::METHOD_PPMX_MENSUALIDADES:
            case self::METHOD_PPMX:
                $path = $this->_mapExpressFieldset($fieldName);
                break;
            case self::METHOD_WPP_EXPRESS:
            case self::METHOD_WPP_PE_EXPRESS:
                $path = $this->_mapExpressFieldset($fieldName);
                break;
            case self::METHOD_WPP_DIRECT:
            case self::METHOD_WPP_PE_DIRECT:
                $path = $this->_mapDirectFieldset($fieldName);
                break;
            case self::METHOD_BILLING_AGREEMENT:
            case self::METHOD_HOSTEDPRO:
                $path = $this->_mapMethodFieldset($fieldName);
                break;
        }

        if ($path === null) {
            switch ($this->_methodCode) {
                case self::METHOD_WPP_EXPRESS:
                case self::METHOD_WPP_DIRECT:
                case self::METHOD_BILLING_AGREEMENT:
                case self::METHOD_HOSTEDPRO:
                case self::METHOD_PPMX_DEBITO:
                case self::METHOD_PPMX_MENSUALIDADES:
                case self::METHOD_PPMX:
                    $path = $this->_mapWppFieldset($fieldName);
                    break;
                case self::METHOD_WPP_PE_EXPRESS:
                case self::METHOD_WPP_PE_DIRECT:
                    $path = $this->_mapWpukFieldset($fieldName);
                    break;
            }
        }

        if ($path === null) {
            $path = $this->_mapGeneralFieldset($fieldName);
        }
        if ($path === null) {
            $path = $this->_mapGenericStyleFieldset($fieldName);
        }
        return $path;
    }

    /**
     * Check wheter specified country code is supported by build notation codes for specific countries
     *
     * @param $code
     * @return string|null
     */
    private function _matchBnCountryCode($code)
    {
        switch ($code) {
            // GB == UK
            case 'GB':
                return 'UK';
            // Australia, Austria, Belgium, Canada, China, France, Germany, Hong Kong, Italy
            case 'AU': case 'AT': case 'BE': case 'CA': case 'CN': case 'FR': case 'DE': case 'HK': case 'IT':
            // Japan, Mexico, Netherlands, Poland, Singapore, Spain, Switzerland, United Kingdom, United States
            case 'JP': case 'MX': case 'NL': case 'PL': case 'SG': case 'ES': case 'CH': case 'UK': case 'US':
                return $code;
        }
    }

    /**
     * Map PayPal Standard config fields
     *
     * @param string $fieldName
     * @return string|null
     */
    protected function _mapStandardFieldset($fieldName)
    {
        switch ($fieldName)
        {
            case 'line_items_summary':
            case 'sandbox_flag':
                return 'payment/' . self::METHOD_PPMX . "/{$fieldName}";
            default:
                return $this->_mapMethodFieldset($fieldName);
        }
    }

    /**
     * Map PayPal Express config fields
     *
     * @param string $fieldName
     * @return string|null
     */
    protected function _mapExpressFieldset($fieldName)
    {
        switch ($fieldName)
        {
        	
            case 'transfer_shipping_options':
            case 'solution_type':
            case 'visible_on_shipping':
            case 'mensualidades':
            case 'require_billing_address':
            case 'authorization_honor_period':
            case 'order_valid_period':
            case 'child_authorization_number':
            case 'allow_ba_signup':
                return "payment/{$this->_methodCode}/{$fieldName}";
            default:
                return $this->_mapMethodFieldset($fieldName);
        }
    }

    function getIsMensualidadesActive(){
    	return Mage::getStoreConfig($this->_getSpecificConfigPath('mensualidades'));
    }	
    function getnoposah(){
		return $this->__get('method_type');
	}
    /**
     * Map PayPal Direct config fields
     *
     * @param string $fieldName
     * @return string|null
     */
    protected function _mapDirectFieldset($fieldName)
    {
        switch ($fieldName)
        {
            case 'useccv':
            case 'centinel':
            case 'centinel_is_mode_strict':
            case 'centinel_api_url':
                return "payment/{$this->_methodCode}/{$fieldName}";
            default:
                return $this->_mapMethodFieldset($fieldName);
        }
    }

    /**
     * Map PayPal Website Payments Pro common config fields
     *
     * @param string $fieldName
     * @return string|null
     */
    protected function _mapWppFieldset($fieldName)
    {
        switch ($fieldName)
        {
            case 'api_authentication':
            case 'api_username':
            case 'api_password':
            case 'api_signature':
            case 'api_cert':
            case 'sandbox_flag':
            case 'use_proxy':
            case 'proxy_host':
            case 'proxy_port':
            case 'button_flavor':
                return "paypalmx/ppmx/{$fieldName}";
            default:
                return null;
        }
    }

    /**
     * Map PayPal Website Payments Pro common config fields
     *
     * @param string $fieldName
     * @return string|null
     */
    protected function _mapWpukFieldset($fieldName)
    {
        $pathPrefix = 'paypalmx/wpuk';
        // Use PUMP credentials from Verisign for EC when Direct Payments are unavailable
        if ($this->_methodCode == self::METHOD_WPP_PE_EXPRESS
            && !$this->isMethodAvailable(self::METHOD_WPP_PE_DIRECT)) {
            $pathPrefix = 'payment/verisign';
        }
        switch ($fieldName) {
            case 'partner':
            case 'user':
            case 'vendor':
            case 'pwd':
            case 'sandbox_flag':
            case 'use_proxy':
            case 'proxy_host':
            case 'proxy_port':
                return $pathPrefix . '/' . $fieldName;
            default:
                return null;
        }
    }

    /**
     * Map PayPal common style config fields
     *
     * @param string $fieldName
     * @return string|null
     */
    protected function _mapGenericStyleFieldset($fieldName)
    {
        switch ($fieldName) {
            case 'logo':
            case 'page_style':
            case 'paypal_hdrimg':
            case 'paypal_hdrbackcolor':
            case 'paypal_hdrbordercolor':
            case 'paypal_payflowcolor':
                return "paypalmx/style/{$fieldName}";
            default:
                return null;
        }
    }

    /**
     * Map PayPal General Settings
     *
     * @param string $fieldName
     * @return string|null
     */
    protected function _mapGeneralFieldset($fieldName)
    {
        switch ($fieldName)
        {
            case 'business_account':
            case 'merchant_country':
                return "paypalmx/general/{$fieldName}";
            default:
                return null;
        }
    }

    /**
     * Map PayPal General Settings
     *
     * @param string $fieldName
     * @return string|null
     */
    protected function _mapMethodFieldset($fieldName)
    {
    
        if (!$this->_methodCode) {
            return null;
        }
        switch ($fieldName)
        {
        	case 'sort_order':
            case 'active':
            case 'title':
            case 'payment_action':
            case 'allowspecific':
            case 'specificcountry':
            case 'line_items_enabled':
            case 'cctypes':
            case 'debug':
            case 'method_type':
            case 'verify_peer':
                return "payment/{$this->_methodCode}/{$fieldName}";
            default:
                return null;
        }
    }

    /**
     * Payment API authentication methods source getter
     *
     * @return array
     */
    public function getApiAuthenticationMethods()
    {
        return array(
            '0' => Mage::helper('paypalmx')->__('API Signature'),
            '1' => Mage::helper('paypalmx')->__('API Certificate')
        );
    }

    /**
     * Api certificate getter
     *
     * @return string
     */
    public function getApiCertificate()
    {
        $websiteId = Mage::app()->getStore($this->_storeId)->getWebsiteId();
        return Mage::getModel('paypalmx/cert')->loadByWebsite($websiteId, false)->getCertPath();
    }
}

