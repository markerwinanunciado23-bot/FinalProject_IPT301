<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class LaboratoryController extends Controller
{
    public function index()
    {
        $laboratories = Laboratory::latest()->paginate(10);

        return view('laboratories.index', compact('laboratories'));
    }

    public function create()
    {
        return view('laboratories.create', [
            'laboratory' => new Laboratory()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'building' => 'required|string|max:100',
            'room_number' => 'required|string|max:50',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string|max:2000',
            'status' => 'required|in:Available,Unavailable,Under Maintenance',
        ]);

        Laboratory::create($data);

        return redirect()->route('laboratories.index')
            ->with('success', 'Laboratory added successfully.');
    }

    public function show(Laboratory $laboratory)
    {
        $laboratory->load('equipment', 'reservations');

        return view('laboratories.show', compact('laboratory'));
    }

    public function edit(Laboratory $laboratory)
    {
        return view('laboratories.edit', compact('laboratory'));
    }

    public function update(Request $request, Laboratory $laboratory)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'building' => 'required|string|max:100',
            'room_number' => 'required|string|max:50',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string|max:2000',
            'status' => 'required|in:Available,Unavailable,Under Maintenance',
        ]);

        $laboratory->update($data);

        return redirect()->route('laboratories.index')
            ->with('success', 'Laboratory updated successfully.');
    }

    public function destroy(Laboratory $laboratory)
    {
        try {
            $laboratory->delete();

            return redirect()->route('laboratories.index')
                ->with('success', 'Laboratory deleted successfully.');
        } catch (QueryException $e) {
            return back()->with(
                'error',
                'This laboratory cannot be deleted because related records exist.'
            );
        }
    }
}
