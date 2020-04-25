<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = DB::select('select * from city');
        return view('/city', ['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.SFcity');
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
            'Number_of_residents'=>'required',
            'Area_square_km'=>'required',
            'NAME'=>'required',
            'Mayor'=>'required',
            'Country'=>'required',
        ]);
        if($request->Has_bussiness_center == null)
            $BussCenter = 0;
        else
            $BussCenter = 1;
        DB::insert('insert into city (Number_of_residents, Area_square_km, NAME, Mayor, Has_bussiness_center, Country) values (?, ?, ?, ?, ?, ?)', [$request->Number_of_residents, $request->Area_square_km, $request->NAME, $request->Mayor, $BussCenter, $request->Country]);
        return redirect('/city')->with('success', 'Record about city saved!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = DB::select('select * from city where id_City = :id', ['id' => $id]);
        return view('forms.SFcityEdit', ['city' => $city]);
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
            'Number_of_residents'=>'required',
            'Area_square_km'=>'required',
            'NAME'=>'required',
            'Mayor'=>'required',
            
            'Country'=>'required',
        ]);
        if($request->Has_bussiness_center == null)
            $BussCenter = 0;
        else
            $BussCenter = 1;
        
        DB::update('update city set Number_of_residents = ?, Area_square_km = ?, NAME = ?, Mayor = ?, Has_bussiness_center = ?, Country = ? where id_City = ?', [$request->Number_of_residents, $request->Area_square_km, $request->NAME, $request->Mayor, $BussCenter, $request->Country, $id]);
        return redirect('/city')->with('success', 'Record about city updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('delete from city where id_City = ?', [$id]);
        return redirect('/city')->with('success', 'Record about city deleted!');
    }
}

