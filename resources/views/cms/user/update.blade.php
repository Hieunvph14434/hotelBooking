@extends('layouts.cms.master')
@section('title', 'Edit user')
@section('content')
    <h2>User</h2>
    <div class="list-user m-auto pt-4">
        <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")
           <div class="row">
                <div class="col-md-6 mb-3">
                    <x-form-input class="col" name="name" label="Full name" required="true" :oldValue="oldOValue('name', $user->name, $errors)" placeholder="Irwin Lind" />
                </div>
                <div class="col-md-6 mb-3">
                    <x-form-input class="col" name="email" label="Email" required="true" :oldValue="oldOValue('email', $user->email, $errors)" placeholder="example@gmail.com" />
                </div>
           </div>
           <div class="row">
                <div class="col-md-6 mb-3">
                    <x-form-input class="col" name="phone" label="Phone" :oldValue="old('phone') ?? $user->phone" placeholder="0987654321" />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="form-label">Gender</label>
                    <select name="gender" class="form-select" id="">
                        @foreach ($genders as $gender)
                            <option @if (in_array($loop->index, [old('gender'), $user->gender])) selected @endif value="{{ $loop->index }}">{{ $gender }}</option>
                        @endforeach
                        
                    </select>
                    @error('gender')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <x-form-input class="col" name="address" label="Address" :oldValue="old('address') ?? $user->address" placeholder="Ha Noi" />
                </div>
                <div class="col-md-6 mb-3">
                    @php
                        $publicId = session('image') ? session('image') 
                        : ($user->avatar ==  defaultImage() ? "default" : $user->avatar); 
                    @endphp
                    <div class="text-center d-flex gap-3 align-items-center">
                        <div>
                            <img src="{{ $publicId == "default" ? asset(defaultImage()) : getImageUrl($publicId) }}" id="previewImage" alt="" class="img-fluid rounded-circle">
                        </div>
                        <div>
                            <label for="avatar" class="btn btn-primary">Tải lên</label>
                        </div>
                    </div>
                    <x-form-input name="avatar" class="preview-img-none d-none" label="Avatar" :oldValue="old('avatar')" type="file" previewImg="true" />
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