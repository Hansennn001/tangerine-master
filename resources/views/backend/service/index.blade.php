@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
        ])
        <a href="{{ route('admin.service.create') }}"
            class="text-white bg-stone-600 border border-stone-600 hover:bg-stone-700 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <i class="fas fa-plus mr-1.5"></i> Add Service
        </a>
    </div>

    <div class="mt-5">
        <div class="relative overflow-x-auto rounded-md bg-white shadow-md">
            <table id="data-table" class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-400">
                <thead class="text-xs text-stone-600 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
                    <tr class="bg-white border-b border-t border-gray-200">
                        <th scope="col" class="px-6 py-4 w-[70px]">
                            No
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-4 w-[500px]">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $service->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $service->description }}
                            </td>
                            <td class="px-6 py-4">
                                <img src="/uploads/services/{{ $service->image }}"
                                    class="size-20 object-cover rounded-md shadow-md">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-5">
                                    <a href="{{ route('admin.service.edit', $service->id) }}"
                                        class="text-sm text-blue-700 poppins-medium hover:underline">
                                        <i class="fa-regular fa-pen-to-square"></i> Edit
                                    </a>
                                    <a href="javascript:void(0)" data-service-id="{{ $service->id }}"
                                        class="btn-delete text-sm text-red-700 poppins-medium hover:underline">
                                        <i class="fa-regular fa-trash"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(".btn-delete").click(deleteService);

        function deleteService() {
            const serviceID = $(this).data("service-id");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('admin.service.destroy', ':id') }}`.replace(':id', serviceID),
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Deleting...',
                                text: 'Please wait...',
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            });
                        },
                        success: function(data) {
                            location.reload();
                        },
                    });
                }
            });
        }
    </script>
@endsection
