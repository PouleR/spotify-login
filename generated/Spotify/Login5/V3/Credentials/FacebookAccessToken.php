<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: spotify/login5/v3/credentials/credentials.proto

namespace Spotify\Login5\V3\Credentials;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>spotify.login5.v3.credentials.FacebookAccessToken</code>
 */
class FacebookAccessToken extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string fb_uid = 1;</code>
     */
    protected $fb_uid = '';
    /**
     * Generated from protobuf field <code>string access_token = 2;</code>
     */
    protected $access_token = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $fb_uid
     *     @type string $access_token
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Spotify\Login5\V3\Credentials\Credentials::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string fb_uid = 1;</code>
     * @return string
     */
    public function getFbUid()
    {
        return $this->fb_uid;
    }

    /**
     * Generated from protobuf field <code>string fb_uid = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setFbUid($var)
    {
        GPBUtil::checkString($var, True);
        $this->fb_uid = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string access_token = 2;</code>
     * @return string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * Generated from protobuf field <code>string access_token = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setAccessToken($var)
    {
        GPBUtil::checkString($var, True);
        $this->access_token = $var;

        return $this;
    }

}

