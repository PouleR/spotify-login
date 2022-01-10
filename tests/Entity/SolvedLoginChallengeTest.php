<?php

namespace PouleR\SpotifyLogin\Tests;

use PHPUnit\Framework\TestCase;
use PouleR\SpotifyLogin\Entity\SolvedLoginChallenge;

/**
 * Class SolvedLoginChallengeTest
 */
class SolvedLoginChallengeTest extends TestCase
{
    /**
     *
     */
    public function testProperties(): void
    {
        $solvedChallenge = new SolvedLoginChallenge([1, 2], 5);
        $solvedChallenge->setDuration(100);

        self::assertEquals(5, $solvedChallenge->getIterations());
        self::assertEquals([1, 2], $solvedChallenge->getSuffix());
        self::assertEquals(100, $solvedChallenge->getDuration());
    }
}
