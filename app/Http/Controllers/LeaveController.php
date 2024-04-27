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

        if (auth()->user()->type != 'admin') {
            $employees = Employee::where('user_id', '=', auth()->user()->id)->pluck('id');
            $datas   = LeaveRequest::where('employee_id', '=', $employees)->get();
        }
        else{
            $employees = Employee::all();
            $datas = LeaveRequest::with('employees')->get();
        }
        
        return view('leave.index', compact('datas', 'employees'));
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

            //Calculate total leave days
            $startDate = new \DateTime($request->start_date);
            $endDate = new \DateTime($request->end_date);

            $interval = $startDate->diff($endDate);
            $total_leave_days = $interval->days;

            //Store a new leave
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

    public function show()
    {
        

    }

    public function action($id)
    {
        $leave     = LeaveRequest::find($id);
        $employee  = Employee::find($leave->employee_id);

        return view('leave.action', compact('employee', 'leave'));
    }

    public function changeaction(Request $request)
    {
        $leave = LeaveRequest::find($request->leave_id); 
        $leave->remark  = $request->remarks;
        $leave->status  = $request->status;

        $leave->save();

        return redirect('leave');

    }
}
