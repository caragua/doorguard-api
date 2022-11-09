<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CardReader;
use App\Models\AccessRule;
use Illuminate\Validation\Rule;

class CardReaderController extends Controller
{
    public function options()
    {
        $accessRules = AccessRule::all()->keyBy('id');

        return response()->json([
            'accessRules' => $accessRules,
            'codes' => config('codes.card_reader')
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cardReaders = CardReader::all();
        $accessRules = AccessRule::all()->keyBy('id');

        return response()->json([
            'data' => $cardReaders, 
            'accessRules' => $accessRules,
            'codes' => config('codes.card_reader')
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
            'mac_address'   => 'required|size:17',
            'nickname'      => 'required|max:32',
            'usage'         => ['required', Rule::in(array_keys(config('codes.card_reader.usage')))]
        ]);

        $do = new CardReader([
            'mac_address'   => $request->post('mac_address'),
            'nickname'      => $request->post('nickname'),
            'usage'         => $request->post('usage'),
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
        $cardReader = CardReader::findOrFail($id);
        $accessRules = AccessRule::all()->keyBy('id');

        return response()->json([
            'data' => $cardReader, 
            'accessRules' => $accessRules,
            'codes' => config('codes.card_reader')
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
        $do = CardReader::findOrFail($id);
        
        $request->validate([
            'mac_address'   => 'required|size:17',
            'nickname'      => 'required|max:32',
            'usage'         => ['required', Rule::in(array_keys(config('codes.card_reader.usage')))],
        ]);

        $do->mac_address    = $request->post('mac_address');
        $do->nickname       = $request->post('nickname');
        $do->usage          = $request->post('usage');
        $do->data           = $request->post('data');

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
        $do = CardReader::findOrFail($id);
        $do->delete();

        return response()->json($do::all());
    }
}
