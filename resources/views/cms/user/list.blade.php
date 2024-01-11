@extends('layouts.cms.master')
@section('title', 'List user')
@section('content')
    <h2>Users</h2>
    <div class="list-user m-auto">
        <table class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? "NULL" }}</td>
                        <td>
                            <div class="d-flex gap-3"> 
                                <a href="{{ route('users.edit', $user->id) }}">
                                    <i class="fa-solid fa-pen-to-square fs-5 text-primary"></i>
                                </a>
                                <a href="#"> 
                                    <i class="fa-solid fa-trash fs-5 text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
    