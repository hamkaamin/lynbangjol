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

            <div class="alert" style="width:60%">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>INFO</strong> Silakan dobel klik pada baris untuk melihat detil permohonan
            </div>

          <div style="float: right;"><a class="btn btn-primary" style="padding: 10px 16px; font-ine-height: 30px;size: 14px" href="{!! url('icp/reg') !!}">Tambah Data</a></div>

              <table id="myTable" class="table table-striped">
                <thead>
                  <tr>
                    <th>NO</th>
                    <th>NIK</th>
                    <th>NAMA</th>
                    <th>PERMASALAHAN</th>
                    <!--th>ALASAN</th>
                    <th>KELUARAN</th>
                    <th>PENERIMA MANFAAT</th-->
                    <th>SATKER</th>
                    <th>OPSI</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($rekaps as $rekap)
                  <tr>
                    <td>{{$rekap->id}}</td>
                    <td>{{$rekap->nik}}</td>
                    <td>{{$rekap->nama}}</td>
                    <td>{{str_limit($rekap->issue, 170, '...')}}</td>
                    <!--td>{{str_limit($rekap->urgensi, 100, '...')}}</td>
                    <td>{{str_limit($rekap->harapan, 100, '...')}}</td>
                    <td>{{str_limit($rekap->manfaat, 100, '...')}}</td-->
                    <td>{{$rekap->namasatker}}</td>
                    <td style="width:120px">

                        <button class="btn btn-info" type="button" name="bntEdit" onclick="btnEdit({{$rekap->id}})" style="padding: 4px; font-size: 12px"><i class="icon-edit" style=""></i> Edit</button>
                        <button class="btn btn-danger" type="button" name="bntDelete" onclick="btnDelete({{$rekap->id}})" style="padding: 4px; font-size: 12px"><i class="icon-trash" style=""></i> Hapus</button>

                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
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

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script type="text/javascript">


  $(function() {
    const t = new $('#myTable').DataTable({
        "processing": true,
        "language" : {"url" : "{{ asset('DataTables-1.10.18/bahasa/Indonesian.json') }}" }
      });

      t.on('order.dt search.dt', function () {
          t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
          });
      }).draw();

  });


  $('#myTable tbody').on('dblclick', 'tr', function ()
  {
    var t = $('#myTable').DataTable();
    var data = t.row(this).data();

    location.href = "{{url('icp/panel')}}/"+data[0];
    <?php // location.href = "{{ route('panel_view', ':index') }}".replace(':index', data[0]); ?>
  } );

  function btnEdit(id)
  {
    location.href = "{{url('icp/edit')}}/"+id;
  }

  function btnDelete(id)
  {
    if (confirm("Permohonan konsultasi ICP dihapus ?") == false) {
        return false;
    }

    location.href = "{{url('icp/delete')}}/"+id;

    // axios.post('{{url('icp/del')}}', {
    //   "id": id
    // });
    // .then (function(response){

    //     alert(response.data.MSG);
    //     if(!response.data.ERROR) {
    //        location.reload();
    //     }

    //     return false;
    // });

    return;
  }
</script>
@endsection
