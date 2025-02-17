<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleSeat;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

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

    public function show($id)
    {
        $vehicle = Vehicle::where('deleted_at', null)->where('id', $id)->first();
        $seats = VehicleSeat::where('vehicle_id', $id)->get();

        return view('vehicles.read', compact('vehicle', 'seats'));
    }


    public function saveSeats(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'seats' => 'required|array',
        ]);

        $vehicleId = $request->input('vehicle_id');
        $seats = $request->input('seats');

        // Eliminar asientos existentes para este vehículo (opcional, si quieres sobrescribir)
        VehicleSeat::where('vehicle_id', $vehicleId)->delete();

        // Guardar los nuevos asientos
        foreach ($seats as $seatData) {
            VehicleSeat::create([
                'vehicle_id' => $vehicleId,
                'seatNumber' => $seatData['number'],
                'label' => $seatData['text'],
                'position_x' => $seatData['x'],
                'position_y' => $seatData['y'],
                'is_driver' => $seatData['isDriver'],
            ]);
        }

        return response()->json(['message' => 'Asientos guardados exitosamente']);
    }
}
