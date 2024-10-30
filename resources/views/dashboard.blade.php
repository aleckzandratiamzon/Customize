@extends('layouts.app3')

@section('contents')
@if (in_array(Auth::user()->role, ['admin', 'seller']))

<div class="min-h-full min-w-full mt-4">
    <x-dashboard-card class="w-full" />
    <x-chart.product-chart class="w-full" />

    <div class="flex justify-between items-center w-full">
    </div>
</div>

@endif
@endsection
