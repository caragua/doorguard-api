<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccessRule;

class AccessRuleController extends Controller
{
    private $codes = [
        'check_age'     => [ 0,1 ],
        'single_pass'   => [ 0,1 ]
    ];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $do = AccessRule::all();
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
        $request->validate([
            'site_id'               => 'required|integer|min:0',
            'description'           => 'required',
            'check_attendee_level'  => 'required|integer|min:0',
            'check_age'             => ['required', 'integer', Rule::in($this->codes['check_age'])],
            'single_pass'           => ['required', 'integer', Rule::in($this->codes['single_pass'])]
        ]);

        $do = new AccessRule([
            'site_id'               => $request->post('site_id'),
            'description'           => $request->post('description'),
            'check_attendee_level'  => $request->post('check_attendee_level'),
            'check_age'             => $request->post('check_age'),
            'single_pass'           => $request->post('single_pass'),
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
        $do = AccessRule::findOrFail($id);

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
        $do = AccessRule::findOrFail($id);
        
        $request->validate([
            'site_id'               => 'required|integer|min:0',
            'description'           => 'required',
            'check_attendee_level'  => 'required|integer|min:0',
            'check_age'             => ['required', 'integer', Rule::in($this->codes['check_age'])],
            'single_pass'           => ['required', 'integer', Rule::in($this->codes['single_pass'])]
        ]);

        $do->site_id = $request->post('site_id');
        $do->description = $request->post('description');
        $do->check_attendee_level = $request->post('check_attendee_level');
        $do->check_age = $request->post('check_age');
        $do->single_pass = $request->post('single_pass');

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
        $do = AccessRule::findOrFail($id);
        $do->delete();

        return response()->json($do::all());
    }
}
