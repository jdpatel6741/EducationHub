@extends('layouts.app')

<style type="text/css">
    .gridbox {
        height: 200px;
        margin-bottom: 30px;
        padding: 15px;
        color: white;
    }
    a {
        text-decoration: none !important;
    }
    #footer
    {
        background-color:#fff;padding:20px 10px 20px 10px;  
    }
    .list-inline
    {
        padding-left:0;
        margin-left:-5px;
        list-style:none;
    }
    .list-inline>li
    {
        display:inline-block;
        padding-right:5px;
        padding-left:5px;
    }
</style>
<link rel="stylesheet" href="{{ asset('icon/css/font-awesome.min.css') }}">

@section('content')
<div class="container">
    <h2>Topics</h2>
    <hr>
    <div class="row">
        @for($i=0;count($list)>$i;$i++)
            <div class="col-md-4">
                <a href="{{ $list[$i][3] }}">
                    <div class="col-md-12 gridbox" style="background-color: {{ $list[$i][2] }};">
                        <h3><b><i class="{{ $list[$i][4] }}"></i> {{ $list[$i][0] }}</b></h3>
                        <hr style="border-color: white;">
                        <p>{{ $list[$i][1] }}</p>
                    </div>
                </a>
            </div>
        @endfor
    </div>
</div>

<div id="footer">
    <div class="container">
        <ul class="list-inline" style="font-weight:bold;font-size:13px;">
            <li>About</li>
            <li>Copyright</li>
            <li>Creators</li>
            <li>Developers</li>
            <li>+{{ env('APP_NAME') }} </li>
        </ul>
        <p style="color:#666;font-size: 11px;">© 2018 {{ env('APP_NAME') }}, IND</p>
    </div>
</div>
@endsection