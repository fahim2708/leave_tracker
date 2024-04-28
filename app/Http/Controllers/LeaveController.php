<?php

namespace App\Http\Controllers;

use App\Mail\LeaveRequestApprovalNotification;
use App\Mail\LeaveRequestNotification;
use App\Mail\LeaveRequestRejectionNotification;
use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LeaveController extends Controller
{
    public function index()
    {

        if (auth()->user()->type != 'admin') {
            $employees = Employee::where('user_id', '=', auth()->user()->id)->pluck('id');
            $datas   = LeaveRequest::where('employee_id', '=', $employees)->orderBy('id', 'desc')->get();
        } else {
            $employees = Employee::all();
            $datas = LeaveRequest::with('employees')->orderBy('id', 'desc')->get();
        }

        return view('leave.index', compact('datas', 'employees'));
    }

    public function create()
    {
        return view('leave.create');
    }

    public function edit($id)
    {
        $leave = LeaveRequest::find($id);
        return view('leave.edit', compact('leave'));
    }
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'leave_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'leave_reason' => 'required',
        ]);
        DB::beginTransaction();
        try {
            //Calculate total leave days
            $startDate = new \DateTime($request->start_date);
            $endDate = new \DateTime($request->end_date);

            $interval = $startDate->diff($endDate);
            $total_leave_days = $interval->days + 1;

            //Update Leave Request
            $leave = LeaveRequest::find($id);

            $leave->leave_type = $request->leave_type;
            $leave->start_date = $request->start_date;
            $leave->end_date = $request->end_date;
            $leave->leave_reason = $request->leave_reason;
            $leave->total_leave_days = $total_leave_days;

            $leave->save();

            DB::commit();

            return redirect('/leave')->with('success', 'Leave Request Updated Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error');
        }
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
            $total_leave_days = $interval->days + 1;

            //Store a new leave
            $data = new LeaveRequest;

            $data->employee_id = $employee->id;
            $data->leave_type = $request->leave_type;
            $data->applied_on = date('Y-m-d');
            $data->start_date       = $request->start_date;
            $data->end_date         = $request->end_date;
            $data->total_leave_days = $total_leave_days;
            $data->leave_reason     = $request->leave_reason;

            $data->save();

            // Send email notification
            $recipientEmail = $employee->email;
            Mail::to($recipientEmail)->send(new LeaveRequestNotification($data, $employee));

            DB::commit();

            return redirect('leave')->with('success', 'Applied Leave Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error');
        }
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

        $employee  = Employee::find($leave->employee_id);


        // Send email notification
        if ($request->status == 1) {
            $recipientEmail = $employee->email;
            Mail::to($recipientEmail)->send(new LeaveRequestApprovalNotification($leave, $employee));
        } else {
            $recipientEmail = $employee->email;
            Mail::to($recipientEmail)->send(new LeaveRequestRejectionNotification($leave, $employee));
        }


        return redirect('leave');
    }
}
