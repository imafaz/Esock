# lightweight php library for simple socketing

Esock is a lightweight library for create socket and read,write

---

- [Requirements](#requirements)
- [Installation](#installation)
- [Quick Start](#quick-start)
- [Usage](#usage)
- [Available Method](#available-method)
- [License](#license)

---

## Requirements

This library is supported by **PHP versions 7.0** or higher <br>
neili uses the **socket** php extention



## Installation

The preferred way to install this extension is through [Composer](http://getcomposer.org/download/).

To install **Esock**, simply:

    $ composer require imafaz/Esock


## Quick Start

To use this library with **Composer**:

```php
require __DIR__ . '/vendor/autoload.php';

use Esock\Esock;
```

## Usage

Create an instance of Esock
```php
$esok = new Esock;
```

server side:<br>
```php
$ip = '91.107.153.188';
$port = 9000;
$esock->initServer($ip, $port) or die($esock->lastError);


while (true) {

    $client = $esock->accept() or die($esock->lastError);


    $input = $esock->read($client) or die($esock->lastError);

    echo $input;

    $esock->write($client, 'ok') or die($esock->lastError);
    $esock->close($client) or die($esock->lastError);
}


```

client side:<br>
```php
$ip = '91.107.153.188';
$port = 9000;

$esock = new Esock;
$client = $esock->initClient($ip, $port) or die($esock->lastError);

$esock->write($client, 'its a realy test') or die($esock->lastError);

$input = $esock->read($client) or die($esock->lastError);
echo $input;


```

## Available Method

### - initServer

```php
// $esock->initServer($ip, $port);

// example:

$esock->initServer($ip, $port) or die($esock->lastError);
```

| Atttribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $ip | server listening ip | string | yes | null |
| $port | server listening port | int | yes | null |

**# Return** (bool)

### - initClient

```php
// $esock->initClient($ip, $port);

//example:

$client = $esock->initClient($ip, $port) or die($esock->lastError);

```

| Atttribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $ip | server ip | string | yes | null |
| $port | server port | int | yes | null |


**# Return** (bool)

### - accept

```php
// $esock->accept();

// example:
$client = $esock->accept() or die($esock->lastError);

```

**# Return** (object|bool)

### - read

```php
// $esock->read();

// example:
$input = $esock->read($clientSocket) or die($esock->lastError);

echo $input;
```

| Atttribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $clientSocket | client accept socket | object | yes | null |

**# Return** (string|bool)

### - write

```php
// $esock->write($clientSocket, 'its a realy test');

// example:

$esock->write($client, 'ok') or die($esock->lastError);
```

| Atttribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $clientSocket | client accept socket | object | yes | null |
| $output | text to write | string | yes | null |

**# Return** (bool)

### - close

```php
// $esock->close($socket);

// example:

$esock->close($socket);
```

| Atttribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $socket | socket object | object | yes | null |

**# Return** (bool)


# License
- This script is licensed under the [MIT License](https://opensource.org/licenses/MIT).