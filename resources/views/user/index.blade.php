<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('User management') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto">
            <div class="">
                <div class="p-6 text-gray-900">
                    <div class="relative">
                        <table class="mb-3 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        DOB
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Role
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allUsers as $user)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$user->name}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$user->dob}}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-white bg-green-500 px-2 py-1">Actice</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($user->is_admin)
                                            <span class="text-white bg-fuchsia-700 px-2 py-1">Admin</span>
                                        @elseif ($user->role)
                                            <span class="text-white bg-cyan-700 px-2 py-1">Company account</span>
                                        @else
                                            <span class="text-white bg-indigo-700 px-2 py-1">Member</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if (!$user->is_admin)
                                            <x-dropdown>
                                                <x-slot name="trigger" class="rounded bg-gray-700 cursor-pointer">
                                                    Action
                                                </x-slot>
                                                <x-slot name="content">
                                                    <x-dropdown-link :href="route('user.view', $user->id)">
                                                        Update
                                                    </x-dropdown-link>
                                                    <form action="{{route('user.delete', $user->id)}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <input
                                                        class="cursor-pointer block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                                        type="submit" value="Delete" onclick="sure()">
                                                    </form>
                                                </x-slot>
                                            </x-dropdown>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$allUsers->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function sure() {
        confirm('Are use sure to delete this record?');
    }
</script>


