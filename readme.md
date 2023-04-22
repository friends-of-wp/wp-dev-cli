> **Warning**
> This command line client is work in progress. Feel free to help to "finish" it. Some of the commands may not work as intended it the moment.

# Friends of WP - WordPress Developer CLI

This command line tool helps WordPress developers with their daily work. It is maintained by the [Friends of WP](https://www.friendsofwp.com) and published unter the MIT license.

## Commands

- **`wordpress:directory:export`** - This command exports the information for all plugins from the wordpress.org plugin directory into a CSV file. 


- **`plugin:boilerplate:create`** - This function creates a new plugin boilerplate with all needed dependency. Additional steps can easily be defined. 

## Ideas

This CLI tool will always be work in progress. We have a lot of ideas that can be implemented. But it's open source ... feel free to add your own functionality.

- Create settings configuration ([RFC-FWP-01](https://github.com/friends-of-wp/rfc-fwp-01-settings))
- The CLI should be packed as `wp-dev.phar` via GitHub actions. This should be triggered when creating a new GitHub release. 
- An installation how-to should be added
- Developers should be able to add additional steps to the `plugin:boilerplate:create` command.
