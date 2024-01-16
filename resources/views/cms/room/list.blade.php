@extends('layouts.cms.master')
@section('title', 'List room')
@section('content')
    <h2>Room</h2>
    <hr>
    <div class="list-user m-auto">
        <a href="{{ route('rooms.create') }}" class="btn btn-success">Create</a>
        <table class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Room type</th>
                    <th>Room number</th>
                    <th>Price</th>
                    <th>Acreage</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rooms as $room)
                    <tr class="align-middle">
                        <td>{{ $loop->index }}</td>
                        <td>{{ $room->name }}</td>
                        <td>
                            @php
                                $roomImage = $room->image == defaultImage() ? "default" : $room->image;
                            @endphp
                            <img src="{{ $roomImage == "default" ? asset($room->image) : getImageUrl($room->image) }}" width="80" alt="image {{$room->name}}">
                        </td>
                        <td>{{ $room->roomType->name }}</td>
                        <td>{{ $room->room_no }}</td>
                        <td>{{ $room->price }}</td>
                        <td>{{ $room->acreage }}</td>
                        <td>{{ $room->status === 0 ? "Available" : "Unavailable" }}</td>
                        <td>
                            <div class="d-flex gap-3"> 
                                <a href="{{ route('rooms.edit', $room->id) }}">
                                    <i class="fa-solid fa-pen-to-square fs-5 text-primary"></i>
                                </a>
                                <button id="del-btn" class="confirm-delete border-0 bg-transparent" data-uid="{{$room->id}}" data-rname="{{route('rooms.delete', ['id' => ':id']) }}">
                                    <i class="fa-solid fa-trash fs-5 text-danger"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th colspan="9" class="text-center"> 
                            No Data
                        </th>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
    