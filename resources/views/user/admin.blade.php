@extends('layouts.front')

@section('Heading',"Update your profile")

@section('content')
    @include('layouts.partials.error')
    @include('layouts.partials.success')


    <div class="container">
        <h5>Admin page</h5>

        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Role</th>
                <th scope="col">E-mail</th>
            </tr>
            </thead>
            <tbody>
            @foreach($allUsers as $user)
                <a href=""

                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->user_role}}</td>
                    <td>{{$user->email}}</td>
                </tr>

            @endforeach

            </tbody>
        </table>

    </div>

@endsection