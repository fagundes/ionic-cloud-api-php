# Ionic Cloud APIs Library for PHP #

## Description ##
The Ionic Cloud API Library enables you to work with Ionic APIs such as Push, Auth and Deploy.

## WIP ##
This library is not ready yet

## Requirements ##
* [PHP 5.6.0 or higher](http://www.php.net/).

## Developer Documentation ##
WIP

## Installation ##

You can use **Composer** or simply **Download the Release**

### Composer

The preferred method is via [composer](https://getcomposer.org). Follow the
[installation instructions](https://getcomposer.org/doc/00-intro.md) if you do not already have
composer installed.

Once composer is installed, execute the following command in your project root to install this library:

```sh
composer require fagundes/ionic-cloud-api-php:^0.x-dev
```

Finally, be sure to include the autoloader:

```php
require_once '/path/to/your-project/vendor/autoload.php';
```

### Download the Release

If you abhor using composer, you can download the package in its entirety. The [Releases](https://github.com/fagundes/ionic-cloud-api-php/releases) page lists all stable versions. Download any file
with the name `ionic-cloud-api-php-[RELEASE_NAME].zip` for a package including this library and its dependencies.

Uncompress the zip file you download, and include the autoloader in your project:

```php
require_once '/path/to/ionic-cloud-api-php/vendor/autoload.php';
```

## Examples ##
See the [`examples/`](examples) directory for examples of the key client features. You can
view them in your browser by running the php built-in web server.

```sh
$ composer run-script serve
```

And then browsing to the host and port you specified
(in the above example, `http://localhost:8080`).

### Basic Example ###

```php
// include your composer dependencies
require_once 'vendor/autoload.php';

$client = new Ionic\Client();
$client->setApplicationName("Client_Library_Examples");
$client->setApiToken("YOUR_API_TOKEN");

$service = new Ionic\Service\Push($client);
$notifications = $service->notifications->listAll();

foreach ($notifications as $notification) {
 echo 'UUID: ', $notification->getUuid(), ' ', $notification->getCreated()->format('d/m/Y \a\t H:i'), "<br /> \n";
}
```

## Credits ##

This project is inspired by [Google APIs Client Library for PHP](https://github.com/google/google-api-php-client).