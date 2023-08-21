<?php


namespace App\Http\Controllers;

use App\Models\RaceType;
use App\Models\Driver;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminRaceTypeController extends Controller
{
    use SoftDeletes;
    public function index()
    {
        $raceTypes = RaceType::all();
        return view('admin.race-type', compact('raceTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:race_types,race_name,NULL,id,deleted_at,NULL|max:255',
        ]);

        $raceType = RaceType::where('race_name', $request->name)->first();

        if ($raceType) {
            return redirect()->route('admin.race_types.index')->withErrors(['name' => 'Rider type already exists.'])->withInput();
        }

        RaceType::create([
            'race_name' => $request->name,
        ]);

        return redirect()->route('admin.race_types.index')->with('success', 'Rider type added successfully.');
    }
    public function edit($id)
    {
        $raceType = RaceType::findOrFail($id);
        return view('admin.race_type_edit', compact('raceType'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'editname' => 'required|unique:race_types,race_name,' . $id . ',id|max:255',
        ]);

        $raceType = RaceType::findOrFail($id);
        $raceType->update([
            'race_name' => $request->input('editname'),
        ]);

        return redirect()->route('admin.race_types.index')->with('success', 'Rider type updated successfully.');
    }

    public function destroy($id)
    {
        $raceType = RaceType::findOrFail($id);

        // Check if any driver references this race type
        $relatedDrivers = $raceType->drivers()->count();

        if ($relatedDrivers > 0) {
            return redirect()->route('admin.race_types.index')->withErrors(['error' => 'Race type cannot be deleted as it is associated with drivers.']);
        }

        $raceType->delete();

        return redirect()->route('admin.race_types.index')->with('success', 'Race type deleted successfully.');
    }


}
