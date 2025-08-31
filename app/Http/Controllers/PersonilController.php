<?php

namespace App\Http\Controllers;

use App\Models\Personil;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PersonilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personils = Personil::all();
        return view('admin.personil.index', compact('personils'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $is_edit = false;
        return view('admin.personil.create', compact('is_edit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nrp' => 'nullable|string|max:255|unique:personils,nrp',
            'name' => 'required|string',
        ]);

        Personil::create($request->all());

        return redirect()->route('dashboard.personil.index')->with('success', 'Data created successfully');
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
        $is_edit = true;
        $data = Personil::findOrFail($id);
        return view('admin.personil.create', compact('is_edit', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nrp' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('personils', 'nrp')->ignore($id), // $id = id user yang lagi diupdate
            ],
            'name' => 'required|string',
        ]);

        $data = Personil::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('dashboard.personil.index')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Personil::findOrFail($id);
        $data->delete();

        return redirect()->route('dashboard.personil.index')->with('success', 'Data deleted successfully');
    }
}
