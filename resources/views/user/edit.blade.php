@extends('layouts.dashboard')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit User')
@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Edit a user
                </h2>
            </div>

        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-12">
                <div class="row row-cards">
                    <div class="col-12">
                        <form action="/users/{{ $user->id }}" method="POST" class="card">
                            @csrf
                            @method("PATCH")
                            <div class="card-body">
                                <div class="row row-cards">

                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email address</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Leave it blank if you don't want it to change" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Role</label>
                                            <div class="btn-group w-100" role="group">
                                                <select class="form-control form-select" name="role">
                                                    @foreach($roles as $role)
                                                    <option value="{{ $role->name }}" @if(in_array($role->name , $user->roles->pluck('name')->toArray())) selected @endif>{{ $role->name }}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>





                                    </div>

                                </div>
                            </div>
                            <div class="card-footer text-end">
                                @if ($status === 'updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                                @endif
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection