<p align="center">Institute</p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Institute

* This is a web application to  manage students & instructors, and which classes students are taking along with the subjects that the instructors teach.

##  Please run following commands to set up the project ##

* type `git clone git@github.com:gayathma/institute.git` to clone the repository or download as a zip file and unzip it in your folder.  
* type `cd institute`
* copy *.env.example* to *.env*
* create database `institute` using mysql 
* update `DB_DATABASE, DB_USERNAME, DB_PASSWORD` values in .env file
* type `php artisan migrate` the user tables
* type `php artisan module:migrate` to migrate the module tables
* type `php artisan module:seed` to seed the dummy data
* type `php artisan serve` with the given url you can access the application in the browser
* you can create a new user using the 'Register' menu item. And then login into the system using the credentials.

### Features ###

* User Registration, Login and Forgot Password features are implemented.
* The application should allow a user to create, edit, or delete subjects, classes, instructors and students.
* User can allocate subjects and instructors for a class. Also can assign a student for a class.
* Custom error pages 403, 404 and 503

![Alt text](/screenshots/1.png?raw=true "Subjects Page")

![Alt text](/screenshots/2.png?raw=true "Instructor Page")

![Alt text](/screenshots/3.png?raw=true "Classes Page")

![Alt text](/screenshots/4.png?raw=true "Instructor Create Page")

![Alt text](/screenshots/5.png?raw=true "Students Page")


## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
