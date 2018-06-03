<?php
namespace App\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Database\Migrations\CreateMigration;

class GenerateMigrationCommand extends Command
{
    private $migration;


    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('migration')
    
            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a table migrations.')
    
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a migrations...')
        ;
    }

    public function __construct()
    {
        $this->migration = new CreateMigration;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->migration->run();

        $output->writeln('Migration was successfully created!');
    }
}