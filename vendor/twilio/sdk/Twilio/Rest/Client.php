<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest;

use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Client as HttpClient;
use Twilio\Http\CurlClient;
use Twilio\VersionInfo;

/**
 * A client for accessing the Twilio API.
 * 
 * @property \Twilio\Rest\Api api
 * @property \Twilio\Rest\IpMessaging ipMessaging
 * @property \Twilio\Rest\Lookups lookups
 * @property \Twilio\Rest\Monitor monitor
 * @property \Twilio\Rest\Notifications notifications
 * @property \Twilio\Rest\Preview preview
 * @property \Twilio\Rest\Pricing pricing
 * @property \Twilio\Rest\Taskrouter taskrouter
 * @property \Twilio\Rest\Trunking trunking
 * @property \Twilio\Rest\Api\V2010\Account\AddressList addresses
 * @property \Twilio\Rest\Api\V2010\Account\ApplicationList applications
 * @property \Twilio\Rest\Api\V2010\Account\AuthorizedConnectAppList authorizedConnectApps
 * @property \Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountryList availablePhoneNumbers
 * @property \Twilio\Rest\Api\V2010\Account\CallList calls
 * @property \Twilio\Rest\Api\V2010\Account\ConferenceList conferences
 * @property \Twilio\Rest\Api\V2010\Account\ConnectAppList connectApps
 * @property \Twilio\Rest\Api\V2010\Account\IncomingPhoneNumberList incomingPhoneNumbers
 * @property \Twilio\Rest\Api\V2010\Account\MessageList messages
 * @property \Twilio\Rest\Api\V2010\Account\OutgoingCallerIdList outgoingCallerIds
 * @property \Twilio\Rest\Api\V2010\Account\QueueList queues
 * @property \Twilio\Rest\Api\V2010\Account\RecordingList recordings
 * @property \Twilio\Rest\Api\V2010\Account\SandboxList sandbox
 * @property \Twilio\Rest\Api\V2010\Account\SipList sip
 * @property \Twilio\Rest\Api\V2010\Account\SmsList sms
 * @property \Twilio\Rest\Api\V2010\Account\TokenList tokens
 * @property \Twilio\Rest\Api\V2010\Account\TranscriptionList transcriptions
 * @property \Twilio\Rest\Api\V2010\Account\UsageList usage
 * @property \Twilio\Rest\Api\V2010\Account\ValidationRequestList validationRequests
 * @method \Twilio\Rest\Api\V2010\Account\AddressContext addresses(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\ApplicationContext applications(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\AuthorizedConnectAppContext authorizedConnectApps(string $connectAppSid)
 * @method \Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountryContext availablePhoneNumbers(string $countryCode)
 * @method \Twilio\Rest\Api\V2010\Account\CallContext calls(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\ConferenceContext conferences(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\ConnectAppContext connectApps(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\IncomingPhoneNumberContext incomingPhoneNumbers(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\MessageContext messages(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\OutgoingCallerIdContext outgoingCallerIds(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\QueueContext queues(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\RecordingContext recordings(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\SandboxContext sandbox()
 * @method \Twilio\Rest\Api\V2010\Account\TranscriptionContext transcriptions(string $sid)
 */
class Client {
    const ENV_ACCOUNT_SID = "TWILIO_ACCOUNT_SID";
    const ENV_AUTH_TOKEN = "TWILIO_AUTH_TOKEN";

    protected $username;
    protected $password;
    protected $accountSid;
    protected $httpClient;
    protected $_account;
    protected $_api = null;
    protected $_ipMessaging = null;
    protected $_lookups = null;
    protected $_monitor = null;
    protected $_notifications = null;
    protected $_preview = null;
    protected $_pricing = null;
    protected $_taskrouter = null;
    protected $_trunking = null;
    protected $_accounts = null;
    protected $_addresses = null;
    protected $_applications = null;
    protected $_authorizedConnectApps = null;
    protected $_availablePhoneNumbers = null;
    protected $_calls = null;
    protected $_conferences = null;
    protected $_connectApps = null;
    protected $_incomingPhoneNumbers = null;
    protected $_messages = null;
    protected $_outgoingCallerIds = null;
    protected $_queues = null;
    protected $_recordings = null;
    protected $_sandbox = null;
    protected $_sip = null;
    protected $_sms = null;
    protected $_tokens = null;
    protected $_transcriptions = null;
    protected $_usage = null;
    protected $_validationRequests = null;

