<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        // Users for filter dropdown
        $users = User::orderBy('name')->get();

        // Activity logs query
        $query = ActivityLog::with('user')->latest();

        // User filter
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Action filter
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Date filter
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('description', 'like', '%' . $search . '%')
                  ->orWhere('action', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', '%' . $search . '%');
                  });

            });
        }

        // Pagination
        $logs = $query
            ->paginate(15)
            ->withQueryString();

            $totalLogs = ActivityLog::count();

$createdLogs = ActivityLog::where('action', 'created')->count();

$updatedLogs = ActivityLog::where('action', 'updated')->count();

$deletedLogs = ActivityLog::where('action', 'deleted')->count();

        return view('activity_logs.index', compact(
            'logs',
            'users',
            'totalLogs',
    'createdLogs',
    'updatedLogs',
    'deletedLogs',
        ));
    }


    public function show(ActivityLog $activityLog)
{
    $activityLog->load('user');

    return view('activity_logs.show', compact('activityLog'));
}

public function destroy(ActivityLog $activityLog)
{
    $activityLog->delete();

    return redirect()
        ->route('activity_logs.index')
        ->with('success', 'Activity log deleted successfully.');
}


public function export(Request $request)
{
    $query = ActivityLog::with('user')->latest();

    // User filter
    if ($request->filled('user_id')) {
        $query->where('user_id', $request->user_id);
    }

    // Action filter
    if ($request->filled('action')) {
        $query->where('action', $request->action);
    }

    // Date filter
    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    // Search
    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('description', 'like', '%' . $search . '%')
              ->orWhere('action', 'like', '%' . $search . '%')
              ->orWhereHas('user', function ($userQuery) use ($search) {
                  $userQuery->where('name', 'like', '%' . $search . '%');
              });

        });
    }

    $logs = $query->get();

    $filename = 'activity_logs_export_' . now()->format('Y-m-d_H-i-s') . '.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ];

    $columns = [
        'ID',
        'User',
        'Action',
        'Description',
        'Model Type',
        'Model ID',
        'Date & Time',
    ];

    $callback = function () use ($logs, $columns) {

        $file = fopen('php://output', 'w');

        // CSV Header
        fputcsv($file, $columns);

        // CSV Data
        foreach ($logs as $log) {

            fputcsv($file, [
                $log->id,
                $log->user ? $log->user->name : 'Deleted User',
                ucfirst($log->action),
                $log->description,
                $log->model_type
                    ? class_basename($log->model_type)
                    : 'N/A',
                $log->model_id ?? 'N/A',
                $log->created_at
                    ? $log->created_at->format('d M Y, h:i A')
                    : 'N/A',
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

}