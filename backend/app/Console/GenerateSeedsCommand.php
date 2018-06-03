<?php

namespace App\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Database\Seeds\RunSeeds;

class GenerateSeedsCommand extends Command
{
    private $seeds;


    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('seeds')

            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a table seeds.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to run a seeds..')
        ;
    }

    public function __construct()
    {
        $this->seeds = new RunSeeds();
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->seeds->run();

        $output->writeln('Seeds was successfully created!');
    }

}