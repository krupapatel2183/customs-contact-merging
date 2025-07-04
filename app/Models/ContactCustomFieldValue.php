<?php

namespace App\Models;

use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ContactCustomFieldValue extends Model
{
    use ColumnFillable, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'contact_id',
        'custom_field_id',
        'value',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    // Relationships
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function customField()
    {
        return $this->belongsTo(CustomField::class);
    }
}
