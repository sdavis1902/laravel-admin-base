<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Task extends Model {

    use SoftDeletes;
	use Searchable;

    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function project(){
        return $this->belongsTo('App\Models\Project');
    }

    public function state(){
        return $this->belongsTo('App\Models\TaskState');
    }

	public function comments(){
		return $this->hasMany('App\Models\TaskComment');
	}

	public function files(){
		return $this->hasMany('App\Models\TaskFile');
	}
}
