@extends('layouts.app')

@section('content')
<style>
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: 10px;
        margin-left: 12px;
    }
</style>
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
                    <div class="span8" style="margin-left:10px">
                        <h5>Form pendaftaran Konsultasi ICP</h5>

                    </div><br><br>
                    <div class="span12" style="margin-left:10px">
                    <strong>NIK :</strong> {{$nik}} <strong>NAMA : </strong> {{$nama}}<strong> SATKER : </strong>{{$satker_nama}}
                    </div><br><br>

                    <div class="row">
                        <div class="span12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ url('icp/regp') }}" method="post" class="comment-form" name="comment-form">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('kategori_id') ? ' has-error' : '' }}">
                                        <label for="kategori_id" class="col-md-4 control-label">Kategori</label>

                                        <div class="col-md-6" style="width:91%">
                                            <select id="kategori_id" type="kategori_id" class="form-control" name="kategori_id">
                                                <option value="">Pilih ...</option>
                                                @if(count($kategoris)>0)
                                                    @foreach($kategoris->all() as $kategori)
                                                    <option value="{{$kategori->id}}">{{$kategori->nama}}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            @if ($errors->has('kategori_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('kategori_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                        <div class="form-group{{ $errors->has('issue') ? ' has-error' : '' }}">
                                            <label for="issue" class="col-md-4 control-label">PERMASALAHAN PD</label>

                                            <div class="col-md-6" style="width:90%">
                                                <textarea id="issue" rows="5" type="issue" class="form-control" name="issue">{{ old('issue') }}</textarea>

                                                @if ($errors->has('issue'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('issue') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('urgensi') ? ' has-error' : '' }}">
                                            <label for="urgensi" class="col-md-4 control-label">ALASAN/URGENSI</label>

                                            <div class="col-md-6" style="width:90%">
                                                <textarea id="urgensi" rows="5" type="urgensi" class="form-control" name="urgensi">{{ old('urgensi') }}</textarea>

                                                @if ($errors->has('urgensi'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('urgensi') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('harapan') ? ' has-error' : '' }}">
                                            <label for="harapan" class="col-md-4 control-label">KELUARAN YANG DIHARAPKAN</label>

                                            <div class="col-md-6" style="width:90%">
                                                <textarea id="harapan" rows="5" type="harapan" class="form-control" name="harapan">{{ old('harapan') }}</textarea>

                                                @if ($errors->has('harapan'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('harapan') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('manfaat') ? ' has-error' : '' }}">
                                            <label for="manfaat" class="col-md-4 control-label"> PENERIMA MANFAAT </label>

                                            <div class="col-md-6" style="width:90%">
                                                <textarea id="manfaat" rows="5" type="manfaat" class="form-control" name="manfaat">{{ old('manfaat') }}</textarea>

                                                @if ($errors->has('manfaat'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('manfaat') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="clear"></div>

                                        <div class="span6" style="text-align: center">                                            
                                            <button type="submit" class="btn btn-primary" style="padding: 12px 20px; font-size: 16px">
                                                Kirim
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
