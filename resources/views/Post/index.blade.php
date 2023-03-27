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
                    <a href="{{route('post.create')}}"> Add new post</a>


                    <div class="container">

                        <div class="row height d-flex justify-content-center align-items-center">

                            <div class="col-md-6">
                                <form method="get" action="{{ route('post.index') }}">
                                    <div class="form">
                                        <i class="fa fa-search"></i>
                                        <input type="search" name="search" value="{{request('search')}}"
                                               class="form-control form-input" placeholder="Search posts...">
                                        <span>
                                            <button type="submit" class="btn btn-outline-primary mt-2">search</button>
                                        </span>
                                    </div>
                                </form>

                            </div>

                        </div>

                    </div>


                    <br> <br>

                    <table>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th class="pl-6">Content</th>
                            <th class="pl-4">Publication date</th>


                            <th></th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td class="pl-4">{{$post->content}}</td>
                                <td class="pl-4 font-semibold">{{$post->created_at}}</td>

                                <td><a href="{{ route('post.edit', $post) }}"
                                       class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full ml-4">
                                        Edit</a></td>


                                <form method="POST" action="{{route('post.destroy',$post)}}">
                                    @csrf
                                    @method('Delete')

                                    <td>
                                        <button type="submit" onclick="return confirm('Are you sure ?')"
                                                class="btn btn-danger" style="border-radius:25px; ">

                                            Delete
                                        </button>
                                    </td>

                                </form>


                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
