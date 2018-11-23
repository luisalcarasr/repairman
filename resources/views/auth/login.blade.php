@extends('layouts.auth')

@section('content')
    <div class="container">
        <section class="columns">
            <div class="column is-offset-one-quarter is-half">
                <div class="card" style="margin-top: 150px">
                    <header class="card-header">
                        <p class="card-header-title is-centered">Welcome</p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <form id="sign-in-form" method="post" action="{{ route('login') }}">
                                @csrf
                                <div class="field">
                                    <label class="label">Email</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input name="email" class="input {{ $errors->has('email') ? 'is-danger' : '' }}"
                                               type="email"
                                               placeholder="Email"
                                               value="{{ old('email') }}">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        @if($errors->has('email'))
                                            <span class="icon is-small is-right">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </span>
                                        @endif
                                    </div>
                                    @if($errors->has('email'))
                                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                                <div class="field">
                                    <label class="label">Password</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input name="password"
                                               class="input {{ $errors->has('password') ? 'is-danger' : '' }}"
                                               type="password" placeholder="Password"
                                               value="{{ old('password') }}">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        @if($errors->has('password'))
                                            <span class="icon is-small is-right">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </span>
                                        @endif
                                    </div>
                                    @if($errors->has('password'))
                                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox">
                                            <input name="remember"
                                                   type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                            @lang("Remember me")
                                        </label>
                                    </div>
                                </div>
                                <input type="submit" class="is-hidden">
                            </form>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item" onclick="getElementById('sign-in-form').submit()">Sign In</a>
                    </footer>
                </div>
            </div>
        </section>
    </div>
@endsection