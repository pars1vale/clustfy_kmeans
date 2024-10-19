<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Datapoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DatapointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua datapoint
        $datapoints = Datapoint::all();

        // Ambil semua atribut yang ada di tabel attribute
        $attributes = Attribute::all();

        // Kembalikan view dengan data datapoint dan attribute
        return view('datapoint.index', compact('datapoints', 'attributes'));
        // $datapoints = Datapoint::all();
        // return view('datapoint.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua atribut dari tabel attribute
        $attributes = Attribute::all();

        // Tampilkan form create dan kirimkan data attributes ke view
        return view('datapoint.create', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari user
        $validated = $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:framework,library',
            'attributes.*' => 'required|numeric', // Pastikan semua atribut yang diinputkan valid
        ]);

        // Simpan data ke tabel datapoint
        $datapoint = new DataPoint();
        $datapoint->name = $validated['name'];
        $datapoint->type = $validated['type'];
        $datapoint->save();

        // Simpan data attributes yang diinputkan user
        foreach ($validated['attributes'] as $attribute_id => $value) {
            $datapoint->attributes()->attach($attribute_id, ['value' => $value]);
        }

        // Redirect setelah berhasil menyimpan
        return redirect()->route('datapoint.index')->with('success', 'DataPoint berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
