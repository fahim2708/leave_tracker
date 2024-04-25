@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-center font-bold mb-4 text-2xl text-blue-950">Leave History</h1>
        <div class="container mx-auto p-4">
            <div class="overflow-x-auto">
                <table class="table-auto w-full border border-gray-300">
                    <thead class="bg-gray-700 text-white text-base">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300">SN</th>
                            @if (\Auth::user()->type == 'admin')
                                <th class="px-4 py-2 border border-gray-300">Employee Name</th>
                            @endif
                            <th class="px-4 py-2 border border-gray-300">Leave Type</th>
                            <th class="px-4 py-2 border border-gray-300">Applied On</th>
                            <th class="px-4 py-2 border border-gray-300">Start Date</th>
                            <th class="px-4 py-2 border border-gray-300">End Date</th>
                            <th class="px-4 py-2 border border-gray-300">Total Leave Days</th>
                            <th class="px-4 py-2 border border-gray-300">Leave Reason</th>
                            <th class="px-4 py-2 border border-gray-300">Remarks</th>
                            <th class="px-4 py-2 border border-gray-300">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 bg-white text-sm">
                        <tr>
                            <td class="border px-4 py-2 border-gray-300">1</td>
                            @if (\Auth::user()->type == 'admin')
                                <td class="border px-4 py-2 border-gray-300">Doe</td>
                            @endif
                            <td class="border px-4 py-2 border-gray-300">Doe</td>
                            <td class="border px-4 py-2 border-gray-300">john@example.com</td>
                            <td class="border px-4 py-2 border-gray-300">1</td>
                            <td class="border px-4 py-2 border-gray-300">John</td>
                            <td class="border px-4 py-2 border-gray-300">Doe</td>
                            <td class="border px-4 py-2 border-gray-300">john@example.com</td>
                            <td class="border px-4 py-2 border-gray-300">john@example.com</td>
                            <td class="border px-4 py-2 border-gray-300">john@example.com</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
