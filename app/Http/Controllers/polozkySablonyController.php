<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class polozkySablonyController extends Controller
{
    public function index()
    {

    	$projects =\App\Project::all();

    	//$projects = Project::lists('nazev', 'popis');
    	if (is_null($projects))
    	{
    		$projects = "nostones";
    	}
    	return view ('polozky_sabl.index', compact('projects'));
    }

    public function insert(Request $request)
    {
        $aut = \App\User::all()->where('email',auth()->user()->email)->where('role', 'admin')->first();
        if( empty($aut))
        {
            $row = new \App\neopravnenyPristup;
            $row->idproj = "0";
            $row->email = auth()->user()->email;
            $row->detaily = "pokus o manipulaci s položkami šablony";
            $row->save();
            
            return redirect()->route('proj')->with('alert', 'Uživatel není admin.\nPokus o přístup byl zaznamenán.');
        }
        $atributy_projektu = \App\PolozkySablony::all()->where('idproj',$request->projekt)->pluck('atribut');
        $vsechny_atributy = \App\Katalog::all()->pluck('atribut');
        $rozdil = $vsechny_atributy->diff($atributy_projektu)->values();
        $pro = $request->projekt;

        $katalog = \App\Katalog::all();
        $projects = \App\Project::all();
        return view('katalog2',compact('katalog','projects','rozdil','pro'));
        
    }

     public function store(Request $request)
    {
        $aut = \App\User::all()->where('email',auth()->user()->email)->where('role', 'admin')->first();
        if( empty($aut))
        {
            $row = new \App\neopravnenyPristup;
            $row->idproj =  "0";
            $row->email = auth()->user()->email;
            $row->detaily = "pokus o manipulaci s položkami šablony";
            $row->save();
            
            return redirect()->route('proj')->with('alert', 'Uživatel není admin.\nPokus o přístup byl zaznamenán.');
        }



        $row = new \App\PolozkySablony;
        $row->idproj =  $request->idproj;
        $row->atribut = $request->role;
        $row->save();


        $rizika_projektu = \App\Rizika::all()->where('idproj',$request->idproj)->values()->pluck('cislor');
        
        foreach ($rizika_projektu as $riz) {
            $row = new \App\PolozkyRiziko;
            $row->idproj =  $request->idproj;
            $row->cislor = $riz;
            $row->atribut = $request->role;
            $row->hodnota = "";
            $row->save();
        }
        
       return redirect()->action('userTeamController@show',  ['project' => $request->idproj])->with('success', 'Uložčeno');
    }

    public function destroy($project, $atribut)
    {   
        $aut = \App\User::all()->where('email',auth()->user()->email)->where('role', 'admin')->first();
        if( empty($aut))
        {
            $row = new \App\neopravnenyPristup;
            $row->idproj =  $project;
            $row->email = auth()->user()->email;
            $row->detaily = "pokus o smazání atributu ze šablony rejstříku rizik";
            $row->save();
            
            return redirect()->route('proj')->with('alert', 'Uživatel není admin.\nPokus o přístup byl zaznamenán.');
        }
        DB::table('polozka_sabl')->where('idproj', $project)->where('atribut', $atribut)->delete();
        return redirect()->action('userTeamController@show',  ['project' => $project]);
       

    }
}









