<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryInfo;
use App\Models\AddQuantity;
use App\Models\ReduceQuantity;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InventoryController extends Controller
{
    /**
     * Live Search on Table
     */
    public function search(Request $request)
    {
        $output = "";

        $inventory_infos = InventoryInfo::where('name', 'LIKE', '%'.$request->search.'%')
            ->get();

        foreach($inventory_infos as $inventory_info)
        {
            $output.=
            '<tr>
            <td>'.$inventory_info->name.'</td>
            <td>'.$inventory_info->type.'</td>
            <td>'.$inventory_info->quantity.'</td>';

            //If item type is 'Medicine'
            if($inventory_info->type == 'Medicine'){
                $output.='<td>'.$inventory_info->dosage.' mg</td>';
            } 
            else {
                $output.='<td></td>';
            }
            
            $output.=
            '<td>
                <div class="row justify-content-center">
                    <div class="col-3">
                        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#staticBackdropUpdate'.$inventory_info->id.'">Update Item</button>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#staticBackdropAdd'.$inventory_info->id.'">Add Quantity</button>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdropReduce'.$inventory_info->id.'">Reduce Quantity</button>
                    </div>
                </div>
            </td>
            </tr>';
        }

        return response($output);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventoryItems = Inventory::join('inventory_infos', 'inventories.id', '=', 'inventory_infos.inventory_id')
            ->orderBy('inventory_infos.name', 'asc')
            ->select('inventories.*')
            ->paginate(10);
        
        $inventory_infos = InventoryInfo::get();

        return view('nurse.inventory.inventory-home', compact('inventoryItems', 'inventory_infos'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inventory = Inventory::create();

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('inventory_infos')->where(function ($query) use ($request) {
                    return $query->where('type', $request->type)
                        ->orWhere('dosage', $request->dosage);
                }),
            ],
            'type' => 'in:Medicine,Equipment',
            'quantity' => 'required_if:type,Medicine,Equipment|integer',
            'dosage' => 'required_if:type,Medicine|integer',
        ]);

        $inventoryData = $request->all();
        $inventoryData['medical_exam_id'] = $inventory->id;

        InventoryInfo::create($inventoryData);
        return redirect()->route('nurse.inventoryIndex')
            ->with('success', 'Item added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update item info
     */
    public function update(Request $request, InventoryInfo $inventoryItem)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('inventory_infos')
                    ->ignore($inventoryItem->id)
                    ->where(function ($query) use ($request) {
                        return $query->where('type', $request->type)
                            ->orWhere('dosage', $request->dosage);
                    }),
            ],
            'type' => 'in:Medicine,Equipment',
            'dosage' => 'required_if:type,Medicine|integer',
        ]);

        // Capitalize the 'name' before updating
        $request->merge(['name' => ucwords($request->input('name'))]);

        $inventoryItem->update($request->all());

        return redirect()->route('nurse.inventoryIndex')
            ->with('success', 'Item updated successfully');
    }

    /**
     * adding quantity
     */
    public function add(Request $request, InventoryInfo $inventoryItem)
    {
        $request->validate([
            'add_quantity' => 'required|integer',
        ]);
    
        // Adding original from input quantity
        $newQuantity = $inventoryItem->quantity + $request->input('add_quantity');
        $inventoryItem->update(['quantity' => $newQuantity]);

        //if the add item has not yet made
        if(!$inventoryItem->add && $inventoryItem->add != now()){
            $addData = $request->all();
            $addData['inventory_info_id'] = $inventoryItem->id;

            AddQuantity::create($addData);
        } else {
            $newAdd = $inventoryItem->add->add_quantity + $request->input('add_quantity');
            $inventoryItem->add->update(['add_quantity' => $newAdd]);
        }

        return redirect()->route('nurse.inventoryIndex')
            ->with('success', "Item's quantity added successfully");
    }

    /**
     * Update the specified resource in storage.
     */
    public function reduce(Request $request, InventoryInfo $inventoryItem)
    {
        $request->validate([
            'reduce_quantity' => 'required|integer',
        ]);
    
        // Ensure the reduce_quantity is less than or equal to the current quantity
        if ($request->input('reduce_quantity') <= $inventoryItem->quantity) {
            $newQuantity = $inventoryItem->quantity - $request->input('reduce_quantity');
            $inventoryItem->update(['quantity' => $newQuantity]);

            //if the reduce item has not yet made
            if(!$inventoryItem->reduce && $inventoryItem->reduce != now()){
                $reduceData = $request->all();
                $reduceData['inventory_info_id'] = $inventoryItem->id;

                ReduceQuantity::create($reduceData);
            } else {
                $newReduce = $inventoryItem->reduce->reduce_quantity + $request->input('reduce_quantity');
                $inventoryItem->reduce->update(['reduce_quantity' => $newReduce]);
            }
    
            return redirect()->route('nurse.inventoryIndex')
                ->with('success', "Item's quantity deducted successfully");
        } else {
            return redirect()->route('nurse.inventoryIndex')
                ->with('error', 'Input cannot exceed on the current quantity');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
