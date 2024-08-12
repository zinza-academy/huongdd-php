<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('Company management') }}
        </h2>
    </x-slot>
    {{-- @dd($companies) --}}
    <div class="">
        <div class="mx-auto">
            <div class="">

                <div class="p-6 text-gray-900">
                    <div class="mb-5">
                        <a href="{{route('company.create')}}" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Create company</a>
                    </div>
                    <div class="relative">
                        <table class="mb-3 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Company Account
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Company Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Number of users
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        @if (isset($company->user->name))
                                             {{$company->user->name}}
                                        @endif
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$company->name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($company->status === 'active')
                                            <span class="text-white bg-green-500 px-2 py-1">Active</span>
                                        @else
                                            <span class="text-white bg-red-500 px-2 py-1">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-white bg-fuchsia-700 px-2 py-1">
                                            {{$company->max_users}}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if (!$company->is_admin && !$company->deleted_at)
                                            <x-dropdown>
                                                <x-slot name="trigger" class="rounded bg-gray-700 cursor-pointer">
                                                    Action
                                                </x-slot>
                                                <x-slot name="content">
                                                    <x-dropdown-link :href="route('company.edit', $company->id)">
                                                        Update
                                                    </x-dropdown-link>
                                                    <form action="{{route('company.destroy', $company->id)}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <input
                                                        class="cursor-pointer block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                                        type="submit" value="Delete" onclick="return sure()">
                                                    </form>
                                                </x-slot>
                                            </x-dropdown>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$companies->onEachSide(Config::get('constants.ON_EACH_SIDE'))->links(Config::get('constants.PAGINATE_VIEW'))}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


