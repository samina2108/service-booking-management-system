<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
    
        $services = Service::when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
        ->when($status, function ($query, $status) {
            $query->where('status', $status);
        })
        ->paginate(5)
        ->withQueryString();
    
        return view('services.index', compact('services', 'search', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
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
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'status' => 'required|in:active,inactive',
    ]);

    $service = Service::create($validated);

    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'created',
        'description' => 'Service #' . $service->id . ' was created.',
        'model_type' => Service::class,
        'model_id' => $service->id,
    ]);

    return redirect()
        ->route('services.index')
        ->with('success', 'Service created successfully.');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
 * Display the specified service.
 */
public function show(Service $service)
{
    return view('services.show', compact('service'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
{
    return view('services.edit', compact('service'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);
    
        $service->update($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'updated',
            'description' => 'Service #' . $service->id . ' was updated.',
            'model_type' => Service::class,
            'model_id' => $service->id,
        ]); 
    
        return redirect()
            ->route('services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
{   


    if (!auth()->user()->isAdmin()) {
        abort(403, 'Unauthorized');
    }
    $serviceId = $service->id;
    $service->delete();
 

    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'deleted',
        'description' => 'Service #' . $serviceId . ' was deleted.',
        'model_type' => Service::class,
        'model_id' => $serviceId,
    ]);
    

    return redirect()
        ->route('services.index')
        ->with('success', 'Service deleted successfully.');
}
}
