# accounting-info-system

Installation wizard is on the to-do list.

General ledger and accounting information system


```_______________________________
/ Civilization is the limitless \
| multiplication of unnecessary |
| necessities.                  |
|                               |
\ -- Mark Twain                 /
 -------------------------------
   \
    \
        .--.
       |o_o |
       |:_/ |
      //   \ \
     (|     | )
    /'\_   _/`\
    \___)=(___/
```

# WHAT IS OAIS?

OAIS is an accounting information system designed to be user-friendly and accessible for anyone with a little bit of knowledge about business and some slight learning.  

All businesses need to maintain books.  If you're a small business, chances are that you swipe the same credit card for business as you do for personal spending.  How do you know which spending is for personal and which is for business?  Well, obviously you need to track the two--separately.  OAIS is for tracking business expenses that you incur and maintaining them in a safe and easy to manage way.  These expenses can range from purchasing supplies to paying employees to paying rent.  You want to ensure that you know what your expenses are for your business so you can not only pay the proper amount of taxes, but also so that you can run your business professionally and ensure you have the best information available.

Businesses also generate money--you can track revenues and send invoices out to clients with automated reminders.  OAIS takes care to track these revenues and stores them securely within a database so they can be accessed later.  Integrating payment processing through third-party APIs such as Stripe or Paypal are planned for the future.

OAIS is built on the fundamentals of accrual accounting which is the method used by most public US companies.  A ledger exists on the back-end that translates all transactions into an entry on the general ledger which separates different accounts into discrete buckets that maintain balances throughout the period.  You may or may not want to directly interact with this ledger--both options exist!  Instructions to use the general ledger are mostly intuitive but a guide is included below (not yet written).

Using this as a framework, OAIS can not only help maintain complete records but also generate reports of it.  Sales histories, inventory reports, A/R aging schedules, balance sheets, income statements, statements of cash flows, and more can be generated, printed, and viewed.  

# GETTING STARTED

## (For developers only): 

OAIS is in its very earliest stages of development and highly unsuitable for production uses.  If you would like to contribute please fork a copy of the repository and submit a pull request or submit an Issue and we can talk about it.

To install the application, you will follow steps similar to installing a normal Laravel project.  The application is intended for MySQL installations but the ORM should be able to handle other databases.

Note:  In the future, this app will come within a Docker container with all the tools necessary.  For now you will need the following:

Composer
npm
Artisan
Your choice of terminal

### 1. Clone the repo

    git clone https://github.com/cchoe1/accounting-info-system.git OAIS/
    cd OAIS/

### 2. Install dependencies

    composer install
    npm install

### 3. Edit .env.example

You will need to create the .env file using the provided .env.example file.  In this file, you will set the DB hostname and username/password and any other relevant configuration for the app.  Be sure to save the new file as .env

### 4. Generate application key

    php artisan key:generate

Note:  It is necessary to create the .env file first, as the key will be automatically placed in that file.

### 5. Copy the database schema

This app uses Migrations to manage the database schema.  Run the following command to copy the latest version of the schema:

    php artisan migrate

### 6. Seed the Database

The app requires some basic tables and journal entry accounts in order to work properly.  Run the following command to generate those defaults:

    php artisan db:seed --class=DatabaseSeeder

## (For consumers):

OAIS is in its very earliest stages of development and is not intended to be used currently.

# DISCLAIMER

The original author is not a certified public accountant and nothing about these instructions or about this software should be intended as financial advice.  Please use this software responsibly.
