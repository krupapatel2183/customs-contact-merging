<?php

namespace App\Models;

use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MergedContact extends Model
{
    use ColumnFillable, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'master_contact_id',
        'merged_contact_id',
        'merged_at',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    // Relationships
    public function masterContact()
    {
        return $this->belongsTo(Contact::class, 'master_contact_id');
    }

    public function mergedContact()
    {
        return $this->belongsTo(Contact::class, 'merged_contact_id');
    }
}
