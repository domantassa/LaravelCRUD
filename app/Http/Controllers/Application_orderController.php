<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Application_orderController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $application_orders = DB::select('select * from application_order');
        return view('/application-order', ['application_orders' => $application_orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = DB::select('select * from client');
        return view('forms.SFapplication-order', ['clients' => $clients]);
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
            'Started_at'=>'required',
            'End_term'=>'required',
            'NAME'=>'required',
            'Price'=>'required',
            'Development_software'=>'required',
            'Development_methodology'=>'required',
            'fk_Clientid_Client'=>'required',
        ]);
        DB::insert('insert into application_order (Started_at, End_term, NAME, Price, Development_software, Development_methodology, fk_Clientid_Client) values (?, ?, ?, ?, ?, ?, ?)', [$request->Started_at, $request->End_term, $request->NAME, $request->Price, $request->Development_software, $request->Development_methodology, $request->fk_Clientid_Client]);
        return redirect('/application-order')->with('success', 'Record about application order is saved!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $application_order = DB::select('select * from application_order where id_Application_order = :id', ['id' => $id]);
        $clients = DB::select('select * from client');
        return view('forms.SFapplication-orderEdit', ['application_order' => $application_order, 'clients' => $clients]);
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
            'Started_at'=>'required',
            'End_term'=>'required',
            'NAME'=>'required',
            'Price'=>'required',
            'Development_software'=>'required',
            'Development_methodology'=>'required',
            'fk_Clientid_Client'=>'required',
        ]);
        DB::table('application_order')
        ->where('id_Application_order', $id)
        ->update(['Started_at' => $request->Started_at, 'End_term' => $request->End_term, 'NAME' => $request->NAME, 'Price' => $request->Price, 'Development_software' => $request->Development_software, 'Development_methodology' => $request->Development_methodology , 'fk_Clientid_Client' => $request->fk_Clientid_Client]);
        return redirect('/application-order')->with('success', 'Record about application_order updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('application_order')->where('id_Application_order',$id)->delete();
        return redirect('/application-order')->with('success', 'Record about application order deleted!');
    }
}
