@extends('layouts.app')
@section('content')
<h1>home page</h1>
<div class="slider">
    <input checked='checked' id='rad1' name='rad' type='radio'>
    <input id='rad2' name='rad' type='radio'>
    <input id='rad3' name='rad' type='radio'>
    <div class='btn'></div>
    <div id='wrap'>
        <input type='checkbox'>
        <div class='slide'>
            <div class='label' ></div>
            <div class='search'></div>
            <div class='image'></div>
            <div class='content'>
                <h1></h1>
            </div>
            <p class='classifications'>
                <span>Name</span>
                <span>Release</span>
                <span>Origin</span>
                <span>On-stock</span>
                <span>Personality</span>
                <span>Publisher</span>
            </p>
        </div>
        <div class='slide'>
            <div class='label'></div>
            <div class='search'></div>
            <div class='image'></div>
            <div class='content'>
                <h1></h1>
            </div>
            <p class='classifications'>
                <span>Name</span>
                <span>Release</span>
                <span>Origin</span>
                <span>On-stock</span>
                <span>Personality</span>
                <span>Publisher</span>
            </p>
        </div>
    <div class='slide'>
        <div class='label'></div>
        <div class='search'></div>
        <div class='image'></div>
        <div class='content'>
            <h1></h1>
        </div>
        <p class='classifications'>
            <span>Name</span>
            <span>Release</span>
            <span>Origin</span>
            <span>On-stock</span>
            <span>Personality</span>
            <span>Publisher</span>
        </p>
    </div>
    </div>
</div>
<p>Yo</p>
@endsection