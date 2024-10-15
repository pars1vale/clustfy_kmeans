<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::all();
        return view('attribute.index', compact('attributes'));
    }

    public function create()
    {
        return view('attribute.create');
    }

    public function store(Request $request)
    {
        // Validate the request...
        $request->validate([
            'name' => 'required|unique:attributes|max:255',
            'type' => 'required',
        ]);

        $attribute = new Attribute;

        $attribute->name = $request->name;
        $attribute->type = $request->type;

        $attribute->save();
    }

    public function show($id)
    {
        $attribute = Attribute::findOrFail($id);
        return view('attribute.show', ['attribute' => $attribute]);
    }

    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        return view('attribute.edit', ['attribute' => $attribute]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:attributes|max:255',
            'type' => 'required',
        ]);

        $attribute = Attribute::findOrFail($id);

        $attribute->name = $request->name;
        $attribute->type = $request->type;

        $attribute->save();
    }

    public function destroy($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $attributes = Attribute::where('name', 'like', "%$search%")->get();
        return view('attribute.index', ['attributes' => $attributes]);
    }

    public function filter(Request $request)
    {
        $type = $request->type;
        $attributes = Attribute::where('type', $type)->get();
        return view('attribute.index', ['attributes' => $attributes]);
    }

    public function sort(Request $request)
    {
        $sort = $request->sort;
        $order = $request->order;
        $attributes = Attribute::orderBy($sort, $order)->get();
        return view('attribute.index', ['attributes' => $attributes]);
    }

    public function paginate(Request $request)
    {
        $perPage = $request->perPage;
        $attributes = Attribute::paginate($perPage);
        return view('attribute.index', ['attributes' => $attributes]);
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $file->store('files');
    }

    public function download($file)
    {
        return response()->download(storage_path("app/files/$file"));
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $file->store('imports');
    }

    public function export($file)
    {
        return response()->download(storage_path("app/imports/$file"));
    }

    public function exportAll()
    {
        $attributes = Attribute::all();
        $file = fopen(storage_path('app/exports/attributes.csv'), 'w');
        foreach ($attributes as $attribute) {
            fputcsv($file, $attribute->toArray());
        }
        fclose($file);
        return response()->download(storage_path('app/exports/attributes.csv'));
    }
}
