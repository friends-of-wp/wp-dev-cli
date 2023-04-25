<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Yaml\Yaml;

const FOWP_DEV_CLI_VERSION = '##WPDEV_CLI_VERSION##';

$application = new Application();

$config = Yaml::parse(file_get_contents(__DIR__ . '/../config/config.yml'));

if (!array_key_exists('commands', $config)) {
    throw new \RuntimeException('No commands found.');
}

$application->setName('Friends of WP - Development CLI Helper');
$application->setVersion(FOWP_DEV_CLI_VERSION);

foreach ($config['commands'] as $command) {
    $application->add(new $command());
}

$application->run();
