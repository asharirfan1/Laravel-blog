<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tag list') }}
        </h2>
    </x-slot>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{route('tag.create')}}"> Add new Tag</a>


                </div>

            </div>

        </div>


        <br> <br>
        <table>
            <thead>
            <tr>
                <th class="pl-8">Tag Name</th>

            </tr>

            </thead>
            <tbody>

            @foreach($tags as $tag)
                <tr>

                    <td class="pl-8">{{$tag->tag_name}}</td>


                    <form method="POST" action="{{route('tag.destroy',$tag)}}">
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

