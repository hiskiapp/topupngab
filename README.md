<p align="center">
  <a href="https://github.com/hiskiapp/topupngab">
    <img src="https://indiepartnership.com/wp-content/uploads/2020/09/icon.png" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">Top up Ngab</h3>

  <p align="center">
    A website to manage top up transactions.
    <br />
    <a href="https://github.com/hiskiapp/topupngab"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/hiskiapp/topupngab">View Demo</a>
    ·
    <a href="https://github.com/hiskiapp/topupngab/issues">Report Bug</a>
    ·
    <a href="https://github.com/hiskiapp/topupngab/issues">Request Feature</a>
  </p>
</p>



<!-- TABLE OF CONTENTS -->
## Table of Contents

* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
* [To Do List](#to-do-list)
* [Acknowledgements](#acknowledgements)

### Built With
* [Bootstrap](https://getbootstrap.com)
* [JQuery](https://jquery.com)
* [Laravel](https://laravel.com)



<!-- GETTING STARTED -->
## Getting Started

This is an example of how you may give instructions on setting up your project locally.
To get a local copy up and running follow these simple example steps.

### Prerequisites
-   PHP Version 7.4 or Above
-   Composer
-   Git
-   NPM

### Installation

1. Open the terminal, navigate to your directory (htdocs or public_html).
```bash
git clone https://github.com/hiskiapp/topupngab.git
cd topupngab
composer install
npm install && npm run dev
```

2. Setting the database, smtp, tripay, dan tawkto configuration, open .env file at project root directory
```
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

MAIL_MAILER=
MAIL_HOST=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="${APP_NAME}"

TRIPAY_MERCHANT_CODE=
TRIPAY_API_KEY=
TRIPAY_PRIVATE_KEY=
TRIPAY_DEBUG=
```

3. Install Project
```bash
php artisan key:generate
php artisan migrate --seed
php artisan optimize
```
You will get the administrator credential and url access like example bellow:
```bash
::Administrator Credential::
URL Login: http://localhost/topupngab/public/login
Email: hiskianggi@gmail.com
Password: 123456
```

### To Do List

- [x] Initializing Template
- [x] Migration
- [x] Auth
- [x] Master Data
- [x] Bot
- [x] Broadcast, Schedullar
- [ ] Transaction
- [ ] Home & Report

<!-- ACKNOWLEDGEMENTS -->
## Acknowledgements
* [Laravel](https://laravel.com)
* [Metronic - Bootstrap 4 HTML, React, Angular 11, VueJS & Laravel Admin Dashboard Theme](https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469)
