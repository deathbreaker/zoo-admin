#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Console\GenerateMigrationCommand;
use App\Console\GenerateSeedsCommand;
use App\Console\GenerateCleanDatabaseCommand;

$application = new Application();

$application->add(new GenerateMigrationCommand());

$application->add(new GenerateSeedsCommand());

$application->add(new GenerateCleanDatabaseCommand());

$application->run();