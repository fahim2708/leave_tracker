@extends('layouts.app')

@section('content')
    <div>

        <h1 class="text-center font-bold mb-4 text-2xl text-blue-950">User Management</h1>
        <div class="container mx-auto p-4">
            <form class="text-right">
                <input type="search" class="w-48 px-4 mb-2 py-2 border rounded-md" placeholder="Search User..." name="search"
                    value="{{ request('search') }}">
            </form>
            <div class="overflow-x-auto overflow-y-auto h-svh">
                <table class="table-auto w-full border border-gray-300 text-center">
                    <thead class="bg-gray-700 text-white text-base">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300">User ID</th>
                            <th class="px-4 py-2 border border-gray-300">Employee</br>Name</th>
                            <th class="px-4 py-2 border border-gray-300">Email</th>
                            <th class="px-4 py-2 border border-gray-300">Active</br>Status</th>
                            <th class="px-4 py-2 border border-gray-300">Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700 bg-white text-sm">
                        @if (count($users) > 0)
                            @foreach ($users as $user)
                                <tr>
                                    <td class="border px-4 py-2 border-gray-300">{{ $user->id }}</td>
                                    <td class="border px-4 py-2 border-gray-300">{{ $user->name }}</td>
                                    <td class="border px-4 py-2 border-gray-300">{{ $user->email }}</td>
                                    <td class="border px-4 py-2 border-gray-300">
                                        @if ($user->active_status == 1)
                                            <span class="text-green-600">Active</span>
                                        @else
                                            <span class="text-red-500">Deactivated</span>
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2 border-gray-300">

                                        <div class="mt-4 flex justify-center">
                                            <form action="{{ route('user.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" id="user_id"
                                                    value="{{ $user->id }}">
                                                @if ($user->active_status == 1)
                                                    <button title="Deactivate Now"
                                                        class="px-4 py-2 bg-rose-500 hover:bg-rose-800 text-white rounded mr-4 ">Deactivate</button>
                                                @else
                                                    <button title="Activate Now"
                                                        class="px-4 py-2 bg-emerald-500 hover:bg-emerald-800 text-white rounded mr-4 ">Active</button>
                                                @endif
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="5" class="border px-4 py-2 border-gray-300 text-red-500">No data Found</td>
                        @endif

                    </tbody>

                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
