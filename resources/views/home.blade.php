@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-9/12 p-6 bg-white rounded-lg">
            @if (auth()->user()->type == 'employee')
                <div class="text-center text-2xl">
                    <h1>
                        Welcome, <span class="font-bold">{{ auth()->user()->name }}</span>
                    </h1>
                </div>
            @else
                <div>
                    <div class="flex justify-between p-8">
                        <div class="grid grid-cols-4 gap-4">
                            <div class="bg-blue-300 rounded-lg shadow-md p-4 text-center">
                                <h2 class="text-lg font-semibold mb-2">Total Leave Request</h2>
                                <hr>
                                <p class="text-3xl">{{ $totalLeaveRequest }}</p>
                            </div>
                            <div class="bg-orange-300 rounded-lg shadow-md p-4 text-center">
                                <h2 class="text-lg font-semibold mb-2">Total Pending Request</h2>
                                <hr>
                                <p class="text-3xl">{{ $totalPendingRequest }}</p>
                            </div>
                            <div class="bg-green-300 rounded-lg shadow-md p-4 text-center">
                                <h2 class="text-lg font-semibold mb-2">Total Approved Request</h2>
                                <hr>
                                <p class="text-3xl">{{ $totalApprovedRequest }}</p>
                            </div>
                            <div class="bg-red-300 rounded-lg shadow-md p-4 text-center">
                                <h2 class="text-lg font-semibold mb-2">Total Rejected Request</h2>
                                <hr>
                                <p class="text-3xl">{{ $totalRejectedRequest }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="p-8">
                        <h1 class="mb-3 text-center text-xl text-red-500">Pending Leave Request</h1>
                        <div class="overflow-x-auto overflow-y-auto h-64 ">
                        <table class="table-auto min-w-full border border-gray-200">
                            <thead>
                                @php
                                    $sn = 1;
                                @endphp
                                 
                                <tr>
                                    <th class="px-4 py-2 bg-gray-100 border border-gray-200">SN</th>
                                    <th class="px-4 py-2 bg-gray-100 border border-gray-200">Employee</br>Name</th>
                                    <th class="px-4 py-2 bg-gray-100 border border-gray-200">Leave</br>Type</th>
                                    <th class="px-4 py-2 bg-gray-100 border border-gray-200">Start Date</th>
                                    <th class="px-4 py-2 bg-gray-100 border border-gray-200">End date</th>
                                    <th class="px-4 py-2 bg-gray-100 border border-gray-200">Total</br>Leave</br>Days</th>
                                    <th class="px-4 py-2 bg-gray-100 border border-gray-200">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td class="px-4 py-2 border border-gray-200">{{$sn++}}</td>
                                    <td class="px-4 py-2 border border-gray-200">{{ $data->employees->name }}</td>
                                    <td class="px-4 py-2 border border-gray-200">{{ $data->leave_type }}</td>
                                    <td class="px-4 py-2 border border-gray-200">{{ $data->start_date->format('d-m-Y') }}</td>
                                    <td class="px-4 py-2 border border-gray-200">{{ $data->end_date->format('d-m-Y') }}</td>
                                    <td class="px-4 py-2 border border-gray-200">{{ $data->total_leave_days }}</td>
                                    <td class="px-4 py-2 border border-gray-200">
                                        <a href="{{ URL::to('leave/' . $data->id . '/action') }}" 
                                            class="mx-3 inline-flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold px-3  rounded-md"
                                            title="Leave Action">
                                             <i class="text-white text-xl fa-solid fa-caret-right"></i>
                                         </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
