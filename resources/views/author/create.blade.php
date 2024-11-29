@extends('layouts.app')
  <!-- Subhead================================================== -->
@section('content')
  <section id="subintro">

    <div class="container-fluid">
      <div class="row-fluid" style="margin-bottom: 0px">
        <div class="span4">
            <div class="icon">
                <i class="icon-bg-light icon-circled icon-plus icon-2x active" style="position: absolute; font-size: 20px !important; width: 40px !important; height: 40px !important; line-height: 40px !important;"></i>
            </div>
            <h3 style="margin-left: 50px">Input <strong>PENULIS</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li><a href="{{ url('author') }}">Penulis</a><span class="divider">/</span></li>
            <li class="active">Tambah Data</li>
          </ul>
        </div>
      </div>
    </div>

  </section>

  <section id="maincontent">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
          
            @foreach ($errors->all() as $error) 
            <h4>{{ $error }}</h4> 
            @endforeach 
            @if (session('status')) 
            <div> 
              {{ session('status') }} 
            </div> 
            @endif
            
            <form action="{{ url('author') }}" method="post" enctype="multipart/form-data" class="comment-form" name="comment-form"> 
            {!! csrf_field() !!} 
            <div class="span6">
                <label for="nama" class="control-label">Nama</label>
                <input id="nama" type="text" class="form-control" name="nama" placeholder="<< Nama Penulis >>" required autofocus />
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="gender" class="control-label">Jenis Kelamin</label>
                <select id="gender" class="form-control btn-primary" name="gender" >
                    <option value="1">Laki-laki</option>
                    <option value="0">Perempuan</option>
                </select>
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="alamat" class="control-label">Alamat</label>
                <input id="alamat" type="text" class="form-control" name="alamat" placeholder="<< Alamat Penulis >>" />
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="no_telp" class="control-label">No. Telp</label>
                <input id="no_telp" type="text" class="form-control" name="no_telp" placeholder="<< Nomor Telepon Penulis >>" />
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="email" class="control-label">Email</label>
                <input id="email" type="email" class="form-control" name="email" placeholder="<< Alamat Email >>" />
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="lembaga_id" class="control-label">Instansi</label>
                <select id="lembaga_id" name="lembaga_id" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" >
                    <option hidden  disabled selected value>Pilih Instansi</option>
                    @foreach ($lembagas as $key => $lembaga)
                        <option value="{{ $lembaga->id }}">{{ $lembaga->nama }}</option>
                    @endforeach
                </select>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="jabatan" class="control-label">Unit</label>
                <input id="jabatan" type="text" class="form-control" name="jabatan" placeholder="<< Posisi pada Instansi >>" />
            </div>
            <div class="clear"></div>

            <div class="span6" style="text-align: center">
                <button type="submit" class="btn btn-primary" style="padding: 10px 16px; font-size: 14px">
                Simpan Data
            </button>
            </div>
            
            <div class="clear"></div>
                
            </form>
        </div>
      </div>
    </div>
  </section>

@endsection


@section('foot_script')
<script type="text/javascript">
    setInputFilter(document.getElementById("no_telp"), function(value) {
  return /^\d*$/.test(value); });
    
    function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    });
  });
}
</script>
@endsection