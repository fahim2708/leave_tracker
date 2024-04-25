<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        return view('leave.index');
    }

    public function create()
    {
        return view('leave.create');
    }

    public function store(Request $request)
    {

        $validator = $request->validate([
            'leave_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'leave_reason' => 'required',
        ]);
        DB::beginTransaction();
        try {

            $employee = Employee::where('user_id', '=', Auth::user()->id)->first();

            $startDate = new \DateTime($request->start_date);
            $endDate = new \DateTime($request->end_date);
            $interval = $startDate->diff($endDate);
            $total_leave_days = $interval->days;


            $data = new LeaveRequest();

            $data->employee_id = $employee->id;
            $data->leave_type = $request->leave_type;
            $data->applied_on = date('Y-m-d');
            $data->start_date       = $request->start_date;
            $data->end_date         = $request->end_date;
            $data->total_leave_days = $total_leave_days;
            $data->leave_reason     = $request->leave_reason;

            $data->save();

            DB::commit();

            return redirect('leave')->with('success', 'Applied Leave Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error');
        }
    }
}
