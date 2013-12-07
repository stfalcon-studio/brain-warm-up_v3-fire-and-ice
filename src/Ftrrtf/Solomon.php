<?php

namespace Ftrrtf;

class Solomon
{

    private $position = 0;

    private $demons = [];
    private $blocks = [1];

    private $actions = '';

    public function fight($demons)
    {
        $this->setDemons($demons);

        while ($this->isAliveDemons()) {
            $this->moveTo($this->findClosestDemonPosition());
            $this->buildBlock();
            $this->moveBack();
            break;
        }

        return $this->getActions();
    }

    public function isAliveDemons()
    {
        return (bool) array_sum($this->getDemons());
    }

    public function setDemons($demons)
    {
        array_unshift($demons, 0);
        array_unshift($demons, 0);

        $this->demons = $demons;
    }

    public function getDemons()
    {
        return $this->demons;
    }

    public function moveForward()
    {
        if (!$this->hasBlockInFront()) {
            $this->buildBlock();
        }

        $this->position++;
        $this->addAction('>');
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function findClosestDemonPosition()
    {
        foreach ($this->getDemons() as $position => $demonPower) {
            if ($demonPower > 0) {
                return $position;
            }
        }
    }

    public function moveTo($position)
    {
        while ($position != $this->getPosition()) {
            if ($position > $this->getPosition()) {
                $this->moveForward();
            }

//            if ($position < $this->getPosition()) {
//                $this->moveB();
//            }
        }
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function addAction($action)
    {
        $this->actions .= $action;
    }

    public function getBlocks()
    {
        return $this->blocks;
    }

    public function buildBlock()
    {
        $this->blocks[$this->getNextPosition()] = 1;
        $this->addAction('*');
    }

    public function hasBlockInFront()
    {
        return isset($this->blocks[$this->getNextPosition()]);
    }

    /**
     * @return int
     */
    public function getNextPosition()
    {
        return $this->getPosition() + 1;
    }

    public function moveBack()
    {
        if ($this->getPosition() == 0) {
            throw new \LogicException;
        }

        $this->position--;
        $this->addAction('<');
    }
}