    /**
     * Initializes the Twilio Client
     * 
     * @param string $username Username to authenticate with
     * @param string $password Password to authenticate with
     * @param string $accountSid Account Sid to authenticate with, defaults to
     *                           $username
     * @param \Twilio\Http\Client $httpClient HttpClient, defaults to CurlClient
     * @param mixed[] $environment Environment to look for auth details, defaults
     *                             to $_ENV
     * @return \Twilio\Rest\Client Twilio Client
     * @throws ConfigurationException If valid authentication is not present
     */
    public function __construct($username = null, $password = null, $accountSid = null, HttpClient $httpClient = null, $environment = null) {
        if (!$environment) {
            $environment = $_ENV;
        }
        
        if ($username) {
            $this->username = $username;
        } else {
            if (array_key_exists(self::ENV_ACCOUNT_SID, $environment)) {
                $this->username = $environment[self::ENV_ACCOUNT_SID];
            }
        }
        
        if ($password) {
            $this->password = $password;
        } else {
            if (array_key_exists(self::ENV_AUTH_TOKEN, $environment)) {
                $this->password = $environment[self::ENV_AUTH_TOKEN];
            }
        }
        
        if (!$this->username || !$this->password) {
            throw new ConfigurationException("Credentials are required to create a Client");
        }
        
        $this->accountSid = $accountSid ?: $this->username;
        
        if ($httpClient) {
            $this->httpClient = $httpClient;
        } else {
            $this->httpClient = new CurlClient();
        }
    }

    /**
     * Makes a request to the Twilio API using the configured http client
     * Authentication information is automatically added if none is provided
     * 
     * @param string $method HTTP Method
     * @param string $uri Fully qualified url
     * @param string[] $params Query string parameters
     * @param string[] $data POST body data
     * @param string[] $headers HTTP Headers
     * @param string $username User for Authentication
     * @param string $password Password for Authentication
     * @param int $timeout Timeout in seconds
     * @return \Twilio\Http\Response Response from the Twilio API
     */
    public function request($method, $uri, $params = array(), $data = array(), $headers = array(), $username = null, $password = null, $timeout = null) {
        $username = $username ? $username : $this->username;
        $password = $password ? $password : $this->password;
        
        $headers['User-Agent'] = 'twilio-php/' . VersionInfo::string() .
                                 ' (PHP ' . phpversion() . ')';
        $headers['Accept-Charset'] = 'utf-8';
        
        if ($method == 'POST' && !array_key_exists('Content-Type', $headers)) {
            $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        }
        
        if (!array_key_exists('Accept', $headers)) {
            $headers['Accept'] = 'application/json';
        }
        
        return $this->getHttpClient()->request(
            $method,
            $uri,
            $params,
            $data,
            $headers,
            $username,
            $password,
            $timeout
        );
    }

    /**
     * Retrieve the AccountSid
     * 
     * @return string Current AccountSid
     */
    public function getAccountSid() {
        return $this->accountSid;
    }

    /**
     * Retrieve the HttpClient
     * 
     * @return \Twilio\Http\Client Current HttpClient
     */
    public function getHttpClient() {
        return $this->httpClient;
    }

    /**
     * Set the HttpClient
     * 
     * @param \Twilio\Http\Client $httpClient HttpClient to use
     */
    public function setHttpClient(HttpClient $httpClient) {
        $this->httpClient = $httpClient;
    }

