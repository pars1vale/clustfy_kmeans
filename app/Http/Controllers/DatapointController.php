<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Datapoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DatapointController extends Controller
{

    public function index()
    {
        // Ambil semua datapoint beserta atribut yang terkait
        $datapoints = Datapoint::with('attributes')->paginate(10);

        // Ambil semua atribut yang ada di tabel attribute
        $attributes = Attribute::all();

        // Kembalikan view dengan data datapoint dan attribute
        return view('datapoint.index', compact('datapoints', 'attributes'));
    }

    public function create()
    {
        // Ambil semua atribut dari tabel attribute
        $attributes = Attribute::all();

        // Tampilkan form create dan kirimkan data attributes ke view
        return view('datapoint.create', compact('attributes'));
    }

    public function store(Request $request)
    {
        // Validasi input dari user
        $validated = $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:framework,library',
            'attributes.*' => 'required|numeric', // Validasi untuk setiap atribut
        ]);

        // Simpan data ke tabel datapoint
        $datapoint = Datapoint::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
        ]);

        // Simpan data attributes yang diinputkan user
        foreach ($validated['attributes'] as $attribute_id => $value) {
            $datapoint->attributes()->attach($attribute_id, ['value' => $value]);
        }

        // Redirect setelah berhasil menyimpan
        return redirect()->route('datapoints.index')->with('success', 'Datapoint berhasil disimpan');
    }

    public function edit($id)
    {
        // Ambil data datapoint yang ingin diedit beserta relasinya dengan atribut
        $datapoint = Datapoint::with('attributes')->findOrFail($id);
        $attributes = Attribute::all();

        // Mengatur nilai atribut berdasarkan datapoint
        $attributes = $attributes->map(function ($attribute) use ($datapoint) {
            // Cari nilai atribut dalam datapoint
            $datapointAttribute = $datapoint->attributes->firstWhere('id', $attribute->id);
            // Jika ada nilai di pivot, gunakan nilai tersebut; jika tidak, gunakan null
            $attribute->value = $datapointAttribute ? $datapointAttribute->pivot->value : null;
            return $attribute;
        });

        return view('datapoint.edit', compact('datapoint', 'attributes'));
    }


    public function update(Request $request,  $id)
    {
        // Validasi input dari user
        $validated = $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:framework,library',
            'attributes.*' => 'required|numeric', // Validasi untuk setiap atribut
        ]);

        // Ambil data datapoint yang ingin diupdate
        $datapoint = Datapoint::findOrFail($id);

        // Update data datapoint
        $datapoint->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
        ]);

        // Update data attributes yang diinputkan user
        foreach ($validated['attributes'] as $attribute_id => $value) {
            $datapoint->attributes()->updateExistingPivot($attribute_id, ['value' => $value]);
        }

        // Redirect setelah berhasil menyimpan
        return redirect()->route('datapoints.index')->with('success', 'Datapoint berhasil diupdate');
    }

    public function destroy($id)
    {
        // Ambil data datapoint yang ingin dihapus beserta relasinya
        $datapoint = Datapoint::findOrFail($id);

        // Hapus relasi dari tabel pivot
        $datapoint->attributes()->detach();

        // Hapus data datapoint
        $datapoint->delete();

        // Redirect setelah berhasil menghapus
        return redirect()->route('datapoints.index')->with('success', 'Datapoint berhasil dihapus');
    }
}
