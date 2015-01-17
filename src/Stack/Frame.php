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
 * A stack frame.
 *
 * @since 1.0
 */
class Frame
{
    /**
     * @var string The path to the file the frame references.
     */
    private $path;

    /**
     * @var int The line number the frame references.
     */
    private $line;

    /**
     * @var string The function the frame references.
     */
    private $function;

    /**
     * @var array Any arguments for the function the frame references.
     */
    private $arguments = array();

    /**
     * @param string $path The path to the file the frame references.
     * @param int $line The line number the frame references.
     * @param string $function The function the frame references.
     * @param array $arguments Any arguments for the function the frame references.
     */
    function __construct($path, $line, $function, array $arguments)
    {
        $this->path = $path;
        $this->line = $line;
        $this->function = $function;
        $this->arguments = $arguments;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @return string
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * @return int
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

}
