<?php

namespace spec\Ftrrtf;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SolomonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Ftrrtf\Solomon');
    }

    function it_is_ready_to_fight()
    {
        $demons = [];

        $this->fight($demons)->shouldBeString();
    }

    function it_should_pass_simple_fight()
    {
        $demons = [1, 0, 1];

        $this->fight($demons)->shouldReturn('*>*>*>*<<<*');
    }

    function it_is_demons_mutable()
    {
        $this->setDemons([1, 2, 3]);
        $this->getDemons()->shouldReturn([0, 0, 1, 2, 3]);
    }

    function it_should_be_check_alive_demons()
    {
        $this->setDemons([0, 1]);
        $this->shouldBeAliveDemons();

        $this->setDemons([0]);
        $this->shouldNotBeAliveDemons();
    }

    function it_is_movable_forward()
    {
        $this->moveForward();
        $this->getPosition()->shouldBe(1);
    }

    function it_throw_exception_for_impossible_move_back()
    {
        $this->shouldThrow('\LogicException')->duringMoveBack();
    }

    function it_is_movable_back()
    {
        $this->moveForward();
        $this->moveBack();
        $this->getPosition()->shouldBe(0);
    }

    function it_is_get_next_position()
    {
        $this->getNextPosition()->shouldBe(1);
    }

    function it_find_the_closest_demon_position()
    {
        $this->setDemons([0, 0, 1]);
        $this->findClosestDemonPosition()->shouldReturn(4);
    }

    function it_should_be_moved_to_position()
    {
        $this->getPosition()->shouldReturn(0);

        $this->moveTo(3);
        $this->getPosition()->shouldReturn(3);

//        $this->moveTo(1);
//        $this->getPosition()->shouldReturn(1);
    }

    function it_is_add_action_to_log()
    {
        $this->addAction('*');
        $this->getActions()->shouldReturn('*');
        $this->addAction('>');
        $this->getActions()->shouldReturn('*>');
    }

    function it_is_log_action_for_move_forward()
    {
        $this->moveForward();
        $this->getActions()->shouldReturn('*>');
    }

    function it_is_log_action_for_move_back()
    {
        $this->moveForward();
        $this->moveBack();
        $this->getActions()->shouldReturn('*><');
    }

    function it_is_log_action_when_build_block()
    {
        $this->buildBlock();
        $this->getActions()->shouldReturn('*');
    }

    function it_should_create_blocks_during_move_if_it_not_exist()
    {
        $this->moveForward();
        $this->getBlocks()->shouldReturn([1, 1]);
    }

    function it_should_create_block_in_front()
    {
        $this->buildBlock();
        $this->getBlocks()->shouldReturn([1, 1]);
    }

    function it_check_if_block_exist_in_front()
    {
        $this->shouldNotHaveBlockInFront();

        $this->buildBlock();
        $this->shouldHaveBlockInFront();
    }
}
