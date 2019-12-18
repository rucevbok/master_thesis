<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PolozkySablony extends Model
{
    protected $table = 'polozka_sabl';
   
	public function polozky_riziko()
    {
        return $this->hasMany('\App\PolozkyRiziko');
    }
}
