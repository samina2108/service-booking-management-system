<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Service;
use App\Models\ActivityLog;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $customers = Customer::when($search, function ($query, $search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%')
              ->orWhere('phone', 'like', '%' . $search . '%');
        });
    })
    ->latest()
    ->paginate(10)
    ->withQueryString();

    return view('customers.index', compact('customers', 'search'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    return view('customers.create');
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:customers,email',
        'phone' => 'required|string|max:20',
        'address' => 'nullable|string',
    ]);

    $customer = Customer::create($validated);

    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'created',
        'description' => 'Customer #' . $customer->id . ' was created.',
        'model_type' => Customer::class,
        'model_id' => $customer->id,
    ]);

    return redirect()
        ->route('customers.index')
        ->with('success', 'Customer created successfully.');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
{
    return view('customers.show', compact('customer'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
{
    return view('customers.edit', compact('customer'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:customers,email,' . $customer->id,
        'phone' => 'required|string|max:20',
        'address' => 'nullable|string',
    ]);

    $customer->update($validated);

    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'updated',
        'description' => 'Customer #' . $customer->id . ' was updated.',
        'model_type' => Customer::class,
        'model_id' => $customer->id,
    ]);

    return redirect()
        ->route('customers.index')
        ->with('success', 'Customer updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
{  
    if (!auth()->user()->isAdmin()) {
        abort(403, 'Unauthorized');
    }
    $customerId = $customer->id;
    $customer->delete();

    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'deleted',
        'description' => 'Customer #' . $customerId . ' was deleted.',
        'model_type' => Customer::class,
        'model_id' => $customerId,
    ]);

    return redirect()
        ->route('customers.index')
        ->with('success', 'Customer deleted successfully.');
}
}
