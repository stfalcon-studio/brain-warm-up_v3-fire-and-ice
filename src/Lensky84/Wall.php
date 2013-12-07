<?php
namespace Lensky84;

/**
 * Class Wall
 */
class Wall
{
    /**
     * @var array $wall
     */
    protected $wall = array();

    /**
     * Get wall
     *
     * @return array
     */
    public function getWall()
    {
        return $this->wall;
    }

    /**
     * Create ice block
     */
    public function createBlock()
    {
        $this->wall[] = 1;
    }

    /**
     * Destroy ice block
     *
     * @param int $pos
     *
     * @return array
     */
    public function destroyBlock($pos)
    {
        $to = count($this->wall) - 1;
        if ($pos == 0) {
            $this->wall = array();
        } else {
            $this->wall = array_slice($this->wall, 0, $pos);
        }

        return array($pos, $to);
    }

    /**
     * Is block
     *
     * @param int $pos
     *
     * @return bool
     */
    public function hasBlock($pos)
    {
        return isset($this->wall[$pos]);
    }
}