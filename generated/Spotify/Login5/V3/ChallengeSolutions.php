<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: spotify/login5/v3/login5.proto

namespace Spotify\Login5\V3;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>spotify.login5.v3.ChallengeSolutions</code>
 */
class ChallengeSolutions extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .spotify.login5.v3.ChallengeSolution solutions = 1;</code>
     */
    private $solutions;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Spotify\Login5\V3\ChallengeSolution[]|\Google\Protobuf\Internal\RepeatedField $solutions
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Spotify\Login5\V3\Login5::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>repeated .spotify.login5.v3.ChallengeSolution solutions = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getSolutions()
    {
        return $this->solutions;
    }

    /**
     * Generated from protobuf field <code>repeated .spotify.login5.v3.ChallengeSolution solutions = 1;</code>
     * @param \Spotify\Login5\V3\ChallengeSolution[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setSolutions($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Spotify\Login5\V3\ChallengeSolution::class);
        $this->solutions = $arr;

        return $this;
    }

}

