<?php

namespace App\Http\Controllers;

use App\Models\Sprint;
use App\Models\Personil;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personils = Personil::all();
        foreach ($personils as $personil) {
            $personil->status_text = $personil->sprints->where('status', 'process')->isNotEmpty()
                ? 'process'
                : 'selesai';
        }
        $countUsers = Personil::count();
        // count perkaras
        $countPerkaras = Sprint::count();
        // get report and group by polres_id and count
        $perkaras = [];
        $countFinishSprint = Sprint::where('status', 'selesai')->count();

        /**
         * jumlah personel bertugas
         * on table personil relation model to Sprint and check have data "process"
         */
        $personelOnprogress = Personil::whereHas('sprints', function ($q) {
            $q->where('status', 'process');
        })->count();
        /**
         * jumlah personel tidak bertugas
         * on table personil relation model to Sprint and check no have data "process"
         */
        $countIdlePersonel = Personil::whereDoesntHave('sprints', function ($q) {
            $q->where('status', 'process');
        })->count();

        return view('admin.index', compact('countUsers', 'countPerkaras', 'perkaras', 'countFinishSprint', 'personelOnprogress', 'countIdlePersonel', 'personils'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
