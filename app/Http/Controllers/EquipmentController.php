<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::with('laboratory')
            ->latest()->paginate(10);

        return view('equipment.index', compact('equipment'));
    }

    public function create()
    {
        $laboratories = Laboratory::orderBy('name')->get();
        $item = new Equipment();

        return view('equipment.create', compact('laboratories', 'item'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'laboratory_id' => 'required|exists:laboratories,id',
            'name' => 'required|string|max:150',
            'asset_code' => 'required|string|max:80|unique:equipment,asset_code',
            'category' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'condition' => 'required|in:Excellent,Good,Fair,Poor,Damaged',
            'status' => 'required|in:Available,Reserved,Under Maintenance,Retired',
        ]);

        Equipment::create($data);

        return redirect()->route('equipment.index')
            ->with('success', 'Equipment added successfully.');
    }

    public function show(Equipment $item)
    {
        $item->load('laboratory', 'maintenances');

        return view('equipment.show', compact('item'));
    }

    public function edit(Equipment $item)
    {
        $laboratories = Laboratory::orderBy('name')->get();

        return view('equipment.edit', compact('item', 'laboratories'));
    }

    public function update(Request $request, Equipment $item)
    {
        $data = $request->validate([
            'laboratory_id' => 'required|exists:laboratories,id',
            'name' => 'required|string|max:150',
            'asset_code' => [
                'required',
                'string',
                'max:80',
                Rule::unique('equipment', 'asset_code')->ignore($item->id),
            ],
            'category' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'condition' => 'required|in:Excellent,Good,Fair,Poor,Damaged',
            'status' => 'required|in:Available,Reserved,Under Maintenance,Retired',
        ]);

        $item->update($data);

        return redirect()->route('equipment.index')
            ->with('success', 'Equipment updated successfully.');
    }

    public function destroy(Equipment $item)
    {
        try {
            $item->delete();

            return redirect()->route('equipment.index')
                ->with('success', 'Equipment deleted successfully.');
        } catch (QueryException $e) {
            return back()->with(
                'error',
                'This equipment cannot be deleted because related records exist.'
            );
        }
    }
}
