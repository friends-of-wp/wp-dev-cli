<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Steps;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;

class ReplacingPlaceholdersSteps implements Step
{
    private array $files = [
        'src/plugin-boilerplate.php',
        'readme.md'
    ];

    public function run(Configuration $configuration): string
    {
        return "Replacing all variables in the boilerplate directory";
    }
}
