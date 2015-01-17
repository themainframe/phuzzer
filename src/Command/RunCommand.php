<?php
/**
 * phuzzer
 * Experimental code-path analyser/fuzzer for PHP.
 *
 * @package phuzzer
 * @author Damien Walsh <me@damow.net>
 */

namespace Phuzzer\Command;

use Phuzzer\Stack\Watcher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command to phuzz PHP scripts.
 *
 * @package Phuzzer\Command
 */
class RunCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('phuzzer:run')
            ->setDescription('Phuzz a script from the command line.')
            ->addArgument(
                'path',
                InputArgument::REQUIRED,
                'The path to the PHP script file.'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Ensure ticks are enabled for phuzzer to work
        declare(ticks=1);
        $path = $input->getArgument('path');

        // Log to the console
        $output->writeln('<info>Running:</info> ' . $path . ' with phuzzer...');

        // Watch the inclusion of the file
        $watcher = new Watcher();
        $watcher->start();
        include $path;
        $watcher->stop();

        // Done
        $output->writeln('<info>Finished:</info> captured ' . count($watcher->getSnapshots()) . ' stack snapshots.');
    }
}
