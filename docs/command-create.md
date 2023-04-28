# Creating your own command for the Developer CLI

The CLI tool was designed from the beginning to be very easy to add new functionalities without touching the core. Also, it should be possible to add very simple commands without programming. 

We also decided to develop the project as open source software, but to make it possible to connect non-public commands to the system anyway.

## Simple Commands

By simple commands, we mean commands that could be called on the command line without any parameters. For this kind of commands, we have thought about something special. It is possible to specify a GitHub account when configuring our tool. 

![CLI Commands Screenshot](./images/commands-simple.png)

If you want to know more about this you should have a look at the [`commands:gist` extension](https://github.com/friends-of-wp/wp-dev-cli-ext-commands-gist). 

## Complex Commands

To create complex commands, must be able to program. Our commands are simple [Symfony Console](https://symfony.com/doc/current/components/console.html) commands that need to be registered. 

Because the manual of the console component of Symfony is already so good, we just want to link it here.

- [The Console Component](https://symfony.com/doc/current/components/console.html)

### How register a complex command

Registering own command can only be done at the moment when the project was installed as source code. 

```shell
git clone git@github.com:friends-of-wp/wp-dev-cli.git
```

Afterwards you can just add your commands to the [config file](https://github.com/friends-of-wp/wp-dev-cli/blob/develop/config/config.yml). 

Of course we have a ticket in our backlog to make it easier to use custom plugins with the phar installation.
