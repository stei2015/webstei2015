# Web STEI 2015 - Laravel 5.2

## Openshift Deployment

Deploy this app to a HHVM cartridge + a MySQL cartridge.

The Laravel configuration (`app/config`) has been modified to accept Openshift MySQL and secret token environment variables.

Openshift action hooks are available in the .openshift directory.

Storage path is taken care within the build action hook which replaces the `storage` directory with a link to the Openshift data directory. (Note: if the `app-root/data/storage` directory is not yet present, create an empty directory structure by copying Laravel's `storage` folder first).

The build action hook script also installs Composer, and runs `composer install`.

Note: the build action hook also creates a `hhvm` symlink in Openshift data directory for your convenience. Use this symlink to execute commands normally meant to be run using PHP (e.g. the artisan commands) as the PHP version provided by Openshift isn't compatible with Laravel 5.2.

### Local Preparations

1. Install rhc and run `rhc setup`
2. Navigate to the project directory
3. Run `rhc show-app <APPLICATION_NAME>`, note the git repository address
4. Run `git remote add openshift <GIT-REPOSITORY-ADDRESS>`

### Deploy Files using Git

Make sure all local changes are committed to master, then run `git push openshift <LOCAL BRANCH NAME>:master`.
You might need to force the push using the `-f` flag.

On the first deploy, 

1. Run `rhc ssh <APPLICATION_NAME>`
2. Run `cd app-root/repo`
3. Run `$OPENSHIFT_DATA_DIR/hhvm artisan migrate` to create tables. You might need to force the migration on production.
3. Move existing data, if any.

### Existing Data

Data is saved in a database named with the same name as the Openshift database by default.
Upload all existing data (profile pictures etc.) to `app-root/data/storage`.

### Environment

To set the application environment between development/production, run `rhc env set APPLICATION_ENV=development`, and then restart the application using `rhc app-restart <APPLICATION_NAME>`