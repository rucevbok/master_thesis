<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class rejstrikController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
		$nazvy_projektu = collect(DB::select('select p.idproj, p.nazev, pc.login, pc.role FROM projekt as p JOIN projekty_a_clenove as pc on pc.idproj=p.idproj'))->where('login', auth()->user()->email)->values();

        return view ('projekt.rejstrikedit', compact('nazvy_projektu'));
    }
    public function show($id)
    {
    	$je_zapsan = \App\UserTeam::where('idproj',$id)->where('login',auth()->user()->email)->first();
    	//return $je_zapsan;
    	if( empty($je_zapsan))
    	{
    		$row = new \App\neopravnenyPristup;
	        $row->idproj = $id;
	        $row->email = auth()->user()->email;
	        $row->detaily = "pokus o přístup do rejstříku rizik";
	        $row->save();
    		
    		return redirect()->route('uprav') ->with('alert', 'Uživatel není zapsán k projektu.\nPokus o přístup byl zaznamenán.');
    	}
    	$nazvy_projektu = collect(DB::select('select p.idproj, p.nazev, pc.login, pc.role FROM projekt as p JOIN projekty_a_clenove as pc on pc.idproj=p.idproj'))->where('login', auth()->user()->email)->values();

		$rizika_projektu = \App\Rizika::where('idproj',$id)->get();
		$id_proj = $id;
		
    	return view ('projekt.rsop2', compact('nazvy_projektu','rizika_projektu','id_proj'));
    }
	public function update($project, $cislor)
	{
		$nazvy_projektu = collect(DB::select('select p.idproj, p.nazev, pc.login, pc.role FROM projekt as p JOIN projekty_a_clenove as pc on pc.idproj=p.idproj'))->where('login', auth()->user()->email)->values();

		$rizika_projektu = \App\Rizika::where('idproj',$project)->get();

		$podrobnosti_riziko = \App\PolozkyRiziko::where('idproj',$project)->where('cislor', $cislor)->get();

		$clenove_projektu = \App\userTeam::where('idproj',$project)->get();
		$success=false;

		$je_dopad = \App\PolozkyRiziko::where('idproj',$project)->where('cislor', $cislor)->get()->contains('atribut','Dopad');
		$je_pst = \App\PolozkyRiziko::where('idproj',$project)->where('cislor', $cislor)->get()->contains('atribut','Pravděpodobnost');
		if($je_pst)
		{
			$pst_val = \App\PolozkyRiziko::where('idproj',$project)->where('cislor', $cislor)->where('atribut','Pravděpodobnost')->get();
			$pst_val = $pst_val->first()->hodnota;
		}
		if($je_dopad)
		{
			$dopad_val = \App\PolozkyRiziko::where('idproj',$project)->where('cislor', $cislor)->where('atribut','Dopad')->get();
			$dopad_val = $dopad_val->first()->hodnota;
		}

		$id_proj = $project;
		return view ('projekt.rsop3', compact('nazvy_projektu','rizika_projektu','podrobnosti_riziko','success','clenove_projektu','pst_val','dopad_val','id_proj'));

	}
	public function store($project, $cislor)
	{
		//return request();
		$id_proj=$project;
		foreach (request()->except('_token') as $key => $part) {

			if ($key!='_method')
			{
				if ($key!='_token')
				{
				
				$key = str_replace('_',' ', $key);

				$affected = DB::update('update polozka_riziko set hodnota = ? where idproj = ? and cislor = ? and atribut = ?', [$part, $project, $cislor,$key]);

				}
			}

	}
		$nazvy_projektu =collect(DB::select('select p.idproj, p.nazev, pc.login, pc.role FROM projekt as p JOIN projekty_a_clenove as pc on pc.idproj=p.idproj'))->where('login', auth()->user()->email)->values();

		$rizika_projektu = \App\Rizika::where('idproj',$project)->get();

		$podrobnosti_riziko = \App\PolozkyRiziko::where('idproj',$project)->where('cislor', $cislor)->get();

		$clenove_projektu = \App\userTeam::where('idproj',$project)->get();

		$je_dopad = \App\PolozkyRiziko::where('idproj',$project)->where('cislor', $cislor)->get()->contains('atribut','Dopad');
		$je_pst = \App\PolozkyRiziko::where('idproj',$project)->where('cislor', $cislor)->get()->contains('atribut','Pravděpodobnost');
		if($je_pst)
		{
			$pst_val = \App\PolozkyRiziko::where('idproj',$project)->where('cislor', $cislor)->where('atribut','Pravděpodobnost')->get();
			$pst_val= $pst_val->first()->hodnota;
		}
		if($je_dopad)
		{
			$dopad_val = \App\PolozkyRiziko::where('idproj',$project)->where('cislor', $cislor)->where('atribut','Dopad')->get();
			$dopad_val= $dopad_val->first()->hodnota;
		}
		$success=true;
		return view ('projekt.rsop3', compact('nazvy_projektu','rizika_projektu','podrobnosti_riziko','success','clenove_projektu','pst_val','dopad_val','id_proj'));
	}

	public function create($id)
	{
		$nazev_projektu = \App\Project::where('idproj',$id)->get()->first();
		$rizika_projektu = \App\Rizika::where('idproj',$id)->get();
		$sablona = \App\PolozkySablony::where('idproj', $id)->get();
		$clenove_projektu = \App\userTeam::where('idproj', $id)->get();
		$kategorie = ['1','2','3','4','5'];

		return view('projekt.risk_create',compact('nazev_projektu', 'rizika_projektu','sablona','kategorie','clenove_projektu'));

	}


	public function save_risk($project)
	{
		//$nazev_projektu = \App\Project::where('idproj',$id)->get()->first();
		//$rizika_projektu = \App\Rizika::where('idproj',$id)->get();
		//$sablona = \App\PolozkySablony::where('idproj', $id)->get();
		$cislo_posl_rizika = \App\Rizika::where('idproj',$project)->get();
		$cislo = $cislo_posl_rizika->max('cislor')+1;
		$vlozeno = DB::insert('insert into riziko (idproj, cislor, nazev_rizika) values (?, ?, ?)', [$project, $cislo, request()->nazev]);
		foreach (request()->except('_token','_method','nazev') as $key => $part) {
  // $key gives you the key. 2 and 7 in your case.
			
				
				$key = str_replace('_',' ', $key);
			    if(strcmp($key,('dopad'))==0)
			    	$part++;
			    
			    else if(strcmp($key,('pravdepodobnost'))==0)
			    	$part++;

			    $vlozeno = DB::insert('insert into polozka_riziko (idproj, cislor, atribut, hodnota) values (?, ?, ?, ?)', [$project, $cislo, $key, $part ]);
			    
				//$updated_risk = \App\PolozkyRiziko::where('idproj', $project)->where('cislor', $cislor)->where('atribut',$new_key)->first()->update(['hodnota' => request()->$new_key]);
				//$affected = DB::update('update polozka_riziko set hodnota = ? where idproj = ? and cislor = ? and atribut = ?', [$part, $project, $cislor,$key]);
				//$updated_risk->hodnota = request()->$new_key;
				//$updated_risk->save();
			
				//echo (str_replace("_"," ",$key));
				//echo "<br>";
				}
			
			
			//echo request()->$key;
			//echo "<br>";
	

		$nazvy_projektu = collect(DB::select('select p.idproj, p.nazev, pc.login, pc.role FROM projekt as p JOIN projekty_a_clenove as pc on pc.idproj=p.idproj'))->where('login', auth()->user()->email)->values();

		$rizika_projektu = \App\Rizika::where('idproj',$project)->get();
		$id_proj = $project;
		
    	return view ('projekt.rsop2', compact('nazvy_projektu','rizika_projektu','id_proj'));

	}
	public function mapa_rizik($project)
	{
		return veiw('mapa_rizik');
	}








}
