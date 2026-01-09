<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailMonitoring extends Model
{
    protected $guarded = ['id'];

    public function emailRequisition(): BelongsTo
    {
        return $this->belongsTo(EmailRequisition::class);
    }
}