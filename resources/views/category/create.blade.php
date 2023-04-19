<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New post ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{route('category.store')}}" enctype="multipart/form-data">
                        @csrf
                        Category Name
<br>

                        <input type="text" name="name"
                               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-smphp artisan serve"
                               required/>

                        <br>
                        <br>
                        Category Image

                        <div class="col-md-12  mb-3 d-flex flex-column">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image_category" class="form-control rounded border border-secondary mr-2">
                            <small class="text-danger">{{ $errors->first('image') }}</small>
                        </div>

                        <button
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Sumbit
                        </button>
                    </form>
                </div
            </div>
        </div>
    </div>
</x-app-layout>
