@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf


                        <div class="form-group row mb-0">

                            <div class="offset-md-2 col-md-8 offset-md-2">

                                <a href="/login/github" type="button" class="btn btn-secondary btn-lg btn-block">
                                    <i class="fab fa-github"></i>
                                    Login with GitHub
                                </a>
                                <!-- <i class="fa fa-plane" aria-hidden="true"> </i>
                                <a class="btn btn-default btn-md">Log in with Github</a> -->
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection