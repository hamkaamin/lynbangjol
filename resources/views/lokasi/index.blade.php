@extends('layouts.app')
  <!-- Subhead================================================== -->
@section('content')
  <section id="subintro">

    <div class="container-fluid">
      <div class="row-fluid" style="margin-bottom: 0px">
        <div class="span4">
            <div class="icon">
                <i class="icon-bg-light icon-circled icon-list icon-2x active" style="position: absolute; font-size: 20px !important; width: 40px !important; height: 40px !important; line-height: 40px !important;"></i>
            </div>
            <h3 style="margin-left: 50px">List <strong>LOKASI</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li class="active">Lokasi</li>
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
          
          <div style="float: right;">
              <a class="btn btn-success" style="padding: 10px 16px; font-ine-height: 30px;size: 14px; background-color: #6142d1" href="{!! action('LokasiController@generateReport') !!}">Buat Excel</a>
              <a class="btn btn-primary" style="padding: 10px 16px; font-ine-height: 30px;size: 14px" href="{!! action('LokasiController@create') !!}">
                  Tambah Data
              </a>
          </div>
          
              <table id="myTable" class="table table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Lokasi</th>
                  </tr>
                </thead>
                <tbody>
                  @php ($n=1)
                  @foreach ($lokasis as $lokasi)
                  <tr>
                    <td>{{ $n }}</td>                    
                    <td>{{ $lokasi->nama }}</td>
    <!--                <td><a class="btn btn-info" style="padding: 10px 16px; font-size: 14px" href="{!! action('LokasiController@edit', $lokasi->id) !!}">Ubah Data</a></td>  -->
                    @php ($n++)
                  </tr>
                  @endforeach
                </tbody>
              </table>
          <!-- end article 3 -->
        </div>
      </div>
    </div>
  </section>
@endsection

@section('foot_script')
 <script type="text/javascript">

$(function() {
        $('#myTable').dataTable({
        	"processing": true,
      		"language" : {"url" : "{{ asset('DataTables-1.10.18/bahasa/Indonesian.json') }}" }
        });
    });

</script>
@endsection