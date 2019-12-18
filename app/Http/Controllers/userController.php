<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class userController extends Controller
{
    public function index()
    {
    
    	$uzivatele = \App\User::all();
    	return view ('vytvor_uzivatele',compact('uzivatele'));
    }

    public function save()
    {
        
        $user = \App\User::all()->where('email',request()->email)->first();
        if ($user === null) {
            $affected = DB::insert('insert into users (name, email,password, role) values (?, ?, ?, ?)', [request()->nazev,request()->email,Hash::make(request()->heslo), request()->role]);

        }
		
		return redirect()->route('vytvorit_uz');
	}

     public function destroy($project, $user)
    {
        $je_zapsan = \App\User::where('email',auth()->user()->email)->first()->role;

        
        if(strcmp('admin', $je_zapsan)!==0)
        {
            $row = new \App\neopravnenyPristup;
            $row->idproj = $project;
            $row->email = auth()->user()->email;
            $row->detaily = "pokus o smazání uživatele ".$user."z projektu ".$project;
            $row->save();
            
            return redirect()->route('uzivatel_tym')->with('alert', 'Uživatel není admin.\nPokus o přístup byl zaznamenán.');
        }
        $role_mazaneho = \App\userTeam::where('idproj', $project)->where('login', $user)->first()->role;

        if (strcmp('projmanazer', $role_mazaneho)==0)
        {
            return redirect()->route('uzivatel_tym')->with('alert', 'Nelze smazat manažera projektu.');
        }
        DB::table('projekty_a_clenove')->where('login', $user)->where('idproj', $project)->delete();
        return redirect()->route('uzivatel_tym');
    }

    }

