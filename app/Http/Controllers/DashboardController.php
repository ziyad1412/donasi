<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Donatur;
use App\Models\Fundraiser;
use App\Models\Fundraising;
use App\Models\FundraisingWithdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // apply_fundraiser
    public function apply_fundraiser()
    {
        $user = Auth::user();
        DB::transaction(function () use ($user) {
            $validated['user_id'] = $user->id;
            $validated['is_active'] = false;
            Fundraiser::create($validated);
        });
        return redirect()->route('admin.fundraisers.index');
    }

    //function my_withdrawals
    public function my_withdrawals()
    {
        $user = Auth::user();
        $fundraiserId = $user->fundraiser->id;

        //withdrawals where fundraiser_id order by id desc get
        $withdrawals = FundraisingWithdrawal::where('fundraiser_id', $fundraiserId)->orderByDesc('id')->get();


        return view('admin.my_withdrawals.index', compact('withdrawals'));
    }

    //withdrawals details
    public function my_withdrawals_details(FundraisingWithdrawal $fundraisingWithdrawal)
    {
        return view('admin.my_withdrawals.details', compact('fundraisingWithdrawal'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $fundraisingsQuery = Fundraising::query();
        $withdrawalsQuery = FundraisingWithdrawal::query();

        if ($user->hasRole('fundraiser')) {
            $fundraiserId = $user->fundraiser->id;

            $fundraisingsQuery->where('fundraiser_id', $fundraiserId);
            $withdrawalsQuery->where('fundraiser_id', $fundraiserId);

            $fundraisingIds = $fundraisingsQuery->pluck('id');

            $donaturs = Donatur::whereIn('fundraising_id', $fundraisingIds)->where('is_paid', true)->count();
        } else {
            $donaturs = Donatur::where('is_paid', true)->count();
        }

        $fundraisings = $fundraisingsQuery->count();
        $withdrawals = $withdrawalsQuery->count();
        $categories = Category::count();
        $fundraisers = Fundraiser::count();

        return view('admin.dashboard', compact('fundraisings', 'donaturs', 'withdrawals', 'categories', 'fundraisers'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
