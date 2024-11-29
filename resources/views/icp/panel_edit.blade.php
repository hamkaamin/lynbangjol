@extends('layouts.app')

@section('content')
<!-- Subhead================================================== -->
  <section id="subintro">

    <div class="container-fluid">
      <div class="row-fluid" style="margin-bottom: 0px">
        <div class="span4">
            <div class="icon">
                <i class="icon-bg-light icon-circled icon-list icon-2x active" style="position: absolute; font-size: 20px !important; width: 40px !important; height: 40px !important; line-height: 40px !important;"></i>
            </div>
            <h3 style="margin-left: 50px">Daftar <strong>Konsultasi</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li class="active">Konsultasi</li>
          </ul>
        </div>
      </div>
    </div>

  </section>

@if(Auth::user())
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

          <!-- start article 3 -->
           <div class="comment-post">
           <div class="span8" style="margin-left:10px">
                <h5>Form pendaftaran Konsultasi ICP</h5>
            </div><br><br>

            <div class="span12" style="margin-left:20px">
                <table>
                  <tr><td><strong>NIK</strong></td><td> : {{$rekap->nik}}</td></tr>
                  <tr><td><strong>NAMA</strong></td><td> : {{$rekap->nama}}</td></tr>
                  <tr><td><strong>SATKER</strong></td><td> : {{$rekap->namasatker}}</td></tr>
                </table>

            </div>


                  <div class="span12">
                    <form action="{{ url('icp/update') }}" method="post" class="comment-form" name="updateform" id="updateform">
                        {{ csrf_field() }}
                                    <div class="comment-form">

                                    <div class="form-group">
                                        <label for="kategori_id" class="col-md-4 control-label">Kategori</label>
                                        <div class="col-md-6" style="width:91%">{{$rekap->nama_kategori}}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="issue" class="col-md-4 control-label">PERMASALAHAN PD</label>
                                        <div class="col-md-6" style="width:90%">
                                            <textarea id="issue" rows="5" type="issue" class="form-control" name="issue" >{{$rekap->issue}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="urgensi" class="col-md-4 control-label">ALASAN/URGENSI</label>
                                        <div class="col-md-6" style="width:90%">
                                            <textarea id="urgensi" rows="5" type="urgensi" class="form-control" name="urgensi" >{{$rekap->urgensi}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="harapan" class="col-md-4 control-label">KELUARAN YANG DIHARAPKAN</label>
                                        <div class="col-md-6" style="width:90%">
                                            <textarea id="harapan" rows="5" type="harapan" class="form-control" name="harapan" >{{$rekap->harapan}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="manfaat" class="col-md-4 control-label"> PENERIMA MANFAAT </label>
                                        <div class="col-md-6" style="width:90%">
                                            <textarea id="manfaat" rows="5" type="manfaat" class="form-control" name="manfaat" >{{$rekap->manfaat}}</textarea>
                                        </div>
                                    </div>

                                    <div class="clear"></div>

                                    <div class="span6" style="text-align: center">
                                        <input type="hidden" id="id" name="id" value="{{$rekap->id}}">
                                        <button type="button" class="btn btn-primary" style="padding: 12px 20px; font-size: 16px" onclick="btnBack()">Batal</button>
                                        <button type="button" class="btn btn-primary" style="padding: 12px 20px; font-size: 16px" onclick="btnSave()">Simpan</button>
                                    </div>
                    </form>
</div>
                          <br><br>
                  </div>

            </div>
          <!-- end article 3 -->
        </div>
      </div>
    </div>
  </section>

@else
  <section id="maincontent">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
          <!-- start article 3 -->
          <div style="text-align: center"><strong>Anda tidak dapat mengakses halaman ini</strong></div>
          <!-- end article 3 -->
        </div>
      </div>
    </div>
  </section>
@endif
@endsection

@section('foot_script')
<script>
  function btnBack()
  {
      history.back();
  }

  function btnSave()
  {
    $("#updateform").submit();
    return false;
  }
</script>
@endsection
