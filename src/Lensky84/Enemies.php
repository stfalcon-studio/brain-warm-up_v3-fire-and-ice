<?php
namespace Lensky84;

/**
 * Class Enemies
 */
class Enemies
{
    /**
     * @var array $positions
     */
    protected $positions;

    /**
     * @var int $startPosition
     */
    protected $startPosition;

    /**
     * @var int $endPosition
     */
    protected $endPosition;

    /**
     * @var int $enemiesLeft
     */
    protected $enemiesLeft;

    /**
     * Constructor
     *
     * @param string $enemies
     */
    public function __construct($enemies)
    {
        $this->positions = $enemies;
        $this->updatePositions();
    }

    /**
     * Update enemies start and end positions
     */
    protected function updatePositions()
    {
        $this->startPosition = null;
        $this->endPosition = null;
        $this->enemiesLeft = 0;

        for ($i = 0; $i < count($this->positions); $i++) {
            if ($this->positions[$i] > 0) {
                if (is_null($this->startPosition)) {
                    $this->startPosition = $i;
                }
                $this->endPosition = $i;
                $this->enemiesLeft++;
            }
        }
    }

    /**
     * Has enemies
     *
     * @return bool
     */
    public function hasEnemies()
    {
        return $this->enemiesLeft > 0;
    }

    /**
     * Get start position of enemies
     *
     * @return int
     */
    public function getStartPosition()
    {
        return $this->startPosition;
    }

    /**
     * Get end position of enemies
     *
     * @return int
     */
    public function getEndPosition()
    {
        return $this->endPosition;
    }

    /**
     * Kill enemies
     *
     * @param int      $from
     * @param null|int $to
     */
    public function kill($from, $to = null)
    {
        if (is_null($to)) {
            $to = $from;
        }
        $to--;
        do {
            if ($this->positions[$from] > 0) {
                $this->positions[$from]--;
            }
            $from++;
        } while ($from <= $to);
        $this->updatePositions();
    }

    /**
     * Get enemies positions
     *
     * @return array
     */
    public function getPositions()
    {
        return $this->positions;
    }

    /**
     * Get position of stronger enemy
     *
     * @return int
     */
    public function getStrongerPosition()
    {
        $position = 0;
        $stronger = 0;
        for ($i = $this->endPosition; $i >= $this->startPosition; $i--) {
            if ($this->positions[$i] >= $stronger) {
                $stronger = $this->positions[$i];
                $position = $i;
            }
        }

        return $position;
    }
}