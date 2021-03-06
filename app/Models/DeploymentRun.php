<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DeploymentRun extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function deployment(){
        return $this->belongsTo('App\Models\Deployment');
    }
}
