@extends('layouts.app')

@section('content')
<link href="{{ URL::asset('/images/loginPage/css/login.css') }}" rel="stylesheet"/>
<div class="container">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
            {{-- 置中 --}}
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ url('login/social/google/redirect') }}" class="form" method="POST" role="form">
                        {{--
                        <form action="{{ route('social.redirect', ['provider' => 'google']) }}" class="form" method="GET" role="form">
                            --}}
                        {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-12 cc-selector" role="group">
                                    <input name="provider" type="hidden" value="google">
                                        <div class="col-xs-5 col-xs-offset-1 line" role="group">
                                            <input id="developer" name="role" type="radio" value="developer"/>
                                            <label class="drinkcard-cc developer" for="developer">
                                            </label>
                                            <p class="text-center">
                                                Developer
                                            </p>
                                        </div>
                                        <div class="col-xs-5" role="group">
                                            <input checked="" id="user" name="role" type="radio" value="user"/>
                                            <label class="drinkcard-cc user" for="user">
                                            </label>
                                            <p class="text-center">
                                                User
                                            </p>
                                        </div>
                                    </input>
                                </div>
                            </div>
                            <hr/>
                            <div class="text-center">
                                <button class="btn btn-danger btn-lg btn-block" type="submit">
                                    Sign in with Google
                                </button>
                            </div>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
