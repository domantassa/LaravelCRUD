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
        DB::update('update client set NAME = ?, Last_name = ?, Email = ?, Phone = ?, Amount_of_orders = ? where id_Client = ?', [$request->NAME, $request->Last_name, $request->Email, $request->Phone, $request->Amount_of_orders, $id]);
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
        
        DB::delete('delete from web_application_order where fk_Clientid_Client = ?', [$id]);
        DB::delete('delete from graphical_design_order where fk_Clientid_Client = ?', [$id]);
        DB::delete('delete from application_order where fk_Clientid_Client = ?', [$id]);
        DB::delete('delete from client where id_Client = ?', [$id]);
        return redirect('/')->with('success', 'Client deleted!');
    }

    public function results()
    {
        return view('forms.ResultForm');
    }

    public function resultsData(Request $request)
    {
        $request->validate([
            'Started_at'=>'required',
            'End_term'=>'required',
            'minPrice'=>'required',
        ]);

        $suma = DB::select( "SELECT  SUM(Suma) as Suma, SUM(Kiekis) as Kiekis
        FROM    (
                    SELECT application_order.NAME, application_order.Started_at, application_order.End_term, application_order.Price, COUNT(application_order.NAME) as Kiekis, SUM(application_order.Price) as Suma, CONCAT(client.NAME, ' ', client.Last_name) as client_full_name, CONCAT(software_developer.NAME, ' ', software_developer.Last_name) as developer_full_name
        from application_order
        LEFT JOIN client ON application_order.fk_Clientid_Client = client.id_Client
        INNER JOIN has_application_order ON has_application_order.fk_Application_orderid_Application_order = application_order.id_Application_order
        INNER JOIN software_developer ON software_developer.id_Software_developer = has_application_order.fk_Software_developerid_Software_developer
        WHERE application_order.Started_at >= IFNULL('$request->Started_at', application_order.Started_at) AND application_order.End_term <= IFNULL('$request->End_term', application_order.End_term) AND application_order.Price >= IFNULL($request->minPrice, application_order.Price)
        GROUP BY application_order.id_Application_order
        ORDER BY application_order.id_Application_order ASC
                ) tmp");

        $result = DB::select( "SELECT application_order.NAME, application_order.Started_at, application_order.End_term, application_order.Price, 1 as Kiekis, SUM(application_order.Price) as Suma, CONCAT(client.NAME, ' ', client.Last_name) as client_full_name, CONCAT(software_developer.NAME, ' ', software_developer.Last_name) as developer_full_name
        from application_order
        LEFT JOIN client ON application_order.fk_Clientid_Client = client.id_Client
        INNER JOIN has_application_order ON has_application_order.fk_Application_orderid_Application_order = application_order.id_Application_order
        INNER JOIN software_developer ON software_developer.id_Software_developer = has_application_order.fk_Software_developerid_Software_developer
        WHERE application_order.Started_at >= IFNULL('$request->Started_at', application_order.Started_at) AND application_order.End_term <= IFNULL('$request->End_term', application_order.End_term) AND application_order.Price >= IFNULL($request->minPrice, application_order.Price)
        GROUP BY application_order.id_Application_order
        ORDER BY client.NAME ASC");

        $partData = DB::select( "SELECT COUNT(application_order.NAME) as Kiekis, SUM(application_order.Price) as Suma, CONCAT(client.NAME, ' ', client.Last_name) as client_full_name
        from application_order
        LEFT JOIN client ON application_order.fk_Clientid_Client = client.id_Client
        INNER JOIN has_application_order ON has_application_order.fk_Application_orderid_Application_order = application_order.id_Application_order
        INNER JOIN software_developer ON software_developer.id_Software_developer = has_application_order.fk_Software_developerid_Software_developer
        WHERE application_order.Started_at >= IFNULL('$request->Started_at', application_order.Started_at) AND application_order.End_term <= IFNULL('$request->End_term', application_order.End_term) AND application_order.Price >= IFNULL($request->minPrice, application_order.Price)
        GROUP BY client.NAME
        ORDER BY client.NAME ASC");

        return view('results/data', ['result' => $result, 'partData' => $partData, 'suma' => $suma]);
        

    }
}
