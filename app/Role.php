<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'name', 'rules'];

    public function getRulesAttribute($value)
    {
        return explode(',', $value);
    }

    public function setRulesAttribute($value)
    {
        $this->attributes['rules'] = implode(',', $value);
    }

    public function scopeSort($query)
    {
        $query->orderBy('status', 'asc')
            ->orderBy('name', 'asc');
    }

    public function scopeActive($query)
    {
        $query->where('status', 'active')->sort();
    }
}
