<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: spotify/login5/v3/login5.proto

namespace Spotify\Login5\V3;

use UnexpectedValueException;

/**
 * Protobuf type <code>spotify.login5.v3.LoginError</code>
 */
class LoginError
{
    /**
     * Generated from protobuf enum <code>UNKNOWN_ERROR = 0;</code>
     */
    const UNKNOWN_ERROR = 0;
    /**
     * Generated from protobuf enum <code>INVALID_CREDENTIALS = 1;</code>
     */
    const INVALID_CREDENTIALS = 1;
    /**
     * Generated from protobuf enum <code>BAD_REQUEST = 2;</code>
     */
    const BAD_REQUEST = 2;
    /**
     * Generated from protobuf enum <code>UNSUPPORTED_LOGIN_PROTOCOL = 3;</code>
     */
    const UNSUPPORTED_LOGIN_PROTOCOL = 3;
    /**
     * Generated from protobuf enum <code>TIMEOUT = 4;</code>
     */
    const TIMEOUT = 4;
    /**
     * Generated from protobuf enum <code>UNKNOWN_IDENTIFIER = 5;</code>
     */
    const UNKNOWN_IDENTIFIER = 5;
    /**
     * Generated from protobuf enum <code>TOO_MANY_ATTEMPTS = 6;</code>
     */
    const TOO_MANY_ATTEMPTS = 6;
    /**
     * Generated from protobuf enum <code>INVALID_PHONENUMBER = 7;</code>
     */
    const INVALID_PHONENUMBER = 7;
    /**
     * Generated from protobuf enum <code>TRY_AGAIN_LATER = 8;</code>
     */
    const TRY_AGAIN_LATER = 8;

    private static $valueToName = [
        self::UNKNOWN_ERROR => 'UNKNOWN_ERROR',
        self::INVALID_CREDENTIALS => 'INVALID_CREDENTIALS',
        self::BAD_REQUEST => 'BAD_REQUEST',
        self::UNSUPPORTED_LOGIN_PROTOCOL => 'UNSUPPORTED_LOGIN_PROTOCOL',
        self::TIMEOUT => 'TIMEOUT',
        self::UNKNOWN_IDENTIFIER => 'UNKNOWN_IDENTIFIER',
        self::TOO_MANY_ATTEMPTS => 'TOO_MANY_ATTEMPTS',
        self::INVALID_PHONENUMBER => 'INVALID_PHONENUMBER',
        self::TRY_AGAIN_LATER => 'TRY_AGAIN_LATER',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

