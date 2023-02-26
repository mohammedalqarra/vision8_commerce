@extends('site.master')


@section('title', ' posts api | ' . config('app.name'))



@section('content')


    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name">Posts</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('site.index') }}">Home</a></li>
                            <li class="active">posts</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="page-wrapper">
        <div class="cart shopping">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="block">
                            {{-- @foreach ($posts as $post)
                            <h1>{{ $post['title'] }}</h1>
                            <p>{{ $post['body'] }}</p>
                            <hr>
                            @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>

    {{-- <script>
        $.ajax({
            type: 'get',
            url: 'https://jsonplaceholder.typicode.com/posts',
            // data: {
            //     //post
            // },
            //أول ما الصفحة تفتحث بيروح على الرابط جيب البيانات وأعرضها هنا
            success: function(res){
              //  console.log(res)
              //dd(res);


                res.forEach(post => {
                   // console.log(post);
                   let item =
                `<h1>${post.title}</h1>
                <p>${post.body}</p>
                <hr>
                `;
                $('.block').append(item);
                })
            }
        });
    </script> --}}

    <script>
        // Make a request for a user with a given ID
        axios.get('https://jsonplaceholder.typicode.com/posts')
            .then(function(response) {
                response.data.forEach(post => {
                    let item =
                        `<h1>${post.title}</h1>
                        <p>${post.body}</p>
                        <hr>`
                    $('.block').append(item);
                });
                //console.log(response);
            })
            // .catch(function(error) {
            //     // handle error
            //     console.log(error);
            // })
        // .finally(function() {
        //     // always executed
        // });
    </script>
@stop
