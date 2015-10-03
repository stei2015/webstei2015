# Web STEI 2015

## Deploying to Openshift

### Preparations

1. Install rhc and run `rhc setup`
2. Navigate to the project directory
3. Run `rhc show-app web`, note the git repository address
4. Run `git remote add openshift <GIT-REPOSITORY-ADDRESS>`

### Deploy Files using Git

1. Make sure all local changes are committed to master, then run `git push openshift master`
OR make sure all local changes are committed to dev, then run `git push openshift dev:master`
2. Run `rhc ssh web`
3. Run `cd app-root/repo` in the ssh window
4. Run `cp config.php.example config.php` and change settings as needed

### Copy Existing User Data

1. Open phpmyadmin from the Openshift web dashboard
2. Create a new database named `webstei2015`
3. Import empty database structure `webstei2015.sql` or other phpmyadmin backup sql file.
4. Run `rhc ssh web`, upload existing data folder to `app-root/data`

## TODO

- Password reset
- Forum
- Moderator
- Chat
- Profile page
- File + image sharing
- Birthday notification
- Automated password reset etc. using email
