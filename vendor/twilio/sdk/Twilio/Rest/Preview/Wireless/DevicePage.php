<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\Wireless;

use Twilio\Page;

class DevicePage extends Page {
    public function __construct($version, $response, $solution) {
        parent::__construct($version, $response);
        
        // Path Solution
        $this->solution = $solution;
    }

    public function buildInstance(array $payload) {
        return new DeviceInstance(
            $this->version,
            $payload
        );
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Twilio.Preview.Wireless.DevicePage]';
    }
}