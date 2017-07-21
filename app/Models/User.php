<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'username','email','first_name','last_name','second_last_name',
            'gender_id','rol_id','store_id','password','status','user_token',    
];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    'password','user_token','deleted_at','gender_id','store_id',
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function gender()
    {
        return $this->belongsTo('App\Models\Description','gender_id');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    //SoftDeletes is used to enable soft deletes on this model
     use SoftDeletes;
     /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

}
