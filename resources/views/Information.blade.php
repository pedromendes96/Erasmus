@extends('layouts.master')
@section('title','Erasmus - Information')


@section ('content')
<div class="entire-screen center" style="background-image: url(/img/information.jpg);background-repeat: no-repeat;background-size:cover;margin-top: 83px;padding-right: 0px !important;padding-bottom: 0px !important;">
    <div class="fifteen-screen">

    </div>
    <div class="seventy-screen" style="padding: 0px 0px !important;border: 1px solid black;margin: 50px 0px;background-color: #eeeeee">
        <div class="entire-screen">
            <h1>O QUE E</h1>
        </div>
        <div class="entire-screen">
            <h1>CONTEUDO</h1>
            <h1>CONTEUDO</h1>
            <h1>CONTEUDO</h1>
            <h1>CONTEUDO</h1>
            <h1>CONTEUDO</h1>
        </div>
        <div class="entire-screen">
            <h1>CONDICOES</h1>
        </div>
        <div class="entire-screen">
            <h1>CONTEUDO</h1>
            <h1>CONTEUDO</h1>
            <h1>CONTEUDO</h1>
            <h1>CONTEUDO</h1>
            <h1>CONTEUDO</h1>
        </div>
        <div class="entire-screen">
            <h1>UNIVERSIDADES</h1>
        </div>
        <div class="entire-screen">
            <div class="quart-screen"></div>
            <div class="half-screen">
                <div class="entire-screen">
                    {{csrf_field()}}
                    <label>Country:</label>
                    <select name="country" onchange="showCities(this.value)">
                        <option style="display:none;" selected>Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{$country->name}}" style="width: 50%;">
                                {{$country->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div id="cities">

                </div>
                <div id="universities">

                </div>
            </div>
            <div class="quart-screen"></div>
        </div>
    </div>
    <div class="fifteen-screen">

    </div>
</div>

@endsection