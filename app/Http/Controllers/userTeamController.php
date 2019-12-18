<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class userTeamController extends Controller
{

    public function index()
    {   
       // return "Lol";
        $vsichni_users = \App\User::all()->where('role','user');
        $projektaci = \App\User::all()->where('role','projmanazer');
        $katalog = \App\Katalog::all();
        $stara= "lol123T4534";
        $uziv_proj = \App\UserTeam::all();
        $uzivatele = \App\User::all();
        $uz=collect(DB::select('SELECT projekt.idproj, projekt.nazev, projekt.popis, users.name,users.email, projekty_a_clenove.role  FROM projekty_a_clenove INNER JOIN users ON projekty_a_clenove.login=users.email INNER JOIN projekt ON projekty_a_clenove.idproj=projekt.idproj ORDER BY projekt.idproj,projekty_a_clenove.role '))->where('role','projmanazer')->values();

  
        //return $uz;
        return view ('projekt_clenove2',compact('uz','vsichni_users','projektaci','katalog','stara'));
    }

    public function show($id)
    {
        $je_zapsan = \App\User::where('email',auth()->user()->email)->first()->role;
        
        if( strcmp('admin', $je_zapsan)!==0)
        {
            $row = new \App\neopravnenyPristup;
            $row->idproj = $id;
            $row->email = auth()->user()->email;
            $row->detaily = "pokus o přístup do detailu projektu";
            $row->save();
            
            return redirect()->route('uzivatel_tym') ->with('alert', 'Uživatel není zapsán k projektu.\nPokus o přístup byl zaznamenán.');
        }
        $projektaci = \App\User::all()->where('role','projmanazer');
        $detaily_projektu = \App\Project::all()->where('idproj', $id)->first();
        $tym = collect(DB::select('select u.name, u.email, pc.role, pc.idproj from users as u LEFT JOIN projekty_a_clenove as pc ON pc.login=u.email'))->where('idproj', $id)->where('role', 'user')->pluck('name','email');

        
        //return $tym;
        $manazer = \App\userTeam::all()->where('idproj', $id)->where('role','projmanazer')->first()->login;
        $man_name = \App\User::all()->where('email', $manazer)->first();
        //return $man_name;
        $nazev_projektu = \App\Project::where('idproj', $id);
        $nazev_proj = $nazev_projektu->get()->first()->nazev;


        // pridavani clena do tymu
        $clenove = \App\User::all()->where('role','user')->values()->pluck('name','email');
        $clenove_projektu = collect(DB::select('SELECT users.name,users.email,pc.idproj FROM projekty_a_clenove as pc INNER JOIN users ON pc.login=users.email'))->where('idproj',$id)->pluck('name','email');
        $mozni_clenove = $clenove->diff($clenove_projektu);
        //return $mozni_clenove;

        $projekty = \App\Project::all();

        $sablona = \App\PolozkySablony::where('idproj',$id)->pluck('atribut');

        $vsechny_atributy = \App\Katalog::all()->pluck('atribut');
        $mozne_atributy = $vsechny_atributy->diff($sablona);
        
        return view ('detail_projektu', compact('detaily_projektu','tym','man_name','nazev_proj','clenove','projekty','mozni_clenove','projektaci','sablona','mozne_atributy'));
    }

    public function insert(Request $request, $id)
    {
        
        $je_zapsan = \App\User::where('email',auth()->user()->email)->first()->role;
        
        if( strcmp('admin', $je_zapsan)!==0)
        {
            $row = new \App\neopravnenyPristup;
            $row->idproj = $id;
            $row->email = auth()->user()->email;
            $row->detaily = "pokus o přístup do detailu projektu";
            $row->save();
            
            return redirect()->route('uzivatel_tym') ->with('alert', 'Uživatel není zapsán k projektu.\nPokus o přístup byl zaznamenán.');
        }
    // vlozeni noveho clena
        $clen = new \App\userTeam;
        $clen->idproj = $id;
        $clen->login = $request->clen;
        $clen->role = 'user';
        $clen->save();

        $projektaci = \App\User::all()->where('role','projmanazer');
        $detaily_projektu = \App\Project::all()->where('idproj', $id)->first();
        $tym = collect(DB::select('select u.name, u.email, pc.role, pc.idproj from users as u LEFT JOIN projekty_a_clenove as pc ON pc.login=u.email'))->where('idproj', $id)->where('role', 'user')->pluck('name','email');
        
        //return $tym;
        $manazer = \App\userTeam::all()->where('idproj', $id)->where('role','projmanazer')->first()->login;
        $man_name = \App\User::all()->where('email', $manazer)->first();
        
        $nazev_projektu = \App\Project::where('idproj', $id);
        $nazev_proj = $nazev_projektu->get()->first()->nazev;

        $sablona = \App\PolozkySablony::where('idproj',$id)->pluck('atribut');

        $vsechny_atributy = \App\Katalog::all()->pluck('atribut');
        $mozne_atributy = $vsechny_atributy->diff($sablona);
        // pridavani clena do tymu
        $clenove = \App\User::all()->where('role','user')->values()->pluck('name','email');
        $clenove_projektu = collect(DB::select('SELECT users.name,users.email,pc.idproj FROM projekty_a_clenove as pc INNER JOIN users ON pc.login=users.email'))->where('idproj',$id)->pluck('name','email');
        $mozni_clenove = $clenove->diff($clenove_projektu);
        $projekty = \App\Project::all();

 


         return view ('detail_projektu', compact('detaily_projektu','tym','man_name','nazev_proj','clenove','projekty','mozni_clenove','projektaci','sablona','mozne_atributy'));
    }

    public function delete($project, $user)
    {
        //return $user;
        $je_zapsan = \App\User::where('email',auth()->user()->email)->first()->role;
        
        if( strcmp('admin', $je_zapsan)!==0)
        {
            $row = new \App\neopravnenyPristup;
            $row->idproj = $project;
            $row->email = auth()->user()->email;
            $row->detaily = "pokus o smazaní uživatele z projektu";
            $row->save();
            
            return redirect()->route('uzivatel_tym') ->with('alert', 'Uživatel není zapsán k projektu.\nPokus o přístup byl zaznamenán.');
        }

        // smazani uzivatele 
        $deletedRows = \App\userTeam::where('idproj', $project)->where('login',$user)->delete();


        // rest
        $projektaci = \App\User::all()->where('role','projmanazer');
        $detaily_projektu = \App\Project::all()->where('idproj', $project)->first();
        $tym = collect(DB::select('select u.name, u.email, pc.role, pc.idproj from users as u LEFT JOIN projekty_a_clenove as pc ON pc.login=u.email'))->where('idproj', $project)->where('role', 'user')->pluck('name','email');
        
        //return $tym;
        $manazer = \App\userTeam::all()->where('idproj', $project)->where('role','projmanazer')->first()->login;
        $man_name = \App\User::all()->where('email', $manazer)->first();
        
        $nazev_projektu = \App\Project::where('idproj', $project);
        $nazev_proj = $nazev_projektu->get()->first()->nazev;


        // pridavani clena do tymu
        $clenove = \App\User::all()->where('role','user')->values()->pluck('name','email');
        $clenove_projektu = collect(DB::select('SELECT users.name, users.email,pc.idproj FROM projekty_a_clenove as pc INNER JOIN users ON pc.login=users.email'))->where('idproj',$project)->pluck('name','email');
        $mozni_clenove = $clenove->diff($clenove_projektu);
        $projekty = \App\Project::all();

        $sablona = \App\PolozkySablony::where('idproj',$project)->pluck('atribut');

        $vsechny_atributy = \App\Katalog::all()->pluck('atribut');
        $mozne_atributy = $vsechny_atributy->diff($sablona);
        return view ('detail_projektu', compact('detaily_projektu','tym','man_name','nazev_proj','clenove','projekty','mozni_clenove','projektaci','sablona','mozne_atributy'));

    }

    public function save()
    {
        
        $proj = new \App\Project;
        $proj->nazev = request()->nazev;
        $proj->popis = request()->popis;
        $proj->save();
        $id_projektu = $proj->id;

        $row = new \App\userTeam;
        $row->idproj = $id_projektu;
        $row->login = request()->role;
        $row->role = 'projmanazer';
        $row->save();

        $row = new \App\SWOT;
        $row->idproj = $id_projektu;
        $row->strengths = '';
        $row->weak = '';
        $row->opport = '';
        $row->threats = '';
        $row->save();


        if(request()->filled('clenove'))
        {
        $clenove = request()->clenove;
        foreach ($clenove as $clen) {
            $row = new \App\userTeam;
            $row->idproj = $id_projektu;
            $row->login = $clen;
            
            $row->role = 'user';
            $row->save();
        }
        }
        
        $zvolene_atributy = request('result');
        
        foreach( $zvolene_atributy as $atri) {
            $polozka_sabl = new \App\PolozkySablony();
            $polozka_sabl->idproj = $id_projektu;
            $polozka_sabl->atribut = $atri;
            $polozka_sabl->save();
         }
        
        return redirect()->route('uzivatel_tym');
    }

    public function destroy()
    {   

        DB::table('users')->where('email', request()->smazanej)->delete();
        return redirect()->route('vytvorit_uz');
    
    }

   public function update_manager(Request $request)
   {
   // return $request;
    $id=$request->idproj;
    $je_zapsan = \App\User::where('email',auth()->user()->email)->first()->role;
        
        if( strcmp('admin', $je_zapsan)!==0)
        {
            $row = new \App\neopravnenyPristup;
            $row->idproj = $request->idproj;
            $row->email = auth()->user()->email;
            $row->detaily = "pokus o změnu proj. manazera";
            $row->save();
            
            return redirect()->route('uzivatel_tym') ->with('alert', 'Uživatel není zapsán k projektu.\nPokus o přístup byl zaznamenán.');
        }

    $project = $request->idproj;
   $affected = DB::update('update projekty_a_clenove set login = ? where idproj = ? and login = ? ', [$request->manager, $request->idproj, $request->old_man]);
   
    

     $projektaci = \App\User::all()->where('role','projmanazer');
        $detaily_projektu = \App\Project::all()->where('idproj', $project)->first();
        $tym = collect(DB::select('select u.name, u.email, pc.role, pc.idproj from users as u LEFT JOIN projekty_a_clenove as pc ON pc.login=u.email'))->where('idproj', $project)->where('role', 'user')->pluck('name','email');
        
        //return $tym;
        $manazer = \App\userTeam::all()->where('idproj', $project)->where('role','projmanazer')->first()->login;
        $man_name = \App\User::all()->where('email', $manazer)->first();
        
        $nazev_projektu = \App\Project::where('idproj', $project);
        $nazev_proj = $nazev_projektu->get()->first()->nazev;


        // pridavani clena do tymu
        $clenove = \App\User::all()->where('role','user')->values()->pluck('name','email');
        $clenove_projektu = collect(DB::select('SELECT users.name, users.email,pc.idproj FROM projekty_a_clenove as pc INNER JOIN users ON pc.login=users.email'))->where('idproj',$project)->pluck('name','email');
        $mozni_clenove = $clenove->diff($clenove_projektu);
        $projekty = \App\Project::all();
        $sablona = \App\PolozkySablony::where('idproj',$id)->pluck('atribut');

        $vsechny_atributy = \App\Katalog::all()->pluck('atribut');
        $mozne_atributy = $vsechny_atributy->diff($sablona);

        return view ('detail_projektu', compact('detaily_projektu','tym','man_name','nazev_proj','clenove','projekty','mozni_clenove','projektaci','sablona','mozne_atributy'));
   }
}












