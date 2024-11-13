<?php

namespace App\Http\Controllers;


class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dokter_index');
    }

    public function create()
    {
        return view('dokter_create_index');
    }
    /**
     * Show the form for creating a new resource.
     */
   
}
