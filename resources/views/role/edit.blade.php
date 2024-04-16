@extends('layouts.dashboard')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit Role')
@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Edit Role
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
                        <form action="/roles/{{ $role->id }}" method="POST" class="card">
                            @csrf
                            @method("PATCH")
                            <div class="card-body">
                                <div class="row row-cards">



                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $role->name }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <div class="form-label">Permissions</div>

                                            @foreach($permissions as $permission)
                                            <label class="form-check form-check-inline form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" @if(in_array($permission->name , $role_permissions)) checked @endif>
                                                <span class="form-check-label">{{ $permission->name }}</span>
                                            </label>
                                            @endforeach

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