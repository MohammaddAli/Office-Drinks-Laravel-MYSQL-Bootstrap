<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use App\Models\Order;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drinks = Drink::all();
        return view('employees.index', compact('drinks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $drinks = Drink::all();
        return view('employees.create', compact('drinks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'drink' => 'required|exists:drinks,id',
        ]);

 $x = Order::where([['drink_id',$request->drink], ['user_id', auth()->user()->id]])
 ->whereDate('created_at', \Carbon\Carbon::today())
 ->onlyTrashed()
 ->count();
//  dd($x);
        if($x >= 3){
            Session::flash('exceed', 'Sorry you exceeded the maximum number of this drink');
            return redirect()->back();
        }

        if($oldOrder = Order::where([['drink_id',$request->drink], ['user_id', auth()->user()->id]])->first()){
            $oldOrder->increment('drink_count');
        }else{
            Order::create([
                'user_id'=> auth()->user()->id,
                'drink_id'=> $request->drink,
                'drink_count'=> 1,
            ]);
        }

        Session::flash('done', 'Order Submited Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
