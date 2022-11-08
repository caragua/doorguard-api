<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScanReport;

class ScanReportController extends Controller
{
    private $codes = [
        'pending' => [0, 1]
    ];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $do = ScanReport::all();
        return response()->json($do);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->valudate([
            'card_reader_id'    => 'required|integer',
            'card_number'       => 'required|max:10',
            'description'       => '',
            'pending'           => ['required', Rule::in($this->codes['pending'])],
        ]);

        $do = new ScanReport([
            'card_reader_id'    => $request->post('card_reader_id'),
            'card_number'       => $request->post('card_number'),
            'description'       => $request->post('description'),
            'pending'           => $request->post('pending'),
        ]);

        $do->save();

        return response()->json($do);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $do = ScanReport::findOrFail($id);

        return response()->json($do);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $do = ScanReport::findOrFail($id);
        
        $request->valudate([
            'card_reader_id'    => 'required|integer',
            'card_number'       => 'required|max:10',
            'description'       => '',
            'pending'           => ['required', Rule::in($this->codes['pending'])],
        ]);

        $do->card_reader_id = $request->post('card_reader_id');
        $do->card_number    = $request->post('card_number');
        $do->description    = $request->post('description');
        $do->pending        = $request->post('pending');

        $do->save();

        return response()->json($do);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $do = ScanReport::findOrFail($id);
        $do->delete();

        return response()->json($do::all());
    }
}
