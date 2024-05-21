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
    protected array $fillable = [
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
            'is_pre_order' => 'bool',
            'is_posa' => 'bool',
            'is_ptr_allowed' => 'bool',
            'is_returnable' => 'bool',
            'purchase_price' => 'decimal:2',
            'supplier_price' => 'decimal:2',
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
