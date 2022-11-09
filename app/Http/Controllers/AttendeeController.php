<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendee;
use Illuminate\Validation\Rule;

class AttendeeController extends Controller
{    
    public function options()
    {
        return response()->json([
            'codes' => array_merge(
                config('codes.attendee')
            )
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $do = Attendee::all();

        return response()->json([
            'data'  => $do, 
            'codes' => array_merge(
                config('codes.attendee'), 
            )
        ]);
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
            'inscription_number'    => 'required | integer',
            'type'                  => ['required', 'string', Rule::in(array_keys(config('codes.attendee.type')))],
            'nickname'              => 'required | string',
            'card_number'           => 'required | string',
        ]);

        $do = new Attendee([
            'inscription_number'    => $request->post('inscription_number'),
            'type'                  => $request->post('type'),
            'nickname'              => $request->post('nickname'),
            'card_number'           => $request->post('card_number'),
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
        $do = Attendee::findOrFail($id);

        return response()->json([
            'data'  => $do, 
            'codes' => array_merge(
                config('codes.attendee'), 
            )
        ]);
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
            'inscription_number'    => 'required | integer',
            'type'                  => ['required', 'string', Rule::in(array_keys(config('codes.attendee.type')))],
            'nickname'              => 'required | string',
            'card_number'           => 'required | string',
        ]);

        $do->inscription_number     = $request->post('inscription_number');
        $do->type                   = $request->post('type');
        $do->nickname               = $request->post('nickname');
        $do->card_number            = $request->post('card_number');

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
