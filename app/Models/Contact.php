<?php

namespace App\Models;

use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Contact extends Model
{
    use ColumnFillable, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    // Relationships
    public function customFieldValues()
    {
        return $this->hasMany(ContactCustomFieldValue::class, 'contact_id')->with('customField');
    }

    public function masterContact()
    {
        return $this->belongsTo(Contact::class, 'merged_into');
    }

    public function mergedContacts()
    {
        return $this->hasMany(MergedContact::class, 'master_contact_id');
    }

    public static function fetchList($search = array(), $orderBy = array(), $pagination = array(), $firstRecordOnly = false)
    {
        $contact = self::getPrepareQuery($search, $orderBy, $pagination);

         return $firstRecordOnly ? $contact->first() : $contact->get();
    }

    public static function getPrepareQuery($search = array(), $orderBy = array(), $pagination = array()){
        $contact = Contact::with('customFieldValues')
        // ->whereNull('merged_into')
        ->where(function($q) use($search){
            if(isset($search) && count($search)>0){
                foreach($search as $search_key => $search_value){
                    if(is_array($search_value)){
                        $q->WHEREIN($search_key,$search_value);
                    } else if (str_contains($search_value, '%')) {
                        $q->where($search_key, 'LIKE', $search_value);
                    } else{
                        $q->WHERE($search_key,'=',$search_value);
                    }
                }
            }
        });

        // Apply orderBy
        if (!empty($orderBy)) {
            foreach ($orderBy as $column => $direction) {
                $contact->orderBy($column, $direction);
            }
        } else {
            $contact->orderBy('created_at', 'desc');
        }

        if (isset($pagination['limit'])) {
            $contact->limit($pagination['limit']);
        }

        if (isset($pagination['offset'])) {
            $contact->offset($pagination['offset']);
        }

        return $contact;
    }
}
