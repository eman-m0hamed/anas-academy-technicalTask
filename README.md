## Getting Started

1-clone the application first

    git clone https://github.com/eman-m0hamed/anas-academy-technicalTask.git

2-open cmd inside the application then run this command to Install Dependencies:

    composer install

3-copy .env.example and rename the copy to .env

4-Update the .env file with your database and Stripe API credentials.

5-generate application key

    php artisan key:generate

6-run migration file

    php artisan migrate
   
7- run seeder files for creating fake data in database tables



    php artisan db:seed --class=SeederName  
    
**For categories Table**

    php artisan db:seed --class=CategorySeeder  
    
**For products Table**

    php artisan db:seed --class=ProductSeeder   
***Warning***

**you can't use ProductSeeder before using CategorySeeder if categories table is Empty**
    

## Running
To run the project write this command in project terminal
    php artisan serve


## Stripe Integration   
1. Create a Stripe Account
Visit Stripe and create an account if you don't have one through this link.
    https://dashboard.stripe.com/register

2. Obtain API Keys
- Login to your Stripe Dashboard.

- Go to Developers > API Keys.

- Copy the Publishable Key and Secret Key.

- Update your .env file with the keys:
    STRIPE_KEY=your_publishable_key
    STRIPE_SECRET=your_secret_key

## web authentication 
    used jetstream intera js as Laravel's built-in authentication system.

## api authentication
    - used sanctum package for authentication.
    - install sanctum package, then add its gaurds in config/auth.php file.
    - set it middleware in app/Http/Kernel.php file.
    - products routes can't access without the user login.
    - consider the user is an admin.

# Generate API Token:
- To generate API tokens for users, can use Sanctum's createToken method and return plainTextToken that use the user api and secret_key to generate the token text.  

## Access ApI token
- user needs login to have the token.
- can use /api/login route.
- if the user does not have have account can register through /api/register route.

## How to send token with request
To make requests to the protected API endpoint, you need to include an access token in the request headers.
    Authorization: Bearer {access_token}


## web routes
- /login => login form
- /register => register form
- /products => all products data
- /products/create => create a new product form
- /products/update => update a product form
- /products/:id => show a product data
- /dashboard => show a dashboard
- /payment => payment form

## api routes
- /login => login api with method POST
- /register => register api with method GET
- /products => all products data with pagination.  
    with method GET.
    need to send page parameter to represent the wanted page number and limit prameter for data records numbers limit.
    need to send access token in request headers.
- /products => create a new product form with method POST


    
