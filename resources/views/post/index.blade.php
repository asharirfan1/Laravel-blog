<x-app-layout>
    <script type="text/javascript" src="/test/wp-content/themes/child/script/jquery.jcarousel.min.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts list') }}
        </h2>

    </x-slot>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{route('post.create')}}"> Add new post</a>
                    <br>
                    <br>

                    <a href="{{route('all.index')}}"> View All posts</a>


                    <div class="container">

                        <div class="row height d-flex justify-content-center align-items-center">

                            <div class="col-md-6">
                                <form method="GET" id="selectForm" action="{{ route('post.index') }}">
                                    <div class="form">
                                        <i class="fa fa-search"></i>
                                        <input type="search" name="search" value="{{request('search')}}"
                                               class="form-control form-input" placeholder="Search posts...">

                                        {{-- filter multiple category select2--}}

                                        <select class="js-example-basic-multiple form-control pt-4" name="category_id[]"
                                                multiple onchange="document.getElementById('selectForm').submit()">
                                            @foreach($categories as $category)
                                                <option
                                                    value="{{ $category->id }}" {{ in_array($category->id, (array) request('category_id')) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>


                                        {{--filer dropdow for tags --}}

                                        <select class="js-example-basic-multiple-tags form-control" name="tag_id[]"
                                                multiple onchange="document.getElementById('selectForm').submit()">
                                            @foreach($tags as $tag)

                                                <option
                                                    value="{{$tag->id}}" {{in_array($tag->id ,(array) request('$tag_id')) ? 'selected' : ''}}>
                                                    {{$tag->tag_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                            </div>

                            <span>
                                            <button type="submit" class="btn btn-outline-primary mt-2">search</button>
                                        </span>
                        </div>
                        </form>

                    </div>

                </div>

                                                            <div>

            </div>







            <br> <br>


            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th class="pl-6">Content</th>
                    <th class="pl-4">Publication date</th>
                    <th class="pl-4">Tags</th>
                    <th class="pl-4">Category</th>
{{--                    <th class="pl-4">Category Image</th>--}}
                    <th class="pl-4">Post Image</th>



                    <th></th>
                </tr>

                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->title}}</td>
                        <td class="pl-4">{{$post->content}}</td>
                        <td class="pl-4 font-semibold">{{$post->created_at}}</td>

                        <td>
                            @foreach($post->tags as $tag)
                                <span class=" pl-10 whitespace-nowrap">{{$tag->tag_name}}</span>
                            @endforeach
                        </td>

                        <td>
                            @foreach($post->categories as $category)
                                <span class=" pl-10 whitespace-nowrap">{{$category->name}}</span>
                            @endforeach
                        </td>

                     {{--   <td class="pl-10">


                            <img src="{{asset('storage/images/' . $category->image_category)}}">

                        </td>
--}}

                        <td class="pl-10 img-thumbnail">


                            <img src="{{asset('storage/images/' . $post->image_path)}}">

                        </td>


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
                <hr>


                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>
    <hr>
















</x-app-layout>


<script>
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2({
            placeholder: 'Filter by Categories'
        });
    });

    $(document).ready(function () {
        $('.js-example-basic-multiple-tags').select2({
            placeholder: 'Filter by Tags'
        });
    });


</script>
