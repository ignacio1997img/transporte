<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function peopleList(){
        $q = request('q');
        // $data = [];
        // if ($q) {
            $data = People::whereRaw('(ci like "%'.$q.'%" or first_name like "%'.$q.'%" or last_name like "%'.$q.'%" or CONCAT(first_name," " , last_name) like "%'.$q.'%" )')
                ->where('deleted_at', null)
                ->get();
        // }
        return response()->json($data);
    }

    public function peopleStore(Request $request){
        DB::beginTransaction();
        try {
            // return $request;
            $people =People::create($request->all());
            DB::commit();
            return response()->json(['people' => $people]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
