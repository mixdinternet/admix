<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Venturecraft\Revisionable\RevisionableTrait;


class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    StaplerableInterface
{
    use SoftDeletes, Authenticatable, Authorizable, CanResetPassword, EloquentTrait, RevisionableTrait;

    protected $revisionCreationsEnabled = true;

    protected $revisionFormattedFieldNames = [
        'name' => 'nome'
        , 'password' => 'senha'
        , 'image' => 'imagem'
        , 'role_id' => 'grupo'
    ];

    protected $revisionFormattedFields = [
        'password' => 'string:********',
    ];

    protected $dates = ['deleted_at'];

    protected $fillable = ['status', 'name', 'email', 'password', 'image', 'role_id'];

    protected $hidden = ['password', 'remember_token'];

    public function __construct(array $attributes = array())
    {
        $this->hasAttachedFile('image', [
            'styles' => [
                'crop' => function ($file, $imagine) {
                    $image = $imagine->open($file->getRealPath());
                    $image->crop(new \Imagine\Image\Point(request()->input('crop.image.x'), request()->input('crop.image.y'))
                        , new \Imagine\Image\Box(request()->input('crop.image.w'), request()->input('crop.image.h')));

                    return $image;
                }
            ],
            'default_url' => '/assets/img/avatar.png',
        ]);

        parent::__construct($attributes);
    }

    public static function boot()
    {
        parent::boot();

        static::bootStapler();
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function getPermissionsAttribute($value)
    {
        return explode(',', $value);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setPermissionsAttribute($value)
    {
        $this->attributes['permissions'] = implode(',', $value);
    }

    public function scopeSort($query, $fields = [])
    {
        if (count($fields) <= 0) {
            $fields = [
                'users.status' => 'asc'
            ];
        }

        if (request()->has('field') && request()->has('sort')) {
            $fields = [request()->get('field') => request()->get('sort')];
        }

        $query->select('users.*');

        foreach ($fields as $field => $order) {
            $query->orderBy($field, $order);
        }
    }

    public function scopeActive($query)
    {
        $query->where('status', 'active')->sort();
    }
}
