<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;

class neopravnenyPristup extends Controller
{
	protected function admin ()
    {
      $je_zapsan = \App\User::where('email',auth()->user()->email)->where('role','admin')->first();
        
        if( empty($je_zapsan))
        {
            $row = new \App\neopravnenyPristup;
            $row->idproj = "";
            $row->email = auth()->user()->email;
            $row->detaily = "pokus o zobrazení této tabulky";
            $row->save();
            return true;
            
        }
        return false;
    }
    public function index()
    {
    	if(self::admin())
    	{
    		return redirect()->route('proj') ->with('alert', 'Uživatel není administrátor.\nPokus o přístup byl zaznamenán.');
    	}
    	$tab = collect(DB::select('select p.nazev, p.idproj, n.email, n.detaily, n.created_at from neopravneny_pristup as n LEFT JOIN projekt as p ON p.idproj = n.idproj'));
    	//return $tab;
    	return view ('neop', compact('tab'));
    }
}
