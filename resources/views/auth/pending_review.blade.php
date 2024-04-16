@extends('layouts.guest')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Pending Review!')
@section('content')

<script src="./tabler/dist/js/demo-theme.min.js?1684106062"></script>

<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="/" class="navbar-brand navbar-brand-autodark"><img src="./tabler/static/logo.svg" height="36" alt=""></a>
        </div>
        <div class="card card-md">

            <div class="card-body">
                <h2 class="card-title text-center">Your Account is Pending Review!</h2>
                <h3 class="card-title text-center text-muted">We will notify you by email when you are accepted!</h3>
            </div>
        </div>
        <div class="text-center text-muted mt-3">
            Already have account? <a href="/login" tabindex="-1">Sign in</a>
        </div>
    </div>
</div>

<!-- Libs JS -->
<!-- Tabler Core -->
<script src="./tabler/dist/js/tabler.min.js?1684106062" defer></script>
<script src="./tabler/dist/js/demo.min.js?1684106062" defer></script>
@endsection