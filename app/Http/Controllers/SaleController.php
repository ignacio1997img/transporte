<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class SaleController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $this->custom_authorize('browse_vehicles');
        return view('sales.browse');
    }

    public function create()
    {

        return view('sales.edit-add');
    }
}
