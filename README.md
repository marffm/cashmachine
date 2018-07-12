# Cash Machine

This project simulates a withdraw. It returns a json with the notes will be delivery.

## Getting Started

To use this project, you only need to clone this repository and install its dependencies through composer.
Run the composer update and you up to use this application.

```
composer install
```

To run the application. Open a new command prompt on root folder
Use this command:
```
php -S localhost:8888 -t public
```
You can choose whatever port you want.

### Prerequisites

To run this application, you will need at least php 7.1.9 and composer installed on your machine.

## Running the tests

You can run tests on this system just using one command.

```
composer check
```

## To make Calls
With server up and running, you will only have one request to test

```
Your Server/withdraw/{a numeric value}
```
