# Web STEI 2015 - Laravel 5.2

## Openshift Deployment

Deploy this app to a DIY cartridge. It uses a customized version of the cartridge openshift-diy-nginx-php (https://github.com/boekkooi/openshift-diy-nginx-php).

### Local Preparations

1. Install rhc and run `rhc setup`
2. Navigate to the project directory
3. Run `rhc show-app <APPLICATION_NAME>`, note the git repository address
4. Run `git remote add openshift <GIT_REPOSITORY_ADDRESS>`

### Deploy Files using Git

Make sure all changes are commited, then run `git push -f openshift <LOCAL_BRANCH_NAME>:master`

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

### Troubleshooting

- Encryption key errors: make sure the app key is set properly (length must be exactly 32 chars).
- MySQL errors: try running `php artisan cache:clear` manually to rebuild Laravel configuration according to the current Openshift environment variables