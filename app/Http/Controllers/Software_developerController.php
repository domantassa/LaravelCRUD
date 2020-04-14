<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Software_developerController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $software_developers = DB::select('select * from software_developer');
        return view('/software-developer', ['software_developers' => $software_developers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $offices = DB::select('select * from office');
        $application_orders = DB::select('select * from application_order');
        return view('forms.SFsoftware-developers', ['offices' => $offices, 'application_orders' => $application_orders]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'NAME'=>'required',
            'Last_name'=>'required',
            'Email'=>'required',
            'Phone'=>'required',
            'Experience'=>'required',
            'Best_known_language'=>'required',
            'fk_Officeid_Office'=>'required',
        ]);

        $uniqueOrders = array_unique($request->application_orders);

        DB::insert('insert into software_developer (NAME, Last_name, Email, Phone, Experience, Best_known_language, fk_Officeid_Office) values (?, ?, ?, ?, ?, ?, ?)', [$request->NAME, $request->Last_name, $request->Email, $request->Phone, $request->Experience, $request->Best_known_language, $request->fk_Officeid_Office]);

        $id = DB::select('select * from software_developer where NAME = ?', [$request->NAME]);
        
        $allOrders = DB::select('select * from has_application_order');
        foreach ($uniqueOrders as $order)
        {
            foreach ($allOrders as $oneOrder)
            {
                if(end($id)->id_Software_developer == $oneOrder->fk_Software_developerid_Software_developer && $order == $oneOrder->fk_Application_orderid_Application_order)
                    continue 2;

            }
            DB::insert('insert into has_application_order (fk_Software_developerid_Software_developer, fk_Application_orderid_Application_order) values (?, ?)', [end($id)->id_Software_developer, $order]);
        }
        
        return redirect('/software-developer')->with('success', 'Software developer saved!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offices = DB::select('select * from office');
        $software_developer = DB::select('select * from software_developer where id_Software_developer = :id', ['id' => $id]);
        return view('forms.SFsoftware-developersEdit', ['software_developer' => $software_developer, 'offices' => $offices]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'NAME'=>'required',
            'Last_name'=>'required',
            'Email'=>'required',
            'Phone'=>'required',
            'Experience'=>'required',
            'Best_known_language'=>'required',
            'fk_Officeid_Office'=>'required',
        ]);
        DB::table('software_developer')
        ->where('id_Software_developer', $id)
        ->update(['NAME' => $request->NAME, 'Last_name' => $request->Last_name, 'Email' => $request->Email, 'Phone' => $request->Phone, 'Experience' => $request->Experience, 'Best_known_language' => $request->Best_known_language, 'fk_Officeid_Office' => $request->fk_Officeid_Office]);
        return redirect('/software-developer')->with('success', 'Software developer updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('has_application_order')->where('fk_Software_developerid_Software_developer',$id)->delete();
        DB::table('software_developer')->where('id_Software_developer',$id)->delete();
        return redirect('/software-developer')->with('success', 'Software developer deleted!');
    }
}
