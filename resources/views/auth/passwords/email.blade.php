@extends('layouts.frontv2layout')

@section('content')
<div class="wrapper" style="    background: white;
    display: block;">
    <div class="container   padding-bottom-100" id="connexionsection">
    <div class="row margin-top-60">
        <div class="col-lg-2 col-md-12"></div>
        <div class="col-lg-8 col-md-12">
            <div class="dashboard-list-box margin-top-0" style="    margin: 30px 0 0 0;
    box-shadow: 0 0 12px 0 rgb(0 0 0 / 6%);
    border-radius: 4px;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" name="connform" id="connform" autocomplete="on">
                        @csrf
                        <h4 style="color: #000;
    background-color: #ffd700;
    border-radius: 40px 40px 0 0;
    font-size: 20px;
    font-weight: 800;
    text-align: center;
    padding: 15px 30px;">{{ __('Reset Password') }}</h4>

                        <div class="form-group row" style="padding: 5px;
    margin: 0;
    background-color: #fff;
}

">
                            <center>
                            <div class="row padding-top-60">
                               
                                <div class="col-md-12" >
                                    <div>
                                    <input id="email" type="email" placeholder="Email Adress" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                     </div>
                                </div>
                                
                            </div></center>
                        </div>

            
                    <div class="row padding-top-40">
                                <div class="col-md-12" >
                                    <button type="submit" class="submit button" id="submitc"  style="    padding: 6px 15px;
    line-height: 20px;
    font-size: 13px;
    font-weight: 600;
    margin: 0;height:52px   ;width: -webkit-fill-available;"> {{ __('Send Password Reset Link') }}</button>
                                </div>
                            </div>
                      
                    </form>
                   
            </div>
        </div>
       
    </div></div>

@endsection
