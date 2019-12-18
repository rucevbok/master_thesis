<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rizika extends Model
{
    protected $table = 'riziko';
	public function polozky_riziko()
    {
        return $this->hasMany('\App\PolozkyRiziko');
    }

}
