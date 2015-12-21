@extends('layouts.auth')

@section('title')
    @lang('users.titles.sign_up_form')
    @stop

@section('content')
{!! Form::open(['route' => 'auth.sign_up.post']) !!}
    <div class="form-group">
        {!! Form::label('email', trans('users.labels.email')) !!}
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('users.placeholders.email')]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password', trans('users.labels.password')) !!}
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('users.placeholders.password')]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password_confirmation', trans('users.labels.password_confirmation')) !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('users.placeholders.password_confirmation')]) !!}
    </div>
    <p class="help-block">
        @lang('users.descriptions.term_of_use', ['link' => '#'])
    </p>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                {!! Form::submit(trans('users.submits.sign_up'), ['name' => 'sign_up', 'class' => 'btn btn-primary btn-block']) !!}
            </div>
            <div class="col-sm-6">
                @lang('users.descriptions.have_account', ['link' => '#'])
            </div>
        </div>
    </div>
    <div class="form-group text-center">
        @lang('users.descriptions.or_sign_in_with')
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                <a class="btn btn-social btn-facebook btn-block">
                    <i class="fa fa-facebook"></i>
                    @lang('users.submits.sign_in_with', ['provider' => 'Facebook'])
                </a>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-social btn-google btn-block">
                    <i class="fa fa-google"></i>
                    @lang('users.submits.sign_in_with', ['provider' => 'Google'])
                </a>
            </div>
        </div>
    </div>
{!! Form::close() !!}
@stop
