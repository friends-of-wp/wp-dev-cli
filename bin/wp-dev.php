<?php

require __DIR__ . '/../vendor/autoload.php';

use FriendsOfWp\DeveloperCli\Command\Plugin\BoilerplateCreateCommand;
use FriendsOfWp\DeveloperCli\Command\WordPress\Directory\ExportCommand;
use Symfony\Component\Console\Application;

const FOWP_DEV_CLI_VERSION = '##WPDEV_CLI_VERSION##';

$application = new Application();

$application->setName('Friends of WP - Development CLI Helper');
$application->setVersion(FOWP_DEV_CLI_VERSION);

$application->add(new BoilerplateCreateCommand());
$application->add(new ExportCommand());

$application->run();
