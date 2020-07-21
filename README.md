<p align="center"><img src="https://ik.imagekit.io/tunnandaaung/tweety-logo_JEwSguOGK.svg" width="300"></p>

[![Build Status](https://travis-ci.org/TunNandaAung/tweety.svg?branch=master)](https://travis-ci.org/TunNandaAung/tweety)

# Tweety

This is the repository for the "Laravel From Scratch" [final project](https://laracasts.com/series/laravel-6-from-scratch#chapter-14) at Laracasts with [extended functionalities](#extended-functionalities). Original repository can be found [here](https://github.com/laracasts/Tweety).

## Installation

### Prerequisites

-   To run this project, you must have PHP 7 and above installed.
-   You should setup a host on your web server for your local domain. For this you could also configure Laravel Homestead or Valet.

### Step 1

Begin by cloning this repository to your machine, and installing all Composer & NPM dependencies using the following commands.

```bash
git clone git@github.com:TunNandaAung/tweety.git
cd tweety && composer install && npm install
php artisan tweety:install
npm run dev
```

#### Instant Search

-   For instant search, you need to create an account at [algolia](https://www.algolia.com/users/sign_up).
-   Then, you have to reference your algolia app id and algolia secret key in your `.env` file as below.

```bash
MIX_ALGOLIA_APP_ID=YOUR_ALGOLIA_APP_ID
MIX_ALGOLIA_SECRET=YOUR_ALGOLIA_SECRET
```

### Step 2

Next, boot up a server and visit Tweety. If you are using Laravel Valet, the URL will default to `http://tweety.test`.

## Extended Functionalities

1. Dynamic profile banner image and description for each user.
2. The ability to attach an image when publishing a tweet.
3. The ability to toggle a like.
4. Pop-up flash messages.
5. Interactivity with [Vuejs](https://vuejs.org/).
6. Display the number of remaining characters allowed when writing a new tweet.
7. Allow tweets to be deleted.
8. Mentions and notifications.
9. Two level nested replies.
10. Instant search with algolia
