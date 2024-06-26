## ⚠️ All credits go to Coderflex ⚠️
This is a custom version for Lumina products. All credits goes to [coderflexx/laravel-ticket](https://github.com/coderflexx/laravel-ticket)

<p align="center">
    <img src="art/logo.png" alt="Laravisit Logo" width="300">
    <br><br>
</p>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lumina/tickets.svg?style=flat-square)](https://packagist.org/packages/lumina/tickets)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/coderflexx/laravel-ticket/run-tests.yml?branch=main&label=test)](https://github.com/coderflexx/laravel-ticket/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/coderflexx/laravel-ticket/phpstan.yml?branch=main&label=code%20style)](https://github.com/coderflexx/laravel-ticket/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/lumina/tickets.svg?style=flat-square)](https://packagist.org/packages/lumina/tickets)

- [⚠️ All credits go to Coderflex ⚠️](#️-all-credits-go-to-coderflex-️)
- [Introduction](#introduction)
- [Installation](#installation)
- [Configuration](#configuration)
- [Preparing your model](#preparing-your-model)
- [Usage](#usage)
  - [Ticket Table Structure](#ticket-table-structure)
  - [Message Table Structure](#message-table-structure)
  - [Category Table Structure](#category-table-structure)
- [API Methods](#api-methods)
  - [Ticket API Methods](#ticket-api-methods)
  - [Ticket Relationship API Methods](#ticket-relationship-api-methods)
  - [Ticket Scopes](#ticket-scopes)
- [Handling File Upload](#handling-file-upload)
- [Testing](#testing)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [Security Vulnerabilities](#security-vulnerabilities)
- [Credits](#credits)
- [License](#license)

## Introduction
__Laravel Ticket__ package, is a Backend API to handle your ticket system, with an easy way.

## Installation

You can install the package via composer:

```bash
composer require lumina/tickets
```

## Configuration

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="ticket-migrations"
```
Before Running the migration, you may publish the config file, and make sure the current tables does not make a conflict with your existing application, and once you are happy with the migration table, you can run

```bash
php artisan migrate
```

## Preparing your model

Add `HasTickets` trait into your `User` model, along with `CanUseTickets` interface

```php
...
use Lumina\Tickets\Concerns\HasTickets;
use Lumina\Tickets\Contracts\CanUseTickets;
...
class User extends Model implements CanUseTickets
{
    ...
    use HasTickets;
    ...
}
```

## Usage

The Basic Usage of this package, is to create a `ticket`, then associate the `categories` to it.

You can associate as many as `categories` into a single ticket.

Here is an example

```php
use Lumina\Tickets\Models\Ticket;
use Lumina\Tickets\Models\Category;

...
public function store(Request $request)
{
    /** @var User */
    $user = Auth::user();

    $ticket = $user->tickets()
                    ->create($request->validated());

    $category = Category::first();
    $ticket->attachCategories($category);
    
    // or you can create the categories & the tickets directly by:
    // $ticket->categories()->create(...);

    return redirect(route('tickets.show', $ticket->uuid))
            ->with('success', __('Your Ticket Was created successfully.'));
}

public function createCategory()
{
    // If you create a category/categories seperated from the ticket and wants to
    // associate it to a ticket, you may do the following.
    $category = Category::create(...);

    $category->tickets()->attach($ticket);

    // or maybe 
    $category->tickets()->detach($ticket);
}
...
```

### Ticket Table Structure

| Column Name | Type        | Default    |
| ----------- | ----------- | ---------- |
| ID          | `integer`   | `NOT NULL` |
| UUID        | `string`    | `NOT NULL` |
| user_id     | `integer`   | `NOT NULL` |
| title       | `string`    | `NOT NULL` |
| message     | `string`    | `NOT NULL` |
| status      | `string`    | `open`     |
| created_at  | `timestamp` | `NULL`     |
| updated_at  | `timestamp` | `NULL`     |

### Message Table Structure

| Column Name | Type        | Default    |
| ----------- | ----------- | ---------- |
| ID          | `integer`   | `NOT NULL` |
| user_id     | `integer`   | `NOT NULL` |
| ticket_id   | `integer`   | `NOT NULL` |
| message     | `string`    | `NOT NULL` |
| created_at  | `timestamp` | `NULL`     |
| updated_at  | `timestamp` | `NULL`     |

### Category Table Structure

| Column Name | Type        | Default    |
| ----------- | ----------- | ---------- |
| ID          | `integer`   | `NOT NULL` |
| name        | `string`    | `NULL`     |
| created_at  | `timestamp` | `NULL`     |
| updated_at  | `timestamp` | `NULL`     |

## API Methods

### Ticket API Methods
The `ticket` model came with handy methods to use, to make your building process easy and fast, and here is the list of the available __API__:

| Method     | Arguments | Description                | Example               |
| ---------- | --------- | -------------------------- | --------------------- |
| `close`    | `void`    | close the ticket           | `$ticket->close()`    |
| `open`     | `void`    | open a closed ticket       | `$ticket->open()`     |
| `isOpen`   | `void`    | check if the ticket open   | `$ticket->isOpen()`   |
| `isClosed` | `void`    | check if the ticket closed | `$ticket->isClosed()` |

### Ticket Relationship API Methods
The `ticket` model has also a list of methods for interacting with another related models

| Method             | Arguments                                    | Description                                  | Example                                     |
| ------------------ | -------------------------------------------- | -------------------------------------------- | ------------------------------------------- |
| `attachCategories` | `mixed` ID, `array` attributes, `bool` touch | associate categories into an existing ticket | `$ticket->attachCategories([1,2,3,4])`      |
| `syncCategories`   | `Model/array` IDs, `bool` detouching         | associate categories into an existing ticket | `$ticket->syncCategories([1,2,3,4])`        |
| `message`          | `string` message                             | add new message on an existing ticket        | `$ticket->message('A message in a ticket')` |

> The `attachCategories` and `syncCategories` methods, is an alternative for `attach` and `sync` laravel methods, and if you want to learn more, please take a look at this [link](https://laravel.com/docs/9.x/eloquent-relationships#attaching-detaching)

The `commentAsUser` accepts a user as a first argument, if it's null, the __authenticated__ user will be user as default.

### Ticket Scopes
The `ticket` model has also a list of scopes to begin filter with.

| Method   | Arguments | Description            | Example                   |
| -------- | --------- | ---------------------- | ------------------------- |
| `opened` | `void`    | get the opened tickets | `Ticket::opened()->get()` |
| `closed` | `void`    | get the closed tickets | `Ticket::closed()->get()` |

## Handling File Upload
This package doesn't come with file upload feature (yet) Instead you can use [laravel-medialibrary](https://github.com/spatie/laravel-medialibrary) by __Spatie__,
to handle file functionality.

The steps are pretty straight forward, all what you need to do is the following.

Extends the `Ticket` model, by creating a new model file in your application by
```
php artisan make:model Ticket
```

Then extend the base `Ticket Model`, then use `InteractWithMedia` trait by spatie package, and the interface `HasMedia`:

```php
namespace App\Models\Ticket;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends \Lumina\Tickets\Models\Ticket implements HasMedia
{
    use InteractsWithMedia;
}
```

The rest of the implementation, head to [the docs](https://spatie.be/docs/laravel-medialibrary/v10/introduction) of spatie package to know more.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [ousid](https://github.com/ousid)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
