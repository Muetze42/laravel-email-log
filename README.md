# Laravel Email Log

Save sent emails in the database.  
If there is an authenticated user while sending a mail, it will be saved as `authenticatable` (polymorphic relation).

## Install

```bash
composer require norman-huth/laravel-email-log
```

### Optional: Publish

#### Publish [config file](config/email-log.php)

```bash
php artisan vendor:publish --provider="NormanHuth\LaravelEmailLog\Providers\PackageServiceProvider" --tag="email-log-config"
```

#### Publish [Migration](database/migrations/2023_10_18_000000_create_email_logs_table.php)

```bash
php artisan vendor:publish --provider="NormanHuth\LaravelEmailLog\Providers\PackageServiceProvider" --tag="email-log-migrations"
```

## Usage

It’s a [Laravel Eloquent Model](https://laravel.com/docs/10.x/eloquent).

````php
use NormanHuth\LaravelEmailLog\Models\EmailLog::class;

return EmailLog::all();

return EmailLog::find(1);

return EmailLog::find(1)->authenticatable;
````

## Laravel Nova

For a [Laravel Nova](https://nova.laravel.com/) integration read [NOVA.md](NOVA.md)

## Model

```javascript
ErrorLog = {
    'id': Number,
    'subject': String,
    'body': String,
    'from': Array,
    'to': Array,
    'bbc': Array,
    'cc': Array,
    'reply_to': Array,
    'headers': Array,
    'attachments': Array,
    'is_html': Boolean,
    'priority': Number,
    'authenticatable_type': String|Null,
    'authenticatable_id': Number|Null,
    'created_at': String|Null,
    'updated_at': String|Null,
    'deleted_at': String|Null
}
```

### Model Relationship

Nullable morph.

```php
/**
* Get the parent authenticatable model.
*/
public function authenticatable(): MorphTo
{
    return $this->morphTo();
}
```

### SoftDeletes

The [softDeletes](https://laravel.com/docs/10.x/migrations#column-method-softDeletes) column is present in the
migration, but the [SoftDeletes Trait](https://laravel.com/docs/10.x/eloquent#soft-deleting) is not using by the Model.
