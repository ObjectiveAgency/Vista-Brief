<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
	public function user() 
	{
		return $this->belongsTo('App\User');
	}

	public function brief() 
	{
		return $this->belongsTo('App\Brief');
	}

    public function scopeIsactive($query) {
    	return $query->where('is_active', 1);
    }
}
