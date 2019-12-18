<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class katalogController extends Controller
{
    public function index()
    {
    	$katalog = \App\Katalog::all();
        $projects = \App\Project::all();
    	return view('katalog',compact('katalog','projects'));
    }

	public function insert()
    {
    	
    	$vlozeno = DB::insert('insert into katalog (atribut, popis) values (?, ?)', [request()->atribut, request()->popis]);
   		$katalog = \App\Katalog::all();
    	return view('katalog',compact('katalog'));
    }
    public function destroy()
    {
        $obsahuje = \App\PolozkySablony::where('atribut', request()->smazanej)->first();
        if($obsahuje==null)
        {
            \App\Katalog::where('atribut',request()->smazanej)->delete();
            return redirect()->route('katalog')->with('alert', 'Smazáno');
        }
        else
        {
            return redirect()->route('katalog')->with('alert', 'Nelze smazat, položka je přítomna v některém z rejstříku rizik.');
            
        }
        return $obsahuje;

    }
}
