@extends('layouts.cms.master')
@section('title', 'List user')
@section('content')
    <h2>Users</h2>
    <hr>
    <div class="list-user m-auto">
        <a href="{{ route('roomTypes.create') }}" class="btn btn-success">Create</a>
        <table class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roomTypes as $roomType)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $roomType->name }}</td>
                        <td>{{ $roomType->description ? Str::limit($roomType->description, 55, '...') : 'Null' }}</td>
                        <td>
                            <div class="d-flex gap-3"> 
                                <a href="{{ route('roomTypes.edit', $roomType->id) }}">
                                    <i class="fa-solid fa-pen-to-square fs-5 text-primary"></i>
                                </a>
                                <button id="del-btn" class="confirm-delete border-0 bg-transparent" data-uid="{{$roomType->id}}" data-rname="{{route('roomTypes.delete', ['id' => ':id']) }}">
                                    <i class="fa-solid fa-trash fs-5 text-danger"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th colspan="4" class="text-center">
                            No Data
                        </th>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
    