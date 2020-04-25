<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficeController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = DB::select('select * from office');
        return view('/office', ['offices' => $offices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = DB::select('select * from city');
        return view('forms.SFoffice', ['cities' => $cities]);
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
            'Address'=>'required',
            'Population'=>'required',
            'Establishment_year'=>'required',
            'fk_Cityid_City'=>'required',
        ]);
        DB::insert('insert into office (NAME, Address, Population, Establishment_year, fk_Cityid_City) values (?, ?, ?, ?, ?)', [$request->NAME, $request->Address, $request->Population, $request->Establishment_year, $request->fk_Cityid_City]);
        return redirect('/office')->with('success', 'Record about office saved!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $office = DB::select('select * from office where id_Office = :id', ['id' => $id]);
        $cities = DB::select('select * from city');
        return view('forms.SFofficeEdit', ['office' => $office, 'cities' => $cities]);
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
            'Address'=>'required',
            'Population'=>'required',
            'Establishment_year'=>'required',
            'fk_Cityid_City'=>'required',
        ]);
        DB::update('update office set NAME = ?, Address = ?, Population = ?, Establishment_year = ? where id_Office = ?', [$request->NAME, $request->Address, $request->Population, $request->Establishment_year, $id]);
        return redirect('/office')->with('success', 'Record about office updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('delete from office where id_Office = ?', [$id]);
        return redirect('/office')->with('success', 'Record about office deleted!');
    }
}
