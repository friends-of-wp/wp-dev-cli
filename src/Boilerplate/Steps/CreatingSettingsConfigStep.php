<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Steps;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;

class CreatingSettingsConfigStep extends SimpleStep
{
    public function run(Configuration $configuration): string
    {
        return 'Creating "settings.yml" configuration file';
    }
}
