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

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    StaplerableInterface
{
    use SoftDeletes, Authenticatable, Authorizable, CanResetPassword, EloquentTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'name', 'email', 'password', 'image', 'role_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function __construct(array $attributes = array())
    {
        $this->hasAttachedFile('image', [
            'styles' => [
                'crop' => function($file, $imagine) {
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

    /*public static function boot()
    {
        // Call the bootStapler() method to register stapler as an observer for this model.
        static::bootStapler();

        // Now, before the record is saved, set the filename attribute on the model:
        static::saving(function($model)
        {
            $pathInfo = pathinfo($model->image->originalFileName());
            $newFilename = str_slug($pathInfo['filename'], '-') . '.' . $pathInfo['extension'];
            #dd($newFilename);
            $model->image->instanceWrite('file_name', $newFilename);
        });
    }*/

    public function role()
    {
        return $this->belongsTo('\App\Role');
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

    public function scopeSort($query)
    {
        $query->oldest('status');
    }

    public function scopeActive($query)
    {
        $query->where('status', 'active')->sort();
    }
}
