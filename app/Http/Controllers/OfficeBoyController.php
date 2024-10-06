<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Drink;
use App\Models\Order;
use App\Models\OfficeBoy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OfficeBoyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $usersOrders = User::wherehas('orders', function($query){
        $query->onlyTrashed();
     })->with('orders', function($query){
        $query->onlyTrashed()->with('drink');
     })->get();
    //  dd($usersOrders);
     $userCount = [];
     $counts = Order::select(DB::raw('sum(drink_count) as count'), 'user_id')
         ->with('user')
         ->onlyTrashed()
         ->groupBy('user_id')
         ->get();
        //  dd($counts);

       return view('OfficeBoy.index', compact('usersOrders', 'counts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::all();
        $orderArr = [];
        if ($orders) {
            foreach($orders as $order){
                $drink = Drink::find($order->drink_id);
                $employee = User::find($order->user_id);
                array_push($orderArr, [$drink, $employee]);
            }

            return view('OfficeBoy.create', compact('orderArr'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'drinkId' => 'required|exists:drinks,id',
            'employeeId' => 'required|exists:users,id',
        ]);
        $drink = Drink::find($request->drinkId);
        $newStock = $drink->stock - 1;
        $drink->update(['stock' => $newStock]);
        Session::flash('done', 'Order Confirmed Successfully');
        Order::where([['user_id', '=', $request->employeeId], ['drink_id', '=', $request->drinkId]])->delete();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(OfficeBoy $officeBoy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OfficeBoy $officeBoy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OfficeBoy $officeBoy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OfficeBoy $officeBoy)
    {
        //
    }
}
