@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <router-view name="AdminDashboard"><router-view>
        <router-view><router-view>
    </div>
</div>
@endsection
