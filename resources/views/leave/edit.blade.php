@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center">
    <div class="bg-white p-8 rounded shadow-lg w-full max-w-xl">
        <h1 class="text-2xl text-blue-950 font-bold mb-4 text-center">Edit Leave Request</h1>

        <form action="/leave/{{ $leave->id }}" method="POST">
            {{-- {{dd($leave->leave_reason);}} --}}
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="leave_type" class="block text-sm font-medium text-gray-700 mb-2">Select Leave Type</label>
                <select id="leave_type" name="leave_type" class="w-full px-4 py-2 border rounded-md">
                    <option value="Casual Leave" {{  $leave->leave_type =="Casual Leave"  ? 'selected' : '' }}>Casual Leave</option>
                    <option value="Sick Leave" {{  $leave->leave_type =="Sick Leave"  ? 'selected' : '' }}>Sick Leave</option>
                    <option value="Emergency Leave" {{  $leave->leave_type =="Emergency Leave"  ? 'selected' : '' }}>Emergency Leave</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                <input value="{{ \Carbon\Carbon::parse($leave->start_date)->format('Y-m-d') }}" type="date" id="start_date" name="start_date"
                    class="w-full px-4 py-2 border rounded-md @error('start_date')
            border-red-500
        @enderror">
                @error('start_date')
                    <div class="text-red-500 text-xs">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                <input value="{{ \Carbon\Carbon::parse($leave->end_date)->format('Y-m-d') }}" type="date" id="end_date" name="end_date"
                    class="w-full px-4 py-2 border rounded-md @error('end_date')
            border-red-500
        @enderror">
                @error('end_date')
                    <div class="text-red-500 text-xs">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="leave_reason" class="block text-sm font-medium text-gray-700 mb-2">Leave Reason</label>
                <textarea id="leave_reason" name="leave_reason" rows="4"
                    class="w-full px-4 py-2 border rounded-md @error('leave_reason')
            border-red-500
        @enderror">{{$leave->leave_reason}}</textarea>
                @error('leave_reason')
                    <div class="text-red-500 text-xs">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection