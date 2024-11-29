@extends('layouts.app')

@section('content')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>


<section id="subintro">

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span4">
                <h3><strong>Konsultasi ICP</strong></h3>
            </div>
            <div class="span8">
                <ul class="breadcrumb notop">
                    <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
                    <li class="active">Konsultasi ICP</li>
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
                    <div class="span6" style="margin-left:22px">
                        <h5>Form pendaftaran Konsultasi ICP</h5>

                    </div><br><br>

                    <form action="{{ url('icp/reg') }}" method="post" class="comment-form" name="comment-form">
                    {{ csrf_field() }}

                            <div class="span6{{ $errors->has('nip') ? ' has-error' : '' }}">
                                <label for="nip" class="control-label">NIP</label>
                                <input id="nip" type="text" class="form-control" name="nip" value="{{ old('nip') }}" placeholder="<< NIP >>" required/>

                                @if ($errors->has('nip'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nip') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="clear"></div>
                            <div class="span6{{ $errors->has('nama') ? ' has-error' : '' }}">
                                <label for="nama" class="control-label">Nama</label>
                                <input id="nama" type="text" class="form-control" name="nama"  value="{{ old('nama') }}" placeholder="<< NAMA >>" required>

                                @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="span6{{ $errors->has('satker_id') ? ' has-error' : '' }}">
                                <label for="satker_id" class="col-md-4 control-label">Satuan Kerja</label>

                                    <select id="satker_id" class="form-control" name="satker_id">
                                        <option value="">Pilih satker</option>
                                        @if(count($satkers)>0)
                                            @foreach($satkers->all() as $satker)
                                            <option value="{{$satker->id}}">{{$satker->namasatker}}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @if ($errors->has('satker_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('satker_id') }}</strong>
                                        </span>
                                    @endif

                            </div>

                            <div class="clear"></div>

                            <?php if ($_SERVER['HTTP_HOST'] != 'localhost' /* && $_SERVER['HTTP_HOST'] != '127.0.0.1'*/) { ?>
                            <div class="span6">
                            <div class="g-recaptcha" data-sitekey="6Le1W9spAAAAAB5DPn_i4Ic8YmoLORhh2NGtudm2"></div>
                            </div> <br><br><br><br>
                            <?php } ?>

                            <div class="span6" style="text-align: center">
                                <button type="submit" class="btn btn-primary" style="padding: 12px 20px; font-size: 16px">
                                    Daftar
                                </button>
                            </div>

                    </form>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
