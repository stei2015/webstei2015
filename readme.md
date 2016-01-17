# Web STEI 2015 - Laravel 5.2

## Openshift Deployment

Deploy this app to a HHVM cartridge + a MySQL cartridge with modification to the action hooks (see below).

The Laravel configuration (`app/config`) has been modified to accept Openshift MySQL and secret token environment variables.

Storage path is taken care within the build action hook which replaces the `storage` directory with a link to the Openshift data directory. (Note: if the `app-root/data/storage` directory is not yet present, create an empty directory structure by copying Laravel's `storage` folder first).

The build action hook script also installs Composer, runs `composer install`, and migrates the app database

### Preparations

1. Install rhc and run `rhc setup`
2. Navigate to the project directory
3. Run `rhc show-app web`, note the git repository address
4. Run `git remote add openshift <GIT-REPOSITORY-ADDRESS>`

### Deploy Files using Git

1. Make sure all local changes are committed to master, then run `git push openshift <LOCAL BRANCH NAME>:master`
2. Run `rhc ssh web`
3. Run `cd app-root/repo` in the ssh window

### Existing Data

Data is saved in a database named with the same name as the Openshift database by default.
Upload all existing data (profile pictures etc.) to `app-root/data` (the Openshift data directory).
