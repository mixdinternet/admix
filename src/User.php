<?php

namespace Mixdinternet\Admix;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Venturecraft\Revisionable\RevisionableTrait;
use Mixdinternet\Admix\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable implements StaplerableInterface
{
    use Notifiable, SoftDeletes, EloquentTrait, RevisionableTrait;

    protected $revisionCreationsEnabled = true;

    protected $revisionFormattedFieldNames = [
        'name' => 'nome'
        , 'password' => 'senha'
        , 'image' => 'imagem'
        , 'role_id' => 'grupo'
    ];

    protected $revisionFormattedFields = [
        'password' => 'string:********'
        , 'remember_token' => 'string:********'
    ];

    protected $fillable = [
        'status', 'name', 'email', 'password', 'image', 'role_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function __construct(array $attributes = [])
    {
        $this->hasAttachedFile('image', [
            'styles' => [
                'crop' => function ($file, $imagine) {
                    $image = $imagine->open($file->getRealPath());
                    if (request()->input('crop.image.w') >= 0 && request()->input('crop.image.y') >= 0) {
                        $image->crop(new \Imagine\Image\Point(request()->input('crop.image.x'), request()->input('crop.image.y'))
                            , new \Imagine\Image\Box(request()->input('crop.image.w'), request()->input('crop.image.h')));
                    }
                    return $image;
                }
            ],
            'default_url' => '',
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
        return $this->belongsTo(\Mixdinternet\Admix\Role::class);
    }

    public function getPermissionsAttribute($value)
    {
        return explode(',', $value);
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

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
