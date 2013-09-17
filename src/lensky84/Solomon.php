<?php
namespace lensky84;

/**
 * Class Solomon
 */
class Solomon
{
    const FORWARD = 1;
    const BACK = -1;
    /**
     * @var Enemies $enemies
     */
    protected $enemies;

    /**
     * @var Wall $wall
     */
    protected $wall;

    /**
     * @var int $currentPos
     */
    protected $currentPos = 0;

    /**
     * Fight with demons
     *
     * @param array $demons
     *
     * @return bool|string
     */
    public function fight($demons)
    {
        $actions = false;
        $this->enemies = new Enemies($demons);
        $this->wall = new Wall();

        while ($this->enemies->hasEnemies()) {
            $startPos = $this->enemies->getStartPosition();
            $endPos = $this->enemies->getEndPosition();
            $strongerPos = $this->enemies->getStrongerPosition();
            for ($i = $this->currentPos + 1; $i <= $endPos + 1; $i++) {
                if (!$this->wall->hasBlock($i - 1)) {
                    $actions .= '*';
                    $this->spell($i);
                }
                $actions .= '>';
                $this->move(self::FORWARD);
            }
            if (!$this->wall->hasBlock($this->currentPos + 1)) {
                $actions .= '*';
                $this->spell($this->currentPos + 1);
            }
            for ($i = $this->currentPos; $i > $strongerPos; $i--) {
                $actions .= '<';
                $this->move(self::BACK);
            }
            $actions .= '*';
            $this->spell($this->currentPos + 1);
        }

        return $actions;
    }

    /**
     * Spell
     *
     * @param int $pos
     */
    protected function spell($pos)
    {
        if ($this->wall->hasBlock($pos - 1)) {
            $fallingPart = $this->wall->destroyBlock($pos - 1);
            $this->enemies->kill($fallingPart[0], $fallingPart[1]);
        } else {
            $this->wall->createBlock();
        }
    }

    /**
     * Move
     *
     * @param int $direction
     * @param int $steps
     */
    protected function move($direction, $steps = 1)
    {
        $this->currentPos += $direction * $steps;
    }
}
