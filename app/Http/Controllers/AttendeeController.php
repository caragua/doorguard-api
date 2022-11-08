<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendee;

class AttendeeController extends Controller
{
    private $codes = [];

    public function __construct()
    {
        $this->codes = Attendee::$codes;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Attendees = Attendee::all();
        return response()->json($Attendees);
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
        $request->validate([
            'mac_address' => 'required|size:17',
            'nickname' => 'required|max:32',
            'function' => ['required', Rule::in($this->codes['function'])]
        ]);

        $do = new Attendee([
            'mac_address'   => $request->post('mac_address'),
            'nickname'      => $request->post('nickname'),
            'function'      => $request->post('function'),
            'data'          => $request->post('data')
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
        $Attendee = Attendee::findOrFail($id);

        return response()->json($Attendee);
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
        $do = Attendee::findOrFail($id);
        
        $request->validate([
            'mac_address' => 'required|size:17',
            'nickname' => 'required|max:32',
            'function' => ['required', Rule::in($this->codes['function'])]
        ]);

        $do->mac_address = $request->post('mac_address');
        $do->nickname = $request->post('nickname');
        $do->function = $request->post('function');
        $do->data = $request->post('data');

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
        $do = Attendee::findOrFail($id);
        $do->delete();

        return response()->json($do::all());
    }
}
