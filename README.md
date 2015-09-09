# Web STEI 2015

## How to Deploy

1. Copy `config.php.example` to `config.php`
2. Edit `config.php`, change settings as needed
3. Copy `.htaccess.example` to `.htaccess`, place in server's document root
4. Edit `.htaccess` as needed to redirect to `/webstei2015/public` or wherever the public directory is
5. Open phpmyadmin, import `webstei2015.sql` to the current database
6. Open the website, register an account
7. Using phpmyadmin, open the `users` table, change the `type` of your account to `admin`
8. Don't forget to set write permissions to the `data` directory and its child directories

## TODO

- Forum
- Moderator
- Chat
- Data search
- Profile page
- File + image sharing
- Birthday notification
- Automated password reset etc. using email
