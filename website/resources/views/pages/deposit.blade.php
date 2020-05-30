@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('deposit') }}">
            
                    {{ csrf_field() }}

                    <div class="input-group form-group d-flex">
                        <input  type="number" 
                                class="form-control mr-3" 
                                placeholder="Money to deposit" 
                                value="{{ Auth::user()->name }}"
                                name = "money">
                    </div>


                <div class="form-group d-flex p-2 bd-highlight ">
                    <input type="submit" value="Submit" class="btn btn-outline-info flex-grow-1">
                </div>
            </form>

@endsection