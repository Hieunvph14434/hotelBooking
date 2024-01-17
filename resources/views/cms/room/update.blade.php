@extends('layouts.cms.master')
@section('title', 'Update room')
@section('content')
    <h2>Room</h2>
    <div class="list-user m-auto pt-4">
        <form action="{{ route('rooms.update', $room->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
           <div class="row">
                <div class="col-md-6 mb-3">
                    <x-form-input class="col" name="name" label="Room name" required="true" :oldValue="oldOValue('name', $room->name, $errors)" placeholder="Example" />
                </div>
                <div class="col-md-6 mb-3">
                    <x-form-input class="col" name="price" label="Price" required="true" :oldValue="oldOValue('price', $room->price, $errors)" placeholder="100" />
                </div>
           </div>
           <div class="row">
                <div class="col-md-6 mb-3">
                    <x-form-input class="col" name="room_no" label="Room number" required="true" :oldValue="oldOValue('room_no', $room->room_no, $errors)" placeholder="P201" />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" id="">
                        <option value=" ">Select status</option>
                        @foreach ($status as $key => $st)
                            <option {{ old('status') === "$key" || !old('status') && "$room->status" === "$key" ? "selected" : "" }} value="{{ $key }}">{{ $st }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <x-form-input class="col element-relative"  name="acreage" label="Acreage" required="true" :oldValue="oldOValue('acreage', $room->acreage, $errors)" placeholder="16m2" />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="form-label">Room type <span class="text-danger">*</span></label>
                    <select name="type" class="form-select" id="">
                        <option value=" ">Select room type</option>
                        @foreach ($roomTypes as $roomTypeId => $roomType)
                            <option {{ old('type') == $roomTypeId || !old('type') && $room->type == $roomTypeId ? "selected" : "" }} value="{{ $roomTypeId }}">{{ $roomType }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="text-center d-flex gap-3 align-items-center">
                        <div class="elm-relative"> 
                            @php
                                $publicId = session('image') ? session('image') 
                                : ($room->image ==  defaultImage() ? "default" : $room->image); 
                            @endphp
                            <i class="fa-solid fa-xmark elm-absolute xmark-del"></i>
                            <img src="{{ $publicId == "default" ? asset($publicId) : getImageUrl($publicId) }}" id="previewImage" alt="" class="img-fluid rounded-circle">
                        </div>
                        <div>
                            <label for="image" class="btn btn-primary">Upload image</label>
                        </div>
                    </div>
                    <x-form-input name="image" class="preview-img-none d-none" label="Image" :oldValue="old('image')" type="file" previewImg="true" />
                    <input type="hidden" value="{{ session('image') ?? null }}" name="tmp_image">
                    <input type="hidden" value="{{ session('originName') ?? null }}" name="origin_name">
                </div>
            </div>
            <div>
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection