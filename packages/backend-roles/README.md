# Backend Roles

# Installation

1- Define package to your composer.json add this lines to composer.json :
` "repositories": [
    {
      "type": "git",
      "url":  "https://elsayed_nofal:5pGrh4AP3UEJdWCA6GR4@bitbucket.org/elsayed_nofal/backend-roles.git"
    }],`

    
2- Run command `composer require elsayed_nofal/backend-users:dev-master`

3- add service provider to config/app.php
`Elsayednofal\BackendRoles\BackendRolesServiceProvider::class,`

4- add middleWare to kernal
`'backend-role'=>\Elsayednofal\BackendRoles\Http\Middleware\RolesChek::class`

5- Run command `php artisan vendor:publish`

6 -Run command `php artisan migrate`

# configration    
edit configration from file config/backend-users 

# usage
    - roles data from url : ./config(url_prefix)/roles
	- roles data from url : ./config(url_prefix)/pages
    
   
    
    
