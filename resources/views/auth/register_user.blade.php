@extends('layouts.app')
@section('content')
  <section id="subintro">

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span4">
          <h3><strong>Registrasi User</strong></h3>
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
              <div class="row-fluid">

                <form method="POST" action="{{ route('simpan_register_user') }}" class="comment-form" name="comment-form">

                        <div class="span6">
                            {{ csrf_field() }}

                            <!--div class="span6{{ $errors->has('name') ? ' has-error' : '' }}"-->
                                <label for="name" class="control-label">Nama</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="<< Isikan nama anda >>" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            <!--/div-->
                            <div class="clear"></div>

                            <!--div class="span6{{ $errors->has('email') ? ' has-error' : '' }}"-->
                                <label for="email" class="control-label">E-Mail</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="<< Isikan alamat email anda >>" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            <!--/div-->
                            <div class="clear"></div>

                            <!--div class="span6{{ $errors->has('password') ? ' has-error' : '' }}"-->
                                <label for="password" class="control-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="<< Isikan password anda >>" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            <!--/div-->
                            <div class="clear"></div>

                            <!--div class="span6"-->
                                <label for="password-confirm" class="control-label">Ulang Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="<< Isikan sama dengan password >>" required>
                            <!--/div-->
                            <div class="clear"></div>
                        </div>



                <div class="span6">

                    <div class="{{ $errors->has('nik') ? ' has-error' : '' }}">
                        <label for="nik" class="control-label">NIK</label>
                        <input id="nik" name="nik" type="text" class="form-control" nik="nik" value="{{ old('nik') }}" placeholder="<< Isikan NIK anda >>" required autofocus>

                        @if ($errors->has('nik'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nik') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="{{ $errors->has('alamat') ? ' has-error' : '' }}">
                        <label for="alamat" class="control-label">Alamat</label>
                        <input id="alamat" type="alamat" class="form-control" name="alamat" value="{{ old('alamat') }}" placeholder="<< Isikan alamat alamat anda >>" required>

                        @if ($errors->has('alamat'))
                            <span class="help-block">
                                <strong>{{ $errors->first('alamat') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="{{ $errors->has('no_telp') ? ' has-error' : '' }}">
                        <label for="no_telp" class="control-label">Nomor Telp</label>
                        <input id="no_telp" type="no_telp" class="form-control" name="no_telp" value="{{ old('no_telp') }}" placeholder="<< Isikan No Telp anda >>" required>

                        @if ($errors->has('no_telp'))
                            <span class="help-block">
                                <strong>{{ $errors->first('no_telp') }}</strong>
                            </span>
                        @endif
                    </div>


                    <label for="password-confirm" class="control-label">Status</label>
                    <select id="status" class="form-control" name="status" onchange="GetSatker(this)" >
                        <option hidden selected value> ( Pilih ) </option>
                        <option value="akademik" selected>Akademik</option>
                        <option value="pns">PNS</option>
                        <option value="swasta">Swasta</option>
                    </select>


                    <div id="satker"></div>

                    <div class="{{ $errors->has('bidang') ? ' has-error' : '' }}">
                        <label for="bidang" class="control-label">Bidang</label>
                        <input id="bidang" type="bidang" class="form-control" name="bidang" value="{{ old('bidang') }}" placeholder="<< Isikan bidang anda >>" required>

                        @if ($errors->has('bidang'))
                            <span class="help-block">
                                <strong>{{ $errors->first('bidang') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="clear"></div>

                        <div class="span6" style="text-align: center">
                            <button type="submit" class="btn btn-primary" style="padding: 12px 20px; font-size: 16px">
                                Registrasi
                            </button>
                        </div>
                    </div>

                    <div class="clear"></div>

                </form>
				</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    function GetSatker(status) {
        if(status.value=="pns") {
            $("#satker").html("{!!$satkers!!}");
        } else {
            $("#satker").html("");
        }
    }

  </script>

@endsection
<?php //@extends('layouts.footer') ?>
