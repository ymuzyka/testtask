@extends('layouts.common')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br><br>
                <div class="alert alert-warning" role="alert">
                    This game link not found, try <a href="{{ route('register.user') }}">register</a> first &#9785;
                </div>
            </div>
        </div>
    </div>
@stop
