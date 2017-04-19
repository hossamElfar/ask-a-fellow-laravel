##### Ask a Fellow

An education social platform for GUC students.
Ask a question and get answers from your colleagues or TAs.

# installation
### Note
Note that this guide assumes that you installed the following in your computer:-
1. PHP and mysql
2. composer
3. git

### Cloning
1. type `git clone https://github.com/hossamElfar/ask-a-fellow-laravel.git`
2. navigate to the project directory and type `composer install`

### confuguring .env file and project cashing
1. type `cp .env.example .env`
2. then type `php artisan key:generate` 
3. modify the keys of the `.env` as  sent to you in the email
4. run the server `sudo php artisan serve`, most propaply you will get caching path problrm
5. run `sudo su`
6. and run this command in the root directory of the project `cd storage/ && mkdir framework && cd framework/ && mkdir chache && mkdir sessions && mkdir views`
7. That is it !! happy coding ;)



