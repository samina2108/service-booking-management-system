<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use App\Models\ActivityLog;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Booking::with(['customer', 'service']);
    
        // Customer Search
        if ($request->filled('search')) {
            $search = $request->search;
    
            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }
    
        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        // Date Filter
        if ($request->filled('booking_date')) {
            $query->whereDate('booking_date', $request->booking_date);
        }
    
        $bookings = $query->latest()->paginate(10)->withQueryString();
    
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $services = Service::all();
    
        return view('bookings.create', compact('customers', 'services'));
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
        'customer_id' => 'required|exists:customers,id',
        'service_id' => 'required|exists:services,id',
        'booking_date' => 'required|date',
        'booking_time' => 'required',
        'price' => 'required|numeric',
        'status' => 'required|in:pending,confirmed,completed,cancelled',
        'payment_status' => 'required|in:unpaid,paid,refunded',
        'notes' => 'nullable|string',
    ]);

    $booking = Booking::create($validated);

    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'created',
        'description' => 'Booking #' . $booking->id . ' was created.',
        'model_type' => Booking::class,
        'model_id' => $booking->id,
    ]);

    return redirect()
        ->route('bookings.index')
        ->with('success', 'Booking created successfully.');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        $booking->load(['customer', 'service']);
    
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
{
    $customers = Customer::all();
    $services = Service::all();

    return view('bookings.edit', compact(
        'booking',
        'customers',
        'services'
    ));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
{
    $validated = $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'service_id' => 'required|exists:services,id',
        'booking_date' => 'required|date|after_or_equal:today',
        'booking_time' => 'required|date_format:H:i',
        'price' => 'required|numeric|min:0',
        'status' => 'required|in:pending,confirmed,completed,cancelled',
        'payment_status' => 'required|in:unpaid,paid,refunded',
        'notes' => 'nullable|string',
    ]);

    $booking->update($validated);

    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'updated',
        'description' => 'Booking #' . $booking->id . ' was updated.',
        'model_type' => Booking::class,
        'model_id' => $booking->id,
    ]);

    return redirect()
        ->route('bookings.index')
        ->with('success', 'Booking updated successfully.');
}


public function updateStatus(Request $request, Booking $booking)
{   
    if (!auth()->user()->isAdmin()) {
        abort(403, 'Unauthorized');
    }
    $validated = $request->validate([
        'status' => 'required|in:pending,confirmed,completed,cancelled',
    ]);

    $currentStatus = $booking->status;
    $newStatus = $validated['status'];

    $allowedTransitions = [
        'pending' => ['confirmed', 'cancelled'],
        'confirmed' => ['completed', 'cancelled'],
        'completed' => [],
        'cancelled' => [],
    ];

    if ($currentStatus === $newStatus) {
        return back();
    }

    if (!in_array($newStatus, $allowedTransitions[$currentStatus])) {
        return back()->with(
            'error',
            'Invalid status change from ' .
            ucfirst($currentStatus) .
            ' to ' .
            ucfirst($newStatus) . '.'
        );
    }

    $booking->update([
        'status' => $newStatus,
    ]);

    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'status_changed',
        'description' => 'Booking #' . $booking->id .
            ' status changed from ' .
            ucfirst($currentStatus) .
            ' to ' .
            ucfirst($newStatus) . '.',
        'model_type' => Booking::class,
        'model_id' => $booking->id,
    ]);

    return back()->with(
        'success',
        'Booking status updated successfully.'
    );
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
     public function destroy(Booking $booking)
{     if (!auth()->user()->isAdmin()) {
    abort(403, 'Unauthorized');
}
    
    $bookingId = $booking->id;

    $booking->delete();

    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'deleted',
        'description' => 'Booking #' . $bookingId . ' was deleted.',
        'model_type' => Booking::class,
        'model_id' => $bookingId,
    ]);

    return redirect()
        ->route('bookings.index')
        ->with('success', 'Booking deleted successfully.');
}


    public function invoice(Booking $booking)
{    
    if (!auth()->user()->isAdmin()) {
        abort(403, 'Unauthorized');
    }
    $booking->load(['customer', 'service']);

    return view('bookings.invoice', compact('booking'));
}
}
