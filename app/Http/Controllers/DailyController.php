<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DailyVisit;
use App\Models\DailyVisitInfo;
use App\Models\InventoryInfo;
use Illuminate\Http\Request;

class DailyController extends Controller
{
    public function used(Request $request)
    {
        $quantity_output = "";
        
        $InventoryInfos = InventoryInfo::where('name', 'LIKE', '%' . $request->medicine_name . '%')
            ->whereNotIn('type', ['Equipment'])
            ->get();

        foreach ($InventoryInfos as $InventoryInfo) {
            $quantity_output.='<input type="number" class="customize-bg-input" name="quantity[]" value="'. $InventoryInfo->quantity .'" readonly>';
        }

        return response($quantity_output);
    }

    public function name(Request $request)
    {
        $dropdown_output = "";

        $users = User::where('name', 'LIKE', '%'.$request->name.'%')
            ->whereNotIn('role_id', [5, 6, 7, 8])
            ->get();

        foreach ($users as $user){
            $dropdown_output .= '<li><a href="#" class="dropdown-names" data-fill_name="'.$user->name.'" data-fill_id="'.$user->school_id.'" style="color: black;">'.$user->name.'</a></li>';
        }

        return response($dropdown_output);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daily_visits = DailyVisit::orderBy("date","desc")
            ->paginate(10);
        $inventory_infos = InventoryInfo::whereNotIn('type', ['Equipment'])
            ->orderBy("name", "asc")
            ->get();

        return view('nurse.homepage', compact('daily_visits', 'inventory_infos'))
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
        $request->validate([
            'daily_name' => 'required|string',
            'daily_id',
            'date',
            'time',
        ]);

        $daily_visit = DailyVisit::create($request->all());

        $validatedData = $request->validate([
            'main_complaint' => 'required',
            'sub_complaint' => 'required',
            'treatment' => 'max:255',
            'medicine' => 'string',
            'medicine_take' => 'integer',
            'take.*' => 'string', // Validate each take individually
        ]);
        
        // Combine multiple take values into one
        $validatedData['take'] = implode('
        ', $validatedData['take']);
        
        $daily_visit_infoData = $validatedData;
        $daily_visit_infoData['daily_visit_id'] = $daily_visit->id;
        
        DailyVisitInfo::create($daily_visit_infoData);
        
        return redirect()->route('nurse.dailyIndex');
    }

    /**
     * Display the specified resource.
     */
    public function show(DailyVisit $daily_visit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DailyVisit $daily_visit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DailyVisit $daily_visit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailyVisit $daily_visit)
    {
        //
    }
}
