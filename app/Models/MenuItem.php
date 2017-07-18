<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{

	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    'deleted_at',
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu';
	//SoftDeletes is used to enable soft deletes on this model
	 use SoftDeletes;
	 /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

}