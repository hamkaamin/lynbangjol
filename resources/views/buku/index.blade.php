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
            <h3 style="margin-left: 50px">List <strong>BUKU</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li class="active">Buku</li>
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
          
          <div style="float: right;"><a class="btn btn-primary" style="padding: 10px 16px; font-ine-height: 30px;size: 14px" href="{!! action('BukuController@create') !!}">Tambah Data</a></div>
          
              <table id="myTable" class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penerbit</th>
                    <th>Tanggal Publikasi</th>
                    <th>Halaman</th>
                    <th>Dokumen</th>
                    <th>Cover</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @php ($n=1)
                  @foreach ($bukus as $buku)
                  <tr>
                    <td>{{ $n }}</td> 
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penerbit }}</td>
                    <td>{{ $buku->tgl_publikasi }}</td>
                    <td>{{ $buku->halaman }}</td>
                    <td><a href="{{ $buku->doc_filename }}" download> Download </a></td>
                    <td><a href="{{ $buku->doc_filename }}"><img src="{{ $buku->cover_filename }}" style="max-width: 225px"/></a></td>
                    <td>
                        <a class="btn btn-info" style="padding: 4px 19px; font-size: 14px" href="{!! action('BukuController@edit', $buku->id) !!}">
           <!--                 <div class="icon">
                                <i class="icon-pencil icon-2x" style="font-size: 20px !important; width: 40px !important; height: 40px !important; line-height: 20px !important;"></i>
                            </div>      -->
                            Edit
                        </a>
                        
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="hapus"> 
			{{ method_field("DELETE") }} 
			{{ csrf_field() }} 
                        <input class="btn btn-danger" type="submit" value="Hapus" name="submit"/>
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



