





<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Coments list') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">

                        <div class="row height d-flex justify-content-center align-items-center">

                            <div class="col-md-6">
                                <form method="get" action="{{ route('Comment.index') }}">

                                </form>

                                <table>
                                    <thead>
                                    <tr>
                                        <th>Comment</th>
                                        <th class="pl-10">Publication date</th>
                                        <th class="pl-10">Published by</th>




                                        <th></th>
                                    </tr>

                                    </thead>
                                    <tbody>

                                    @foreach($comment as $comment)
                                        <tr>
                                            <td class="pl-4"><u>{{ $comment->comment }}</u></td>
                                            <td class="pl-20 pb-2"><u>{{ $comment->created_at }}</u></td>
                                            <td class="pl-10"><u>{{ $comment->user->name }}</u></td>
                                        </tr>
                                @endforeach



                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
</x-app-layout>


