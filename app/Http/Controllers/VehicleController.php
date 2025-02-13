<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('vehicles.browse');
    }


    public function list(){

        $search = request('search') ?? null;
        $paginate = request('paginate') ?? 10;

        $data = Vehicle::where(function($query) use ($search){
                    $query->OrWhereRaw($search ? "id = '$search'" : 1)
                    ->OrWhereRaw($search ? "numberRegistration like '%$search%'" : 1)
                    ->OrWhereRaw($search ? "numberEngine like '%$search%'" : 1)
                    ->OrWhereRaw($search ? "numberChassis like '%$search%'" : 1)
                    ->OrWhereRaw($search ? "color like '%$search%'" : 1)
                    ->OrWhereRaw($search ? "model like '%$search%'" : 1)
                    ->OrWhereRaw($search ? "brand like '%$search%'" : 1);
                    // ->OrWhereRaw($search ? "CONCAT(first_name, ' ', last_name) like '%$search%'" : 1)
                    })
                    ->where('deleted_at', NULL)->orderBy('id', 'DESC')->paginate($paginate);

        return view('vehicles.list', compact('data'));
    }
}
