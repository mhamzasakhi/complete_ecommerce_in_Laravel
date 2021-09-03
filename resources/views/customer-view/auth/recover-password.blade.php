@extends('layouts.front-end.app')
@section('title','Forgot Password')
@push('css_or_js')
    <style>
        .text-primary{
            color: {{$web_config['primary_color']}} !important;
        }
    </style>
@endpush
@section('content')
    <!-- Page Content-->
    <div class="container py-4 py-lg-5 my-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <h2 class="h3 mb-4">Forgot your password?</h2>
                <p class="font-size-md">Change your password in three easy steps. This helps to keep your new password
                    secure.</p>
                <ol class="list-unstyled font-size-md">
                    <li><span class="text-primary mr-2">1.</span>Fill in your email address below.</li>
                    <li><span class="text-primary mr-2">2.</span>We'll email you a temporary code.</li>
                    <li><span class="text-primary mr-2">3.</span>Use the code to change your password on our secure
                        website.
                    </li>
                </ol>
                <div class="card py-2 mt-4">
                    <form class="card-body needs-validation" action="{{route('customer.auth.forgot-password')}}"
                          method="post">
                        @csrf
                        <div class="form-group">
                            <label for="recover-email">Enter your email address</label>
                            <input class="form-control" type="email" name="email" id="recover-email" required>
                            <div class="invalid-feedback">Please provide valid email address.</div>
                        </div>
                        <button class="btn btn-primary" type="submit">Get new password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
