### Laravel File Maker

---

A simple tool to create repository, service and abstract class, as well as interface, enums, and trait to be used on a Laravel Package.

### Installation

---

```bash
composer require jmca03/laravel-file-maker
```

### Basic Usage

---

```bash

# Create Enum
# directory: app/Enums
php artisan make:enum :name

# Create Trait
# directory: app/Traits
php artisan make:trait :name

# Create Helper Class
# directory: app/Helpers
php artisan make:helper :name

# Create Service Class
# directory: app/Services
php artisan make:service :name

# Create Abstract Class
# directory: app/Abstracts
php artisan make:abstract :name

# Create Interface
# directory: app/Interfaces
php artisan make:interface :name

# Create Repository Class
# directory: app/Repositories
php artisan make:repository :name

```
