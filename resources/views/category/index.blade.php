


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{route('category.create')}}"> Add new Category</a>


                </div>
                <div class="container ">

                    <div class="col-sm-6 mt-5 ">

                        <div class="p-5 border-2 border border-secondary rounded">
                            <h2>---------</h2>
                            <form method="POST" enctype="multipart/form-data" action="{{route('category.import')}}">
                                @csrf
                                <label>Select file</label>
                                <input type="file" name="file" class="form-control">
                                <div class="mt-5">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                    {{--                                    <a href="#" class="btn btn-primary float-right">Export Excel</a>--}}

                                </div>
                            </form>

                        </div>

                    </div>
                </div>

            </div>

        </div>


        <br> <br>
        <table>
            <thead>
            <tr>
                <th class="pl-8">Category Name</th>
                <th class="pl-8">Image Category </th>


            </tr>

            </thead>
            <tbody>

            @foreach($categories as $category)
                <tr>

                    <td class="pl-8">{{$category->name}}</td>
                    <td class="pl-10">

                    <td class="pl-10">
                        <img src="{{ asset('storage/catimage/'. $category->image_category) }}">
                    </td>



                    <td><a href="{{ route('category.edit' ,  $category) }}"
                           class=" mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full ml-4 mt-2">
                            Edit</a></td>


                            <form method="POST" action="{{route('category.destroy',$category)}}">
                                @csrf
                                @method('Delete')

                                <td>
                                    <button type="submit" onclick="return confirm('Are you sure ?')"
                                            class="btn btn-danger ml-4" style="border-radius:25px; ">

                                        Delete
                                    </button>
                                </td>

                            </form>
                </tr>
        @endforeach


    </div>

</x-app-layout>
