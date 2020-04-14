<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = DB::select('select * from client');
        return view('/homepage', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $application_orders = DB::select('select * from application_order');
        return view('forms.SFclients', ['application_orders' => $application_orders]);
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
            'Amount_of_orders'=>'required',
        ]);


        $uniqueOrdersId = array_unique($request->application_orders);
        DB::insert('insert into client (NAME, Last_name, Email, Phone, Amount_of_orders) values (?, ?, ?, ?, ?)', [$request->NAME, $request->Last_name, $request->Email, $request->Phone, $request->Amount_of_orders]);

        $id = DB::select('select * from client where NAME = ?', [$request->NAME]);
        
       // $allOrders = DB::select('select * from has_application_order');
        foreach ($uniqueOrdersId as $orderId)
        {
            $order = DB::select('select * from application_order where id_Application_order = ?', [$orderId]);
            DB::insert('insert into application_order (Started_at, End_term, NAME, Price, Development_software, Development_methodology, fk_Clientid_Client) values (?, ?, ?, ?, ?, ?, ?)', [$order[0]->Started_at, $order[0]->End_term, $order[0]->NAME, $order[0]->Price, $order[0]->Development_software, $order[0]->Development_methodology, end($id)->id_Client]);
        }

        return redirect('/')->with('success', 'Contact saved!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = DB::select('select * from client where id_Client = :id', ['id' => $id]);
        return view('forms.SFclientsEdit', ['client' => $client]);
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
            'Amount_of_orders'=>'required',
        ]);
        DB::table('client')
        ->where('id_Client', $id)
        ->update(['NAME' => $request->NAME, 'Last_name' => $request->Last_name, 'Email' => $request->Email, 'Phone' => $request->Phone, 'Amount_of_orders' => $request->Amount_of_orders]);
        return redirect('/')->with('success', 'Client updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('client')->where('id_Client',$id)->delete();
        return redirect('/')->with('success', 'Client deleted!');
    }
}
