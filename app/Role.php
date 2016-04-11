<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;


class Role extends Model
{
    use SoftDeletes, RevisionableTrait;

    protected $revisionCreationsEnabled = true;

    protected $revisionFormattedFieldNames = [
        'name' => 'nome'
        , 'rules' => 'permissões'
    ];

    protected $dates = ['deleted_at'];

    protected $fillable = ['status', 'name', 'rules'];

    public function getRulesAttribute($value)
    {
        return explode(',', $value);
    }

    public function setRulesAttribute($value)
    {
        $this->attributes['rules'] = implode(',', $value);
    }

    public function scopeSort($query, $fields = [])
    {
        if (count($fields) <= 0) {
            $fields = [
                'roles.status' => 'asc'
            ];
        }

        if (request()->has('field') && request()->has('sort')) {
            $fields = [request()->get('field') => request()->get('sort')];
        }

        $query->select('roles.*');

        foreach ($fields as $field => $order) {
            $query->orderBy($field, $order);
        }
    }

    public function scopeActive($query)
    {
        $query->where('status', 'active')->sort();
    }

    # revision
    public function identifiableName()
    {
        return $this->name;
    }
}
