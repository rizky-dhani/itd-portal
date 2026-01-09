<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmailRequisition extends Model
{
    protected $guarded = ['id'];

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function deptHead(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dept_head_id');
    }

    public function itdPersonnel(): BelongsTo
    {
        return $this->belongsTo(User::class, 'itd_personnel_id');
    }

    public function itdManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'itd_manager_id');
    }

    public function monitorings(): HasMany
    {
        return $this->hasMany(EmailMonitoring::class);
    }
}