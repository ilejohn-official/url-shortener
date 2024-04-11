# Url Shortener

## Table of contents

- [General Info](#general-info)
- [Requirements](#requirements)
- [Setup](#setup)
- [Usage](#usage)

## General Info

This project creates a webpage prototype for URLs shortener.

## Requirements

- [php ^8.1](https://www.php.net/ "PHP")
- [ariaieboy/laravel-safe-browsing](https://github.com/ariaieboy/laravel-safe-browsing "laravel-safe-browsing")

## Setup

- Clone the project and navigate to it's root path and install the required dependency packages using the below commands on the terminal/command line interface.

  ```bash
  git clone https://github.com/ilejohn-official/url-shortener
  cd url-shortener
  ```

  ```
  composer install
  ```

- Copy and paste the content of the .env.example file into a new file named .env in the same directory as the former and set it's  
  values based on your environment's configuration.

- set google api key as `SAFEBROWSING_GOOGLE_API_KEY`.

- set `APP_URL` in env correctly based on environment.

- Generate Application Key

  ```
  php artisan key:generate
  ```
- Run Migration

  ```
  php artisan migrate
  ```

## Usage

- To run local server

  ```
  php artisan serve
  ```

  ```
  npm run dev
  ```
