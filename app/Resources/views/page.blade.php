@extends('layout')

@section('header')
    @include('modules.header')
@endsection

@section('body')
  <main class="flex-1">
    @foreach ($modules as $module)
      @include('modules.'.$module['name'], [
        'module' => $module['data']
      ])
    @endforeach
  </main>
@endsection

@section('footer')
    @include('modules.footer')
@endsection
