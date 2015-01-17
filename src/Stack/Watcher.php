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
 * Observes the stack at tick intervals to collect code-path data.
 *
 * @since 1.0
 */
class Watcher
{
    /**
     * @var Snapshot[]
     */
    private $snapshots = array();

    /**
     * Start observing the stack.
     */
    public function start()
    {
        register_tick_function(array(&$this, 'capture'));
    }

    /**
     * Stop observing the stack.
     */
    public function stop()
    {
        unregister_tick_function(array(&$this, 'capture'));
    }

    /**
     * Capture a stack snapshot.
     */
    public function capture()
    {
        // Capture the stack state
        $stackArray = debug_backtrace();

        // Build and save the snapshot
        $snapshot = new Snapshot();

        foreach ($stackArray as $frameArray) {

            $frame = new Frame(
                $frameArray['file'],
                $frameArray['line'],
                $frameArray['function'],
                $frameArray['args']
            );

            $snapshot->addFrame($frame);
        }

        // Store the snapshot
        $this->snapshots[] = $snapshot;
    }

    /**
     * @return Snapshot[]
     */
    public function getSnapshots()
    {
        return $this->snapshots;
    }
}
