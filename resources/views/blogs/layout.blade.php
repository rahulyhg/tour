@extends('layouts.main')

@section('header', 'Blog')

@section('content')
    <div class="row">
        <aside class="col-md-3 add_bottom_30">
            @include('blogs.aside')
        </aside>
        <div class="col-md-9">
            @yield('blogs_content')
        </div>
    </div>
@endsection