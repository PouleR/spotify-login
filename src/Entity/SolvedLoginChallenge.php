<?php declare(strict_types=1);

namespace PouleR\SpotifyLogin\Entity;

/**
 * Class SolvedLoginChallenge
 */
class SolvedLoginChallenge
{
    private int $duration;

    /**
     * @param array $suffix
     * @param int   $iterations
     */
    public function __construct(private readonly array $suffix, private readonly int $iterations)
    {
    }

    /**
     * @return array
     */
    public function getSuffix(): array
    {
        return $this->suffix;
    }

    /**
     * @return int
     */
    public function getIterations(): int
    {
        return $this->iterations;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * Duration of the calculation in nanoseconds
     *
     * @param int $duration
     */
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }
}
