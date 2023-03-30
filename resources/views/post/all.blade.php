<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts list') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">

                        <div class="row height d-flex justify-content-center align-items-center">

                            <div class="col-md-6">
                                <form method="get" action="{{ route('all.index') }}">
                                    <div class="form">
                                        <i class="fa fa-search"></i>
                                        <input type="search" name="search" value="{{request('search')}}"
                                               class="form-control form-input" placeholder="Search posts...">
                                        <span>
                                            <button type="submit" class="btn btn-outline-primary mt-2">search</button>
                                        </span>
                                    </div>
                                </form>

                                <table>
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="pl-10">Content</th>
                                        <th class="pl-10">Publication date</th>
                                        <th class="pl-10">Published by</th>
                                        <th class="pl-4">Image</th>


                                    </tr>

                                    </thead>
                                    <tbody>

                                    @foreach($posts as $post)
                                        <tr>
                                            <td>{{ $post->title }}</td>
                                            <td class="pl-10 pb-2">{{ $post->content }}</td>
                                            <td class="pl-10">{{ $post->created_at }}</td>
                                            <td class="pl-10">{{ $post->user->name }}</td>
                                            <td class="pl-10"><img src="{{asset('images/'. $post->image_path )}}"></td>

                                            <td class="pl-10"><img src="{{asset('images/' . $post->image_path)}}"></td>


                                            <td>
                                                <div>
                                                    <form method="POST" action="{{route('comment',$post->id) }}">
                                                        @csrf

                                                        <div>
                                                            <label for="comment"
                                                                   class="block font-medium text-sm text-gray-700 dark:text-gray-300">Comment:</label>
                                                            <textarea id="comment"
                                                                      class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                                                      name="comment"></textarea>
                                                        </div>

                                                        <button type="submit"
                                                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                            Submit Comment
                                                        </button>
                                                    </form>
                                                </div>


                                @endforeach


                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
</x-app-layout>


