@extends('layouts.app')

<section id="subintro">

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span4">
                <h3><strong>Login</strong></h3>
            </div>
            <div class="span8">
                <ul class="breadcrumb notop">
                    <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
                    <li class="active">Login</li>
                </ul>
            </div>
        </div>
    </div>

</section>

<section id="maincontent">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <!-- start article 3 -->
                @foreach ($errors->all() as $error)
                <h4>{{ $error }}</h4> 
                @endforeach 
                @if (session('status')) 
                <div class="status"> 
                    {{ session('status') }} 
                </div> 
                @endif 
                <div class="comment-post">
                    <form action="" method="post" class="comment-form" name="comment-form">
                        <div class="row-fluid">
                            <form method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="span6{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="control-label">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="<< Alamat Email >>" required autofocus />

                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="clear"></div>

                                <div class="span6{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="<< Password >>" required />

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="clear"></div>

                                <!--                 <div class="span6">
                                                     <label class="checkbox">
                                                         <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} style="height:20px; margin: 0 0 0 0">
                                                         <div style="text-align: center"><span> Ingat Saya </span></div>
                                                     </label>
                                                 </div>
                                                 <div class="clear"></div>       -->

                                <div class="span6" style="text-align: center">
                                    <button type="submit" class="btn btn-primary" style="padding: 12px 20px; font-size: 16px">
                                        Login
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Lupa Password?
                                    </a>       
                                </div>
                            </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@extends('layouts.footer')