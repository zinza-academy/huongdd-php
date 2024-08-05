<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('Topic / Create') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-6 text-gray-900">
                    <form action="{{route('topic.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-5">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-60" type="text" name="name"/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <input type="submit" class="bg-blue-300 rounded py-1 px-4 mt-5 cursor-pointer" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    option = {
        enableTime: true,
        dateFormat: "Y-m-d H:i"
    };
    $("#datepicker").flatpickr(option);
</script>
