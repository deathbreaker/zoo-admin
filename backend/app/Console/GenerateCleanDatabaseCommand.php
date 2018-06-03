<?php
/**
 * Created by PhpStorm.
 * User: Derid
 * Date: 24.05.2018
 * Time: 13:28
 */

namespace App\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Database\Migrations\CreateAnimalsTable;
use Database\Migrations\CreateUsersTable;
use Illuminate\Database\Capsule\Manager as DB;

class GenerateCleanDatabaseCommand extends Command
{
    private $migration;


    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('db:clean')

            // the short description shown while running "php bin/console list"
            ->setDescription('Clean database and delete all tables.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to clean database..')
        ;
    }

    public function __construct()
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $tables = DB::select("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name");


        DB::beginTransaction();

        foreach($tables as $table) {
            $table->name === "sqlite_sequence" ?  : DB::statement("DROP TABLE $table->name");
        }

        DB::commit();

        $output->writeln('Database was succcessfully cleaned!');
    }
}