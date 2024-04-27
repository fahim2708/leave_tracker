@extends('layouts.app')
@section('content')
<form action="{{ route('leave.changeaction') }}" method="POST">
    @csrf
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
        <div class="grid grid-cols-1 gap-y-4">
            <div>
                <h1 class="text-center font-bold mb-4 text-2xl text-blue-950">Manage Leave</h1>
                <table class="min-w-full divide-y divide-gray-200">
                    <tr>
                        <th class="px-2 py-2 text-start border border-gray-300">Employee Name: </th>
                        <td class="px-2 py-2 border border-gray-300 text-sm">{{$employee->name}}</td>
                    </tr>
                    <tr>
                        <th class="px-2 py-2 text-start border border-gray-300">Leave Type: </th>
                        <td class="px-2 py-2 border border-gray-300 text-sm">{{$leave->leave_type}}</td>
                    </tr>
                    <tr>
                        <th class="px-2 py-2  text-start border border-gray-300">Applied On: </th>
                        <td class="px-2 py-2 border border-gray-300 text-sm">{{$leave->applied_on->format('d-m-Y')}}</td>
                    </tr>
                    <tr>
                        <th class="px-2 py-2  text-start border border-gray-300">Start Date: </th>
                        <td class="px-2 py-2 border border-gray-300 text-sm">{{$leave->start_date->format('d-m-Y')}}</td>
                    </tr>
                    <tr>
                        <th class="px-2 py-2  text-start border border-gray-300">End Date: </th>
                        <td class="px-2 py-2 border border-gray-300 text-sm">{{$leave->end_date->format('d-m-Y')}}</td>
                    </tr>
                    <tr>
                        <th class="px-2 py-2  text-start border border-gray-300">Total Leave Days: </th>
                        <td class="px-2 py-2 border border-gray-300 text-sm">{{$leave->total_leave_days}}</td>
                    </tr>
                    <tr>
                        <th class="px-2 py-2  text-start border border-gray-300">Leave Reason: </th>
                        <td class="px-2 py-2 border border-gray-300 text-sm">{{ !empty($leave->leave_reason) ? $leave->leave_reason : '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-2 py-2  text-start border border-gray-300">Remarks: </th>
                        <td class="px-2 py-2 border border-gray-300">
                            <textarea class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 bg-gray-200" name="remarks" rows="3"></textarea>
                        </td>
                    </tr>
                    <input type="hidden" value="{{ $leave->id }}" name="leave_id">
                </table>
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded-md mr-2 hover:bg-emerald-00" value="1" name="status">Approve</button>
            <button type="submit" class="bg-rose-500 text-white px-4 py-2 rounded-md hover:bg-rose-600" value="3" name="status">Reject</button>
        </div>
    </div>
</form>
@endsection
