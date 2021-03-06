<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: spotify/login5/v3/credentials/credentials.proto

namespace Spotify\Login5\V3\Credentials;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>spotify.login5.v3.credentials.AppleSignInCredential</code>
 */
class AppleSignInCredential extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string auth_code = 1;</code>
     */
    protected $auth_code = '';
    /**
     * Generated from protobuf field <code>string redirect_uri = 2;</code>
     */
    protected $redirect_uri = '';
    /**
     * Generated from protobuf field <code>string bundle_id = 3;</code>
     */
    protected $bundle_id = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $auth_code
     *     @type string $redirect_uri
     *     @type string $bundle_id
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Spotify\Login5\V3\Credentials\Credentials::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string auth_code = 1;</code>
     * @return string
     */
    public function getAuthCode()
    {
        return $this->auth_code;
    }

    /**
     * Generated from protobuf field <code>string auth_code = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setAuthCode($var)
    {
        GPBUtil::checkString($var, True);
        $this->auth_code = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string redirect_uri = 2;</code>
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->redirect_uri;
    }

    /**
     * Generated from protobuf field <code>string redirect_uri = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setRedirectUri($var)
    {
        GPBUtil::checkString($var, True);
        $this->redirect_uri = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string bundle_id = 3;</code>
     * @return string
     */
    public function getBundleId()
    {
        return $this->bundle_id;
    }

    /**
     * Generated from protobuf field <code>string bundle_id = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setBundleId($var)
    {
        GPBUtil::checkString($var, True);
        $this->bundle_id = $var;

        return $this;
    }

}

