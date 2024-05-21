<?php

namespace NormanHuth\LaravelEmailLog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class EmailLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'subject',
        'body',
        'from',
        'to',
        'bbc',
        'cc',
        'reply_to',
        'headers',
        'attachments',
        'is_html',
        'priority',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'from' => 'array',
            'to' => 'array',
            'bbc' => 'array',
            'cc' => 'array',
            'reply_to' => 'array',
            'headers' => 'array',
            'attachments' => 'array',
            'is_html' => 'bool',
            'priority' => 'int',
        ];
    }

    /**
     * Get the parent authenticatable model.
     */
    public function authenticatable(): MorphTo
    {
        return $this->morphTo();
    }
}