    /**
     * Access the Api Twilio Domain
     * 
     * @return \Twilio\Rest\Api Api Twilio Domain
     */
    protected function getApi() {
        if (!$this->_api) {
            $this->_api = new Api($this);
        }
        return $this->_api;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\AccountContext Account provided as the
     *                                               authenticating account
     */
    public function getAccount() {
        return $this->api->v2010->account;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\AccountList 
     */
    public function getAccounts() {
        return $this->api->v2010->accounts;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\AddressList 
     */
    public function getAddresses() {
        return $this->api->v2010->account->addresses;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\ApplicationList 
     */
    public function getApplications() {
        return $this->api->v2010->account->applications;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\AuthorizedConnectAppList 
     */
    public function getAuthorizedConnectApps() {
        return $this->api->v2010->account->authorizedConnectApps;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountryList 
     */
    public function getAvailablePhoneNumbers() {
        return $this->api->v2010->account->availablePhoneNumbers;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\CallList 
     */
    public function getCalls() {
        return $this->api->v2010->account->calls;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\ConferenceList 
     */
    public function getConferences() {
        return $this->api->v2010->account->conferences;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\ConnectAppList 
     */
    public function getConnectApps() {
        return $this->api->v2010->account->connectApps;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\IncomingPhoneNumberList 
     */
    public function getIncomingPhoneNumbers() {
        return $this->api->v2010->account->incomingPhoneNumbers;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\MessageList 
     */
    public function getMessages() {
        return $this->api->v2010->account->messages;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\OutgoingCallerIdList 
     */
    public function getOutgoingCallerIds() {
        return $this->api->v2010->account->outgoingCallerIds;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\QueueList 
     */
    public function getQueues() {
        return $this->api->v2010->account->queues;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\RecordingList 
     */
    public function getRecordings() {
        return $this->api->v2010->account->recordings;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\SandboxList 
     */
    public function getSandbox() {
        return $this->api->v2010->account->sandbox;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\SipList 
     */
    public function getSip() {
        return $this->api->v2010->account->sip;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\SmsList 
     */
    public function getSms() {
        return $this->api->v2010->account->sms;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\TokenList 
     */
    public function getTokens() {
        return $this->api->v2010->account->tokens;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\TranscriptionList 
     */
    public function getTranscriptions() {
        return $this->api->v2010->account->transcriptions;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\UsageList 
     */
    public function getUsage() {
        return $this->api->v2010->account->usage;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\ValidationRequestList 
     */
    public function getValidationRequests() {
        return $this->api->v2010->account->validationRequests;
    }

    /**
     * Access the IpMessaging Twilio Domain
     * 
     * @return \Twilio\Rest\IpMessaging IpMessaging Twilio Domain
     */
    protected function getIpMessaging() {
        if (!$this->_ipMessaging) {
            $this->_ipMessaging = new IpMessaging($this);
        }
        return $this->_ipMessaging;
    }

    /**
     * Access the Lookups Twilio Domain
     * 
     * @return \Twilio\Rest\Lookups Lookups Twilio Domain
     */
    protected function getLookups() {
        if (!$this->_lookups) {
            $this->_lookups = new Lookups($this);
        }
        return $this->_lookups;
    }

    /**
     * Access the Monitor Twilio Domain
     * 
     * @return \Twilio\Rest\Monitor Monitor Twilio Domain
     */
    protected function getMonitor() {
        if (!$this->_monitor) {
            $this->_monitor = new Monitor($this);
        }
        return $this->_monitor;
    }

    /**
     * Access the Notifications Twilio Domain
     * 
     * @return \Twilio\Rest\Notifications Notifications Twilio Domain
     */
    protected function getNotifications() {
        if (!$this->_notifications) {
            $this->_notifications = new Notifications($this);
        }
        return $this->_notifications;
    }

    /**
     * Access the Preview Twilio Domain
     * 
     * @return \Twilio\Rest\Preview Preview Twilio Domain
     */
    protected function getPreview() {
        if (!$this->_preview) {
            $this->_preview = new Preview($this);
        }
        return $this->_preview;
    }

    /**
     * Access the Pricing Twilio Domain
     * 
     * @return \Twilio\Rest\Pricing Pricing Twilio Domain
     */
    protected function getPricing() {
        if (!$this->_pricing) {
            $this->_pricing = new Pricing($this);
        }
        return $this->_pricing;
    }

    /**
     * Access the Taskrouter Twilio Domain
     * 
     * @return \Twilio\Rest\Taskrouter Taskrouter Twilio Domain
     */
    protected function getTaskrouter() {
        if (!$this->_taskrouter) {
            $this->_taskrouter = new Taskrouter($this);
        }
        return $this->_taskrouter;
    }

    /**
     * Access the Trunking Twilio Domain
     * 
     * @return \Twilio\Rest\Trunking Trunking Twilio Domain
     */
    protected function getTrunking() {
        if (!$this->_trunking) {
            $this->_trunking = new Trunking($this);
        }
        return $this->_trunking;
    }

    /**
     * Magic getter to lazy load domains
     * 
     * @param string $name Domain to return
     * @return \Twilio\Domain The requested domain
     * @throws TwilioException For unknown domains
     */
    public function __get($name) {
        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }
        
        throw new TwilioException('Unknown domain ' . $name);
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Client ' . $this->getAccountSid() . ']';
    }
}