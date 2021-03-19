# DiscussStocks

DiscussStocks is Reddit-like discussion board for individual investors to come together and share ideas. It's still a 
work in progess: Below is a list of what is working (small), and what's not working (long)

## Design Notes

One decision I've made in the design process is to use a single table (Content) to store the bulk of data in the site. 
Channels, Posts and Replies are all stored there. Directing this data is the Content Model, which is extended by the
Channels, Posts and Replies models.

I know this isn't a methodology that many will agree with, but I felt like I *had* to give it a try in order to see what
the outcome is. I'm not seeing a particular downside to this method, except for the need to declare the type of data 
that is being searched for (ex, in order to pull out all posts, you need to do `Posts::where('type', '=', 'post')` 
rather than `Posts::all()` 

## Installation
This uses PHP 8, Laravel 8, MySQL database, and so far has been running on the Apache web server. Make sure the following
is set in your .env file:

* `APP_NAME` = is displayed throughout the app
* `APP_KEY` = is used by Hash_Id's as its salt for generating unique hash_id's for use in the UI
* `APP_URL` = is used in places, and must the actual URL of your site, with no trailing slash.

I am using [Mailtrap.io](https://mailtrap.io) to test outbound email links, you may choose a different service altogether, 
or even none at all.

####Seeding the database with sample data: 
`php artisan migrate:refresh --seed` generates channels, posts, threaded replies and users.

####Create administrator:
`php artisan make:admin` creates your admin user, prompting for username, email, password. It performs no validation 
just take strings

## Notes
Familiarize yourself with the Content, Channels, Posts, and Replies models, they do the heavy lifting.

##
This is not functional yet. It's just a skeleton that's still getting fleshed out. Don't clone this repository thinking 
that you can get up and running. You can't. If you want to help contribute, maybe we'll get to a final product sooner, 
though!

## What is working

* Account registration (new accounts can be created)
* Registration emails & account validation
* Subscribing / unsubscribing from Channels 
* Viewing posts only for subscribed channels
* Channels can have Posts, which can have Replies, and those Replies can have successive levels of replies after that
* Logged in users can vote on Posts and Replies - only a single upvote or downvote. If a user tries to cast a second vote,
if just nullifies the first. A third vote will then be recorded.

## TODO

* User roles
  * Guest users only see posts, not replies
  * Logged in users get full experience, but might also show ads with Google and use Google for analytics
  * Paid users will not recieve ads OR analyics. Ultimately, all HTTP rests made by paid users will be to resources
    on the same domain for privacy purposes
  * Admin users who will be able to moderate (soft-delete) everything on the site except for content from the super admin
  * Superadmin who can moderate and delete everything
* Allow Users to create posts
  * Posts will be able to have attachments (image, excel, PDF);
* Allow Users to reply to posts
* Allow Users to reply to replies

* Allow channel owners to see subcribers to their channel
* Allow channel owners to set whether content posted to their channel is live immediately or if it needs approval
* Allow channel owners to approve posts, and to remove posts that violate their channels rules.

* Decide on a company to use for stock market data. Retrieve real time quotes whenever a stock is mentioned in a post or 
comment, so we can later show how that stock performed since the user mentioned it.
  
