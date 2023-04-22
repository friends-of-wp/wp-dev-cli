<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Steps;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;

class CopyTemplatesStep implements Step
{
    public function run(Configuration $configuration): string
    {
        return "Copying boilerplate templates to " . $configuration->getOutputDir();
    }
}
