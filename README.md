<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Contact Manager Installation
1.  `git clone https://github.com/neterslandreau/launchcart.git [destination]`
1. `cd [destination]`
1.  `composer update`
1. Edit `.env` to update database and include `KLAVIO_API_KEY` with the value of your Klavio api_key.
1. `php artisan migrate`

## Known Bugs
The bugs have been noted in the PHPDoc blocks. Many, I believe, are due to my inexperience
with the Klavio platform:
- During development, I had created a few contacts and received 200 responses but no content associated with the response.
When I woke up this morning, I had many emails requesting confirmation.
- Also, I was unable to determine how in Klavio to create a custom segment that would listen for clicks.
