<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccessRule;
use App\Models\Site;
use Illuminate\Validation\Rule;

class AccessRuleController extends Controller
{    
    public function options()
    {
        $sites = Site::all()->keyBy('id');

        return response()->json([
            'sites' => $sites,
            'codes' => array_merge(
                config('codes.access_rule'), 
                ['attendee_type' => config('codes.attendee.type')]
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
        $do = AccessRule::all();
        $sites = Site::all()->keyBy('id');

        return response()->json([
            'data'  => $do, 
            'sites' => $sites,
            'codes' => array_merge(
                config('codes.access_rule'), 
                ['attendee_type' => config('codes.attendee.type')]
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
            'site_id'               => 'required|integer|min:0',
            'description'           => 'required',
            'check_attendee_type'   => ['required', 'string', Rule::in(array_keys(config('codes.attendee.type')))],
            'check_age'             => ['required', 'integer', Rule::in(array_keys(config('codes.access_rule.check_age')))],
            'single_pass'           => ['required', 'integer', Rule::in(array_keys(config('codes.access_rule.single_pass')))]
        ]);

        $do = new AccessRule([
            'site_id'               => $request->post('site_id'),
            'description'           => $request->post('description'),
            'check_attendee_type'   => $request->post('check_attendee_level'),
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
        $sites = Site::all()->keyBy('id');

        return response()->json([
            'data'  => $do, 
            'sites' => $sites,
            'codes' => array_merge(
                config('codes.access_rule'), 
                ['attendee_type' => config('codes.attendee.type')]
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
        $do = AccessRule::findOrFail($id);
        
        $request->validate([
            'site_id'               => 'required|integer|min:0',
            'description'           => 'required',
            'check_attendee_type'   => ['required', 'string', Rule::in(array_keys(config('codes.attendee.type')))],
            'check_age'             => ['required', 'integer', Rule::in(array_keys(config('codes.access_rule.check_age')))],
            'single_pass'           => ['required', 'integer', Rule::in(array_keys(config('codes.access_rule.single_pass')))]
        ]);

        $do->site_id                = $request->post('site_id');
        $do->description            = $request->post('description');
        $do->check_attendee_type    = $request->post('check_attendee_type');
        $do->check_age              = $request->post('check_age');
        $do->single_pass            = $request->post('single_pass');

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
