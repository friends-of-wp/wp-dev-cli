# `plugin:boilerplate:create`

## Usage

The usage of the boilerplate creation command is very easy. As the only parameter the plugin output directory is needed. All other configuration is done via the creation process starting afterwards.

```shell
php bin/fowp.php plugin:boilerplate:create /path/to/plugin/plugin-name
```

## How to create individual steps

It is possible to add individual steps to the boilerplate creation process. This is done via the config yaml file that can be handed over via the CLI parameter `-c`.

````shell
php bin/fowp.php plugin:boilerplate:create /path/to/plugin/plugin-name -c my-default-config.yml
````

The config file should have all the steps in there. All those steps will be processes in the order in that list. 

```yaml
steps:
  - \FriendsOfWp\DeveloperCli\Boilerplate\Step\InitializeStep
  - \FriendsOfWp\DeveloperCli\Boilerplate\Step\CopyTemplatesStep
  - \FriendsOfWp\DeveloperCli\Boilerplate\Step\ReplacingPlaceholdersStep
  - \FriendsOfWp\DeveloperCli\Boilerplate\Step\RenameMasterFileStep
  - \FriendsOfWp\DeveloperCli\Boilerplate\Step\RenamePluginDirStep

```
