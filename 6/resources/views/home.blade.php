@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ホーム</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- You are logged in! -->
                    <form action="{{ action('HomeController@create') }}" method="post" enctype="multipart/form-data">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="body" value="{{ old('body') }}" placeholder="ポエム">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            </div>
                        </div>

                        {{ csrf_field() }}
                        <div class="text-right">
                            <input type="submit" class="btn btn-secondary" value="つぶやく">
                        </div>
                    </form>
                </div>
            </div>
            <br>
            @foreach($posts as $post)
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                            <b>{{ $post->name }}</b>
                            </div>
                            <div class="col-md-6 text-right">
                            {{ $post->created_at->format("Y/m/d H:i") }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ str_limit($post->body, 225) }}
                            </div>
                        </div>
                        @if (Auth::user()->id == $post->user_id)
                        <form action="{{ action('HomeController@destroy', ['id'=>$post->id]) }}" method="post" enctype="multipart/form-data">
                            <div class="row">
                                {{ csrf_field() }}
                                <div class="col-md-12  text-right">
                                    <input type="submit" class="btn btn-outline-danger btn-sm" value="削除">
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
