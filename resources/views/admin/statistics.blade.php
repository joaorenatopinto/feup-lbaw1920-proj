@extends('admin.layout')

@section('adminContent')

<script type="text/javascript" src={{ asset('js/Chart.bundle.min.js') }} defer></script>
<script type="text/javascript" src={{ asset('js/statistics.js') }} defer></script>
<canvas id="statsCat" class="w-100 my-5"></canvas>
<canvas id="statsBid" class="w-100 my-5"></canvas>

@endsection