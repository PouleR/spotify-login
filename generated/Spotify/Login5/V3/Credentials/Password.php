<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: spotify/login5/v3/credentials/credentials.proto

namespace Spotify\Login5\V3\Credentials;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>spotify.login5.v3.credentials.Password</code>
 */
class Password extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string id = 1;</code>
     */
    protected $id = '';
    /**
     * Generated from protobuf field <code>string password = 2;</code>
     */
    protected $password = '';
    /**
     * Generated from protobuf field <code>bytes padding = 3;</code>
     */
    protected $padding = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $id
     *     @type string $password
     *     @type string $padding
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Spotify\Login5\V3\Credentials\Credentials::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string id = 1;</code>
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Generated from protobuf field <code>string id = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkString($var, True);
        $this->id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string password = 2;</code>
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Generated from protobuf field <code>string password = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setPassword($var)
    {
        GPBUtil::checkString($var, True);
        $this->password = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bytes padding = 3;</code>
     * @return string
     */
    public function getPadding()
    {
        return $this->padding;
    }

    /**
     * Generated from protobuf field <code>bytes padding = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setPadding($var)
    {
        GPBUtil::checkString($var, False);
        $this->padding = $var;

        return $this;
    }

}

