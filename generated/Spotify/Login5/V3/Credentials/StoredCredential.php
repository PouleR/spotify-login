<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: spotify/login5/v3/credentials/credentials.proto

namespace Spotify\Login5\V3\Credentials;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>spotify.login5.v3.credentials.StoredCredential</code>
 */
class StoredCredential extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string username = 1;</code>
     */
    protected $username = '';
    /**
     * Generated from protobuf field <code>bytes data = 2;</code>
     */
    protected $data = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $username
     *     @type string $data
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Spotify\Login5\V3\Credentials\Credentials::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string username = 1;</code>
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Generated from protobuf field <code>string username = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setUsername($var)
    {
        GPBUtil::checkString($var, True);
        $this->username = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bytes data = 2;</code>
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Generated from protobuf field <code>bytes data = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setData($var)
    {
        GPBUtil::checkString($var, False);
        $this->data = $var;

        return $this;
    }

}

