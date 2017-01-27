# cakephp-ranking

Simple ranking made with CakePHP 3

# Setup

Create a database and set the proper values in the /config/app.php file (use app.default.php as template)

```
git clone https://github.com/vortixhead/cakephp-ranking.git
cd cakephp-ranking
composer install
bin/cake migrations migrate && bin/cake migrations seed
```

Auth uses email instead of username, default admin credentials are:

email: admin@example.com
password: vortixhead

Then create some events from the admin page and go to the ranking page.

# Notes

Bootstrap 3 is used in ranking page only, which is the only one intended to be public.
The ranking page reloads itself periodicaly, and the ranking resets each day at 7AM.
It adds up the score from the same customer name.
The event page has an "export to CSV" button.
