# Usage in Laravel Nova

## Create A Nova Resource

```bash
php artisan nova:resource EmailLog
```

## Edit Resource

### Set Correct Model

Edit `/Nova/Resources/EmailLog.php` and change the $model string to the package or your custom model.

```php
//..
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \NormanHuth\LaravelEmailLog\Models\EmailLog::class;
//..
```

### Add Package Trait

```php
use NormanHuth\LaravelEmailLog\Traits\LaravelNovaTrait;

class EmailLog extends Resource
{
    use LaravelNovaTrait;
    // ..
}
```

### Update `$title` and `$search`

```php
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'subject';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'subject',
        'body',
        'from',
        'to',
        'bbc',
        'cc',
        'reply_to',
        'headers',
        'attachments',
    ];
```

### Update `fields`

```php
    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     * @throws \Laravel\Nova\Exceptions\HelperNotSupported
     */
    public function fields(NovaRequest $request): array
    {
        return $this->logFields($request);
    }
```

## Create A Policy

[Create a policy](https://laravel.com/docs/10.x/authorization) to determine who can see the log and prevent to create or update a log.
