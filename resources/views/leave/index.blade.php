@extends('layouts.app')

@section('content')
    <div>
        @if (auth()->user()->type == 'admin')
            <h1 class="text-center font-bold mb-4 text-2xl text-blue-950">Leave History</h1>
        @else
            <h1 class="text-center font-bold mb-4 text-2xl text-blue-950">My Leave History</h1>
        @endif
        <div class="container mx-auto p-4">
            <div class="overflow-x-auto overflow-y-auto h-svh">
                <table class="table-auto w-full border border-gray-300 text-center">
                    <thead class="bg-gray-700 text-white text-base">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300">SN</th>
                            @if (auth()->user()->type == 'admin')
                                <th class="px-4 py-2 border border-gray-300">Employee</br>Name</th>
                            @endif
                            <th class="px-4 py-2 border border-gray-300">Leave</br>Type</th>
                            <th class="px-4 py-2 border border-gray-300">Applied On</th>
                            <th class="px-4 py-2 border border-gray-300">Start Date</th>
                            <th class="px-4 py-2 border border-gray-300">End Date</th>
                            <th class="px-4 py-2 border border-gray-300">Total</br>Leave</br>Days</th>
                            <th class="px-4 py-2 border border-gray-300">Leave</br>Reason</th>
                            <th class="px-4 py-2 border border-gray-300">Status</th>
                            <th class="px-4 py-2 border border-gray-300">Remarks</th>
                            <th class="px-4 py-2 border border-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 bg-white text-sm">
                        @php
                            $sn = 1;
                        @endphp
                        @foreach ($datas as $data)
                            <tr>

                                <td class="border px-4 py-2 border-gray-300">{{ $sn++ }}</td>
                                @if (\Auth::user()->type == 'admin')
                                    <td class="border px-4 py-2 border-gray-300">{{ $data->employees->name }}
                                    </td>
                                @endif
                                <td class="border px-4 py-2 border-gray-300">{{ $data->leave_type }}</td>
                                <td class="border px-4 py-2 border-gray-300 min-w-28">{{ $data->applied_on->format('d-m-Y') }}</td>
                                <td class="border px-4 py-2 border-gray-300 min-w-28">{{ $data->start_date->format('d-m-Y') }}</td>
                                <td class="border px-4 py-2 border-gray-300 min-w-28">{{ $data->end_date->format('d-m-Y') }}</td>
                                <td class="border px-4 py-2 border-gray-300">{{ $data->total_leave_days }}</td>
                                @php
                                    $leave_reason = substr($data->leave_reason, 0, 15);
                                @endphp
                                <td class="border px-4 py-2 border-gray-300">{{ $leave_reason }}</td>
                                <td class="border px-4 py-2 border-gray-300">
                                    @if ($data->status == 2)
                                        <span class="text-blue-600">Pending</span>
                                    @elseif($data->status == 1)
                                        <span class="text-green-600">Accepted</span>
                                    @else
                                        <span class="text-red-500">Rejected</span>
                                    @endif
                                </td>
                                <td class="border px-4 py-2 border-gray-300">{{ $data->remark }}</td>
                                <td class="border px-4 py-2 border-gray-300">
                                    @if (auth()->user()->type != 'admin')
                                        @if ($data->status == 2)
                                            <a href="#"
                                                class="inline-flex items-center px-2 py-2 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 m-2">
                                                <i class="fas fa-edit mr-2"></i>Edit
                                            </a>
                                        @else
                                        @endif
                                    @else
                                        @if ($data->status == 2)
                                        <a href="{{ URL::to('leave/' . $data->id . '/action') }}" 
                                            class="mx-3 inline-flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold px-3  rounded-md"
                                            title="Leave Action">
                                            <i class="text-white text-4xl fa-solid fa-caret-right"></i>
                                         </a>
                                        @else
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
