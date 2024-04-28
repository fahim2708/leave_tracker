@extends('layouts.app')

@section('content')
    <div>

        <h1 class="text-center font-bold mb-4 text-2xl text-blue-950">User Management</h1>
        <div class="container mx-auto p-4">
            <div class="overflow-x-auto">
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
                                    {{-- <button onclick="changeStatus({{ $user->id }}, {{ $user->active_status }});"
                                        id="changeStatusBtn"
                                        class="px-2 py-1 bg-blue-500 hover:bg-blue-800 rounded text-white"
                                        title="Change Active Status"><i class="fa-solid fa-right-left"></i></button> --}}
                                    <button onclick="openConfirmModal({{ $user->id }})" id="changeStatusBtn"
                                        class="px-2 py-1 bg-blue-500 hover:bg-blue-800 rounded text-white"
                                        title="Change Active Status">
                                        <i class="fa-solid fa-right-left"></i>
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <!-- Confirm Modal -->
    <div id="confirmModal" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 hidden">
        <div class="flex justify-center items-center h-full">
            <div class="bg-white rounded p-6">
                <p>Are you sure you want to change the user's active status?</p>
                <div class="mt-4 flex justify-center">
                    <button onclick="changeStatus({{ $user->id }})"
                        class="px-4 py-2 bg-blue-500 hover:bg-blue-800 text-white rounded mr-4">Yes</button>
                    <button onclick="closeConfirmModal()"
                        class="px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white rounded">No</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Function to open confirm modal
        function openConfirmModal(userId) {
            document.getElementById('confirmModal').classList.remove('hidden');
            // You can store the userId somewhere accessible for use in the changeStatus function
            // For simplicity, we'll just set a data attribute on the modal
            document.getElementById('confirmModal').setAttribute('data-user-id', userId);
        }

        // Function to close confirm modal
        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }

        // Function to change status
        function changeStatus(userId) {
            var userId = document.getElementById('confirmModal').getAttribute('data-user-id');
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            // console.log(userId);

            //  AJAX POST request
            $.ajax({
                url: "{{ route('update.status') }}", // Laravel route
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
                },
                data: {
                    userId: userId // Data to be sent
                },
                success: function(response) {
                    // Handle success response
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(error);
                }
            });

            closeConfirmModal();

        }
    </script>
@endsection
