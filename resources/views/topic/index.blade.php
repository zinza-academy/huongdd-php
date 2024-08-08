<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('Topic management') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto">
            <div class="">

                <div class="p-6 text-gray-900">
                    <div class="mb-5">
                        <x-btn href="{{route('topic.create')}}" color="blue">
                            Create new topic
                        </x-btn>
                        <x-btn href="#" color="red" id="delete_selected_topics">
                            Delete selected topics
                        </x-btn>
                    </div>
                    <div class="relative">
                        <table class="mb-3 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        <input type="checkbox" name="ids" id="select_all_topics">
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date created
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topics as $topic)
                                <tr
                                    class="checkbox-{{$topic->id}} odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700"
                                >
                                    <th class="px-6 py-4">
                                        <input type="checkbox" name="ids" class="checkbox_ids" value="{{$topic->id}}">
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$topic->id}}
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$topic->name}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$topic->created_at}}
                                    </td>

                                    <td class="px-6 py-4">
                                        <x-dropdown>
                                            <x-slot name="trigger" class="rounded bg-gray-700 cursor-pointer">
                                                Action
                                            </x-slot>
                                            <x-slot name="content">
                                                <x-dropdown-link :href="route('topic.edit', $topic->id)">
                                                    Update
                                                </x-dropdown-link>
                                                <form action="{{route('topic.destroy', $topic->id)}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <input
                                                    class="cursor-pointer block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                                    type="submit" value="Delete" onclick="return sure()">
                                                </form>
                                            </x-slot>
                                        </x-dropdown>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$topics->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    deleteMany('topics', "{{route('topic.deletemany')}}")
</script>


