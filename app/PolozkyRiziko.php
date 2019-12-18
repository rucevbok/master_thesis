<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PolozkyRiziko extends Model
{
    protected $table = 'polozka_riziko';
	protected $fillable = array('hodnota');
    public function polozka_sabl()
    {
        return $this->belongsTo('\App\PolozkySablony');
    }

    public function polozky_riz()
    {
        return $this->belongsTo('\App\PolozkyRiziko');
    }

}
