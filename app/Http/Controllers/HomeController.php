<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $totalLeaveRequest = LeaveRequest::count();
        $totalPendingRequest = LeaveRequest::where('status', 2)->count();
        $totalApprovedRequest = LeaveRequest::where('status', 1)->count();
        $totalRejectedRequest = LeaveRequest::where('status', 3)->count();

        $employees = Employee::all();
        $datas = LeaveRequest::with('employees')->where('status', 2)->get();


        return view('home', compact('totalLeaveRequest', 'totalPendingRequest', 'totalApprovedRequest', 'totalRejectedRequest', 'datas'));
    }
}
