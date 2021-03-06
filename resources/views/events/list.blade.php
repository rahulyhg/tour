@extends('events.search_layout')

@section('breadcrumbs')
    <li>Events</li>
@endsection

@section('search_content')
    <div id="tools">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="styled-select-filters">
                    <form action="{{ route('events.index', Request::all()) }}" method="get">
                    @include('layouts.partials.form_params', ['exclude' => ['sort_name']])
                    {!! Form::select('sort_name', [
                        '' => 'Sort by name',
                        'asc' => 'Name (A-Z)',
                        'desc' => 'Name (Z-A)'
                    ], Request::input('sort_name'), ['id' => 'sort_name']) !!}
                    </form>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 hidden-xs text-right">
                <a class="bt_filters" href="{{ route('events.index', array_merge(Request::all(), ['grid' => 1])) }}">
                    <i class="icon-th"></i></a>
                <a class="bt_filters" href="{{ route('events.index', array_merge(Request::all(), ['grid' => 0])) }}">
                    <i class="icon-list"></i>
                </a>
            </div>
        </div>
    </div>

    @forelse ($events['products'] as $idx => $event)
        @if (Request::input('grid'))
            @if ($idx % 2 == 0) <div class="row"> @endif
            @include('events.partials.grid_element', ['columns' => 2])
            @if ($idx % 2 != 0) </div> @endif
        @else
            @include('events.partials.list_element')
        @endif
    @empty
        <div class="text-center">No events found.</div>
    @endforelse

    <hr>

    <div class="text-center">
        {!! $paginator->render() !!}
    </div>
@endsection

@section('footer_javascript')
    @if (isset($events['products'][0]))
    <?php $coord = explode(',', $events['products'][0]['boundary']) ?>

    @include('layouts.partials.show_js', [
        'zoom' => 6,
        'lat' => $coord[0],
        'long' => $coord[1],
        'marker' => 'Walking',
        'products' => $events['products'],
        'route' => 'events.show'
    ])
    @endif
@endsection