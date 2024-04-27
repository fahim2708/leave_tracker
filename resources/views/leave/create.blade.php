@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center">
        <div class="bg-white p-8 rounded shadow-lg w-full max-w-xl">
            <h1 class="text-2xl text-blue-950 font-bold mb-4 text-center">Leave Request Form</h1>

            <form action="{{ route('store-leave') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="leave_type" class="block text-sm font-medium text-gray-700 mb-2">Select Leave Type</label>
                    <select id="leave_type" name="leave_type" class="w-full px-4 py-2 border rounded-md">
                        <option value="Casual Leave">Casual Leave</option>
                        <option value="Sick Leave">Sick Leave</option>
                        <option value="Emergency Leave">Emergency Leave</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                    <input type="date" id="start_date" name="start_date"
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
                    <input type="date" id="end_date" name="end_date"
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
            @enderror"></textarea>
                    @error('leave_reason')
                        <div class="text-red-500 text-xs">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
