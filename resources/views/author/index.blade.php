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
            <h3 style="margin-left: 50px">List <strong>PENULIS</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li class="active">Penulis</li>
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
          <h4 class="heading"><strong>Tabel</strong> Penulis<span></span></h4>
          
          <div style="float: right;">
              <a class="btn btn-success" style="padding: 10px 16px; font-ine-height: 30px;size: 14px; background-color: #6142d1" href="{!! action('AuthorController@generateReport') !!}">Buat Excel</a>
              <a class="btn btn-primary" style="padding: 10px 16px; font-ine-height: 30px;size: 14px" href="{!! action('AuthorController@create') !!}">Tambah Data</a>
          </div>
          
              <table id="myTable" class="table table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Email</th>
                    <th>Instansi</th>
                    <th>Unit</th>
                    <th>Status</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @php ($n=1)
                  @foreach ($authors as $author)
                  <tr>
                    <td>{{ $n }}</td> 
                    <td>{{ $author->nama }}</td> 
                    <td>
                        @if($author->gender) Laki-laki
                        @else Perempuan
                        @endif
                    </td> 
                    <td>{{ $author->alamat }}</td> 
                    <td>{{ $author->no_telp }}</td> 
                    <td>{{ $author->email }}</td>
                    <td>
                        @if($author->lembagas){{ $author->lembagas->nama }}
                        @endif
                    </td>
                    <td>{{ $author->jabatan }}</td>
                    <td>
                        @if ($author->status_delete)
                            @if ($author->status_delete>0)
                                @if(Auth::user()->jenis_user == 143)
                                    Hapus Data Diajukan oleh <div style="color: red">{{ $author->name }}</div><br/>
                                    <a class="btn btn-primary" style="padding: 8px 14px; font-size: 14px" href="{!! action('AuthorController@cancelDelete', $author->id) !!}">
                                       <div class="icon">
                                            <i class="icon-close" style=""></i>
                                            Batalkan
                                        </div>
                                    </a>
                                @else 
                                    <div style="color: red">Hapus </div>(Tunggu Konfirmasi Admin)
                                @endif
                            @else
                                <div style="color: blue">Request Hapus Data Ditolak</div>
                            @endif
                        @else
                            <div style="color: green">Aktif</div>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info" style="padding: 8px 14px; font-size: 14px" href="{!! action('AuthorController@edit', $author->id) !!}">
                           <div class="icon">
                                <i class="icon-edit" style=""></i>
                             Edit
                            </div>
                        </a>
                        
                        <form action="{{ route('author.destroy', $author->id) }}" method="POST" class="hapus" onsubmit="return confirm('Konfirmasi Hapus Data Penulis dengan Nama {{ $author->nama }}');"> 
			{{ method_field("DELETE") }} 
			{{ csrf_field() }} 
                        <button class="btn btn-danger" type="submit" name="submit" style="padding: 4px 8px; font-size: 14px"><i class="icon-trash" style=""></i> Hapus</button>
			</form>
                    </td>
                  </tr>
                  @php ($n++)
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