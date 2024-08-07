<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('Tag management') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto">
            <div class="">

                <div class="p-6 text-gray-900">
                    <div class="mb-5">
                        <x-btn href="{{route('tag.create')}}" color="blue">
                            Create new tag
                        </x-btn>
                        <x-btn href="#" color="red" id="delete_selected_tags">
                            Delete selected tags
                        </x-btn>
                    </div>
                    <div class="relative">
                        <table class="mb-3 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        <input type="checkbox" name="ids" id="select_all_tags">
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
                                @foreach ($tags as $tag)
                                <tr
                                    class="checkbox-{{$tag->id}} odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700"
                                >
                                    <th class="px-6 py-4">
                                        <input type="checkbox" name="ids" class="checkbox_ids" value="{{$tag->id}}">
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$tag->id}}
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <span style="background-color: {{$tag->color}}" class="inline-block text-white px-3 py-1">
                                            {{$tag->name}}
                                        </span>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$tag->created_at}}
                                    </td>

                                    <td class="px-6 py-4">
                                        <x-dropdown>
                                            <x-slot name="trigger" class="rounded bg-gray-700 cursor-pointer">
                                                Action
                                            </x-slot>
                                            <x-slot name="content">
                                                <x-dropdown-link :href="route('tag.edit', $tag->id)">
                                                    Update
                                                </x-dropdown-link>
                                                <form action="{{route('tag.destroy', $tag->id)}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <input
                                                    class="cursor-pointer block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                                    type="submit" value="Delete" onclick="sure()">
                                                </form>
                                            </x-slot>
                                        </x-dropdown>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$tags->links()}}
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

    $(function(e) {
        $('#select_all_tags').click(function() {
            $('.checkbox_ids').prop('checked', $(this).prop('checked'));
        });

        $('#delete_selected_tags').click(function (event) {
            event.preventDefault();
            let all_ids = [];
            $('.checkbox_ids:checked').each(function () {
                all_ids.push($(this).val());
            });
            console.log(all_ids);

            $.ajax({
                url : "{{route('tag.deletemany')}}",
                method : "DELETE",
                data : {
                    ids: all_ids,
                    _token : "{{csrf_token()}}",
                },
                success: function(respone) {
                    $.each(all_ids, function(key, value) {
                        $('.checkbox-' + value).remove();
                    });
                },
            });

        })
    })
</script>


