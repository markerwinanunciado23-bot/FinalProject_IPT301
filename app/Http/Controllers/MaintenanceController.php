<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenanceRecords = Maintenance::with('equipment')
            ->latest()->paginate(10);

        return view('maintenance.index', compact('maintenanceRecords'));
    }

    public function create()
    {
        $record = new Maintenance();
        $equipment = Equipment::orderBy('name')->get();

        return view('maintenance.create', compact('record', 'equipment'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'reported_date' => 'required|date',
            'maintenance_type' => 'required|string|max:100',
            'description' => 'required|string|max:1500',
            'assigned_to' => 'nullable|string|max:120',
            'cost' => 'nullable|numeric|min:0',
            'status' => 'required|in:Pending,In Progress,Completed',
            'completed_date' => 'nullable|date',
        ]);

        Maintenance::create($data);

        return redirect()->route('maintenance.index')
            ->with('success', 'Maintenance record added successfully.');
    }

    public function show(Maintenance $record)
    {
        $record->load('equipment');

        return view('maintenance.show', compact('record'));
    }

    public function edit(Maintenance $record)
    {
        $equipment = Equipment::orderBy('name')->get();

        return view('maintenance.edit', compact('record', 'equipment'));
    }

    public function update(Request $request, Maintenance $record)
    {
        $data = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'reported_date' => 'required|date',
            'maintenance_type' => 'required|string|max:100',
            'description' => 'required|string|max:1500',
            'assigned_to' => 'nullable|string|max:120',
            'cost' => 'nullable|numeric|min:0',
            'status' => 'required|in:Pending,In Progress,Completed',
            'completed_date' => 'nullable|date',
        ]);

        $record->update($data);

        return redirect()->route('maintenance.index')
            ->with('success', 'Maintenance record updated successfully.');
    }

    public function destroy(Maintenance $record)
    {
        try {
            $record->delete();

            return redirect()->route('maintenance.index')
                ->with('success', 'Maintenance record deleted successfully.');
        } catch (QueryException $e) {
            return back()->with(
                'error',
                'Unable to delete this maintenance record.'
            );
        }
    }
}
