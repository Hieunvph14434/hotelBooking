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
                    <x-form-input class="col" name="name" label="Full name" required="true" :oldValue="old('name') ?? $user->name" placeholder="Irwin Lind" />
                </div>
                <div class="col-md-6 mb-3">
                    <x-form-input class="col" name="email" label="Email" required="true" :oldValue="old('email') ?? $user->email" placeholder="example@gmail.com" />
                </div>
           </div>
           <div class="row">
                <div class="col-md-6 mb-3">
                    <x-form-input class="col" name="phone" label="Phone" :oldValue="old('phone') ?? $user->phone" placeholder="0987654321" />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="form-label">Gender</label>
                    <select name="gender" class="form-select" id="">
                        <option {{ $user->gender === 0 ? "selected" : "" }} value="0">Male</option>
                        <option {{ $user->gender === 1 ? "selected" : "" }} value="1">Female</option>
                        <option {{ $user->gender === 2 ? "selected" : "" }} value="2">Other</option>
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
                    {{-- <x-form-input name="avatar" class="preview-img-none" label="Avatar" :oldValue="old('avatar')" type="file" previewImg="true" /> --}}
                    <div class="text-center">
                        <img src="{{ asset(session('image') ?? $user->avatar) }}" id="previewImage" alt="" class="img-fluid rounded-circle" width="120" height="120">
                        <div class="d-flex align-items-center justify-content-center my-4 gap-3">
                        <x-form-input name="avatar" class="preview-img-none d-none" label="Avatar" :oldValue="old('avatar')" type="file" previewImg="true" />
                        {{-- <input type="hidden" value="{{ session('image') ?? null }}" name="tmp_image">
                        <input type="hidden" value="{{ session('originName') ?? null }}" name="origin_name"> --}}
                        <label for="avatar" class="btn btn-primary">Tải lên</label>
                    </div>
                </div>
            </div>
            <div>
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection