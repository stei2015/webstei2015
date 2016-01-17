# Web STEI 2015 - Laravel 5.2

## Openshift Deployment

Deploy this app to a DIY cartridge. It uses a customized version of the cartridge openshift-diy-nginx-php (https://github.com/boekkooi/openshift-diy-nginx-php).

### Local Preparations

1. Install rhc and run `rhc setup`
2. Navigate to the project directory
3. Run `rhc show-app <APPLICATION_NAME>`, note the git repository address
4. Run `git remote add openshift <GIT-REPOSITORY-ADDRESS>`

### Deploy Files using Git

<<<<<<< HEAD
1. Merge all changes to the Openshift deploy branch.
2. Make sure all local changes are committed, then run `git push openshift <LOCAL OPENSHIFT DEPLOY BRANCH NAME>:master`.
You might need to force the push using the `-f` flag.
=======
Make sure all local changes are committed to master, then run `git push openshift <LOCAL BRANCH NAME>:master`
>>>>>>> 0df6ff390e86fe0a85cbc6bc1d94306462a93965

On the first deploy, 

1. Run `rhc ssh <APPLICATION_NAME>`
2. Run `cd app-root/repo`
3. Run `php artisan migrate` to create tables. You might need to force the migration on production.
3. Move existing data, if any.

### Existing Data

Data is saved in a database named with the same name as the Openshift database by default.
Upload all existing data (profile pictures etc.) to `app-root/data/storage`.

### Environment

To set the application environment between development/production, run `rhc env set APPLICATION_ENV=development`, and then restart the application using `rhc app-restart <APPLICATION_NAME>`