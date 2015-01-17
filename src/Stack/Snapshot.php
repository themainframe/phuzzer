<?php
/**
 * phuzzer
 * Experimental code-path analyser/fuzzer for PHP.
 *
 * @package phuzzer
 * @author Damien Walsh <me@damow.net>
 */

namespace Phuzzer\Stack;

/**
 * A snapshot of the state of the stack.
 *
 * @since 1.0
 */
class Snapshot
{
    /**
     * @var Frame[]
     */
    private $frames = array();

    /**
     * @param Frame $frame
     */
    public function addFrame(Frame $frame)
    {
        $this->frames[] = $frame;
    }

    /**
     * @return Frame[]
     */
    public function getFrames()
    {
        return $this->frames;
    }
}
