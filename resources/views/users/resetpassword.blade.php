@extends('layouts.page')

@section('title')
Reset Password - Vista
@endsection

@section('content')
<div class="app app-header-fixed ">
  <div class="container w-xxl w-auto-xs" ng-controller="SigninFormController" ng-init="app.settings.container = false;">
    <div class="wrapper text-center">
      <h1 class="h1 block m-t m-b-n text-brand-1">VISTA</h1>
    </div>
    <div class="m-b-lg">
      <div class="wrapper text-center">
        <h4 class="text-brand-1">Brief System</h4>
      </div>
      <div class="text-center m-t m-b">
        Enter your username to reset your password
      </div>

      <form name="form" class="form-validation1" method="post" action="{{ route('postresetpassword') }}">        
        <div class="list-group list-group-sm m-b-xs">
          <div class="list-group-item">
            <input type="text" name="username" placeholder="Username" class="no-border form-control" value="{{ old('username') }}">
          </div>
        </div>
        @if ($error = $errors->first('invalid_username'))
          <div class="text-danger wrapper text-center"> 
            {{ $error }}
          </div>
        @endif

        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <button type="submit" class="btn btn-lg bg-brand-1 btn-block text-white" ng-disabled='form.$invalid'>Reset Password</button>

        <div class="text-center m-t m-b">
          Remember your password? <a href="{{ route('signin') }}" class="text-danger">Login here.</a>
        </div>
        <div class="line line-dashed"></div>
        <p class="text-danger text-center hide"><small>TEST ACCESS BELOW:</small></p>
        <a ui-sref="access.signup" class="btn btn-lg btn-default btn-block hide">Create an account</a>
      </form>
    </div>
  </div>
</div>
@endsection

