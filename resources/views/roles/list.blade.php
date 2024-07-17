<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles') }}
            </h2>
            <a href="{{ route('roles.create') }}"
                class="bg-slate-700 text-sm rounded-md text-white px-2 py-2">Create</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>

            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left" width="60">#</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Permissions</th>
                        <th class="px-6 py-3 text-left" width="180">Created</th>
                        <th class="px-6 py-3 text-center" width="180">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($roles->isNotEmpty())
                        @foreach ($roles as $role)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-left">{{ $role->id }}</td>
                                <td class="px-6 py-3 text-left">{{ $role->name }}</td>
                                <td class="px-6 py-3 text-left">{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                                <td class="px-6 py-3 text-left">
                                    {{ \Carbon\Carbon::parse($role->created_at)->format('d-M-Y') }}</td>
                                <td class="px-6 py-3 text-left">
                                    <a href="{{ route('roles.edit', $role->id) }} "
                                        class="bg-slate-700 text-sm rounded-md text-white px-2 py-2 hover:bg-slate-600">Edit</a>
                                    <a href="javascript:void(0)" onclick="deleterole({{$role->id}})"
                                        class="bg-red-700 text-sm rounded-md text-white px-2 py-2 hover:bg-red-600">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="my-3">
                {{-- {{ $Roles->links() }} --}}
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script>
            function deleterole(id) {
                if (confirm("Are you sure you want to delete?")) {
                    $.ajax({
                        url: '{{ route('roles.destroy') }}',
                        type: 'delete',
                        data: {
                            id: id
                        },
                        headers:{
                            'X-CSRF-TOKEN': '{{ csrf_token()}}'
                        },
                        dataType: 'json',
                        success: function(response) {
                            window.location.href = "{{route('roles.index')}}"
                        }
                    })
                }
            }
        </script>
    </x-slot>
</x-app-layout>
