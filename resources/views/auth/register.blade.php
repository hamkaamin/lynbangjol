@extends('layouts.app')

  <section id="subintro">

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span4">
          <h3><strong>Registrasi</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li class="active">Registrasi</li>
          </ul>
        </div>
      </div>
    </div>

  </section>
  
    <section id="maincontent">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="comment-post">
            <form action="" method="post" class="comment-form" name="comment-form">
              <div class="row-fluid">
			  <div class="span3">
			  </div>
			  <div class="span6>
			  <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="span6{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Nama</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="<< Isikan nama anda >>" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>
						<div class="clear">
						</div>

                        <div class="span6{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-Mail</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="<< Isikan alamat email anda >>" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
						<div class="clear">
						</div>
						
						<div class="span6{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="<< Isikan password anda >>" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
						<div class="clear">
						</div>

                        <div class="span6">
                            <label for="password-confirm" class="control-label">Ulang Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="<< Isikan sama dengan password >>" required>
                        </div>
						<div class="clear">
						</div>
                        
                        <div class="span6">
                        <label for="kategori_id" class="control-label">Bidang</label>
                        <select id="kategori_id" class="form-control" name="kategori_id" >
                            <option hidden selected value> ( Pilihan Opsional ) </option>
                            @foreach ($kategoris as $key => $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="clear"></div>
						
                        <div class="span6" style="text-align: center">
                            <button type="submit" class="btn btn-primary" style="padding: 12px 20px; font-size: 16px">
                                Registrasi
                            </button>
                        </div>
                    </form>
				</div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

@extends('layouts.footer')
