<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDonationRequest;
use App\Models\Category;
use App\Models\Donatur;
use App\Models\Fundraising;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // categories 
        $categories = Category::all();
        // fundraisings with category fundraiser is active
        $fundraisings = Fundraising::with(['category', 'fundraiser'])->where('is_active', 1)->orderByDesc('id')->get();
        return view('front.views.index', compact('categories', 'fundraisings'));
    }

    //category
    public function category(Category $category)
    {
        // categories 
        return view('front.views.category', compact('category'));
    }

    public function details(Fundraising $fundraising)
    {
        //goalreached
        $goalReached = $fundraising->totalReachedAmount() >= $fundraising->target_amount;
        return view('front.views.details', compact('fundraising', 'goalReached'));
    }

    public function support(Fundraising $fundraising)
    {
        //goalreached
        $goalReached = $fundraising->totalReachedAmount() >= $fundraising->target_amount;
        return view('front.views.donation', compact('fundraising'));
    }

    public function checkout(Fundraising $fundraising, $totalAmountDonation)
    {
        //goalreached
        return view('front.views.checkout', compact('fundraising', 'totalAmountDonation'));
    }

    public function store(StoreDonationRequest $request, Fundraising $fundraising, $totalAmountDonation)
    {

        DB::transaction(function () use ($request, $fundraising, $totalAmountDonation) {
            $validated = $request->validated();

            if ($request->hasFile('proof')) {
                $proofPath = $request->file('proof')->store('proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $validated['fundraising_id'] = $fundraising->id;
            $validated['total_amount'] = $totalAmountDonation;
            $validated['is_paid'] = false;


            $donatur = Donatur::create($validated);
        });
        return redirect()->route('front.details', $fundraising->slug);
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
