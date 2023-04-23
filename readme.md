> **Warning**
> This command line client is work in progress. Feel free to help to "finish" it. Some of the commands may not work as intended it the moment.

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/friends-of-wp/wp-dev-cli/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/friends-of-wp/wp-dev-cli/?branch=develop)

# Friends of WP - WordPress Developer CLI

This command line tool helps WordPress developers with their daily work. It is maintained by the [Friends of WP](https://www.friendsofwp.com) and published unter the MIT license.

## Commands

- **`wordpress:directory:export`** - This command exports the information for all plugins from the wordpress.org plugin directory into a CSV file. 


- **`plugin:boilerplate:create`** - This function creates a new plugin boilerplate with all needed dependency. Additional steps can easily be defined. [More information](docs/command/plugin-boilerplate-create.md).

## Ideas

This CLI tool will always be work in progress. We have a lot of ideas that can be implemented. But it's open source ... feel free to add your own functionality.

- The CLI should be packed as `wp-dev.phar` via GitHub actions. This should be triggered when creating a new GitHub release. 
- An installation how-to should be added
- `plugin:boilerplate:create` - Create settings configuration ([RFC-FWP-01](https://github.com/friends-of-wp/rfc-fwp-01-settings))
