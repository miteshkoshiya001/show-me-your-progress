<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\RaceType;

class AdminDriverController extends Controller
{
    public function index()
    {
        $raceTypes = RaceType::all();
        $drivers = Driver::with('race')->get();

        return view('admin.drivers', compact('raceTypes', 'drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'race_type_id' => 'required|exists:race_types,id',
        ]);

        Driver::create([
            'name' => $request->input('name'),
            'race_type_id' => $request->input('race_type_id'),
        ]);

        return redirect()->route('admin.drivers.index')->with('success', 'Driver added successfully.');
    }

    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
        $raceTypes = RaceType::all();

        return view('admin.drivers.edit', compact('driver', 'raceTypes'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'race_type_id' => 'required|exists:race_types,id',
        ]);

        $driver = Driver::findOrFail($id);
        $driver->update([
            'name' => $request->input('name'),
            'race_type_id' => $request->input('race_type_id'),
        ]);

        return redirect()->route('admin.drivers.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();

        return redirect()->route('admin.drivers.index')->with('success', 'Driver deleted successfully.');
    }
}
