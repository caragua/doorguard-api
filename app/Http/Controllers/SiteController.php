<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function showCodes()
    {
        return response()->json(['codes' => config('codes.site')]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $do = Site::all();
        return response()->json(['data' => $do, 'codes' => config('codes.site')]);
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
            'name'      => 'required|max:128',
            'location'  => 'required|max:128'
        ]);

        $do = new Site([
            'name'      => $request->post('name'),
            'location'  => $request->post('location'),
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
        $do = Site::findOrFail($id);

        return response()->json(['data' => $do, 'codes' => config('codes.site')]);
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
        $do = Site::findOrFail($id);
        
        $request->validate([
            'name'      => 'required|max:128',
            'location'  => 'required|max:128'
        ]);

        $do->name       = $request->post('name');
        $do->location   = $request->post('location');

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
        $do = Site::findOrFail($id);
        $do->delete();

        return response()->json($do::all());
    }
}
