<?php

namespace App\Http\Controllers;
use App\Models\Marker; 

use Illuminate\Http\Request;

class MarkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $markers = Marker::where('user_id', auth()->id())->get();
    
        return view('markers.index', compact('markers'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('markers.create');
    }   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
        ]);
    
        $marker = new Marker([
            'title' => $request->title,
            'lat' => $request->lat,
            'lon' => $request->lon,
            'user_id' => auth()->id(),
        ]);
        print_r($marker);
        $marker->save();
        return 'hello';
        return redirect()->back()->with('success', 'Marker added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $marker = Marker::findOrFail($id);
    
        return view('markers.show', compact('marker'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $marker = Marker::findOrFail($id);
    
        return view('markers.edit', compact('marker'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $marker = Marker::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'lat' => 'required|numeric',
        'lon' => 'required|numeric',
    ]);

    $marker->update([
        'title' => $request->title,
        'lat' => $request->lat,
        'lon' => $request->lon,
    ]);

    return redirect()->back()->with('success', 'Marker updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $marker = Marker::findOrFail($id);
    
        $marker->delete();
    
        return redirect()->back()->with('success', 'Marker deleted successfully.');
    }
    
}
