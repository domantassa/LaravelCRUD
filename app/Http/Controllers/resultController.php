<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class resultController extends Controller
{
    public function index()
    {
        $suma = DB::select( "SELECT  SUM(Suma)
        FROM    (
                    SELECT application_order.NAME, application_order.Started_at, application_order.End_term, application_order.Price, COUNT(application_order.NAME) as Kiekis, SUM(application_order.Price) as Suma, CONCAT(client.NAME, ' ', client.Last_name) as client_full_name, CONCAT(software_developer.NAME, ' ', software_developer.Last_name) as developer_full_name
        from application_order
        LEFT JOIN client ON application_order.fk_Clientid_Client = client.id_Client
        INNER JOIN has_application_order ON has_application_order.fk_Application_orderid_Application_order = application_order.id_Application_order
        INNER JOIN software_developer ON software_developer.id_Software_developer = has_application_order.fk_Software_developerid_Software_developer
        WHERE application_order.Started_at >= IFNULL(NULL, application_order.Started_at) AND application_order.End_term <= IFNULL(NULL, application_order.End_term) AND application_order.Price >= IFNULL(NULL, application_order.Price)
        GROUP BY application_order.id_Application_order
        ORDER BY application_order.id_Application_order ASC
                ) tmp");
        dd($suma);
        return view('/office', ['offices' => $offices]);
    }

    public function withFilters()
    {
        $suma = DB::select( "SELECT  SUM(Suma)
        FROM    (
                    SELECT application_order.NAME, application_order.Started_at, application_order.End_term, application_order.Price, COUNT(application_order.NAME) as Kiekis, SUM(application_order.Price) as Suma, CONCAT(client.NAME, ' ', client.Last_name) as client_full_name, CONCAT(software_developer.NAME, ' ', software_developer.Last_name) as developer_full_name
        from application_order
        LEFT JOIN client ON application_order.fk_Clientid_Client = client.id_Client
        INNER JOIN has_application_order ON has_application_order.fk_Application_orderid_Application_order = application_order.id_Application_order
        INNER JOIN software_developer ON software_developer.id_Software_developer = has_application_order.fk_Software_developerid_Software_developer
        WHERE application_order.Started_at >= IFNULL(NULL, application_order.Started_at) AND application_order.End_term <= IFNULL(NULL, application_order.End_term) AND application_order.Price >= IFNULL(NULL, application_order.Price)
        GROUP BY application_order.id_Application_order
        ORDER BY application_order.id_Application_order ASC
                ) tmp");
        dd($suma);
        return view('/office', ['offices' => $offices]);
    }



}
