<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class projektController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
     
        $proj_vedene = collect(DB::select('select p.idproj, p.nazev, pc.role, pc.login FROM projekty_a_clenove as pc JOIN projekt as p on pc.idproj=p.idproj where pc.role = \'projmanazer\''))->where('login', auth()->user()->email)->values();

        $proj_clen = collect(DB::select('select p.idproj, p.nazev, pc.role, pc.login FROM projekty_a_clenove as pc JOIN projekt as p on pc.idproj=p.idproj where pc.role = \'user\''))->where('login', auth()->user()->email)->values();
        
    	if (is_null($proj_vedene))
    	{
    		$proj_vedene = "žádné projekty";
    	}
        if(is_null($proj_clen))
        {
            $proj_clen = "žádné projekty";
        }
    	return view ('projekt.index', compact('proj_vedene','proj_clen'));
    }

    public function create()
    {
    	$katalog = \App\Katalog::all();

    	return view ('projekt.create', compact('katalog'));
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

        $row = new \App\checklistProjektu;
        $row->idproj = $id_projektu;
        $row->id_oblasti = 1;
        $row->poradi = 1;
         $row->splneno = 0;
          $row->komentar = "";
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
        return redirect()->back();
        return redirect()->route('uzivatel_tym');
    }
    

    
    public function store()
    {

        request()->validate(['nazev'=>'required']);
    	$projekt = new \App\Project();
    	$projekt->nazev = request('nazev');
    	$projekt->popis = request('popis');
    	$projekt->save();
    	
    	
    	$zvolene_atributy = request('result');
    	foreach( $zvolene_atributy as $atri) {
            $polozka_sabl = new \App\PolozkySablony();
           	$polozka_sabl->idproj = $projekt->id;
           	$polozka_sabl->atribut = $atri;
           	$polozka_sabl->save();
         }
 
    	return redirect('/projekt');
    }

    public function destroy($id)
    {


        if(strcmp(Auth::user()->role, 'admin')==0)
        {
            \App\Project::where('idproj',$id)->delete();
            return redirect()->route('uzivatel_tym');
        }
        else
        {
            $row = new \App\neopravnenyPristup;
            $row->idproj = $id;
            $row->email = auth()->user()->email;
            $row->detaily = "pokus o smazani projektu s idproj: ".$id;
            $row->save();
            
            return redirect()->route('proj')->with('alert', 'Uživatel není zapsán k projektu.\nPokus o přístup byl zaznamenán.');
     
        }
     
        
    }

    

}

