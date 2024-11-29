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
            <h3 style="margin-left: 50px">List <strong>Pengaturan</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li class="active">Pengaturan</li>
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
          <h4 class="heading"><strong>Tabel</strong> User<span></span></h4>
                    
              <table id="myTable" class="table table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Bidang</th>
                    <th>Jenis User</th>
                    <th>Status</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @php ($n=1)
                  @foreach ($users as $user)
                  <tr>
                    <td>{{ $n }}</td> 
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->kategoris){{ $user->kategoris->nama }}
                        @endif
                    </td>
                    <td>
                        @if($user->jenis_user == 143) <div style="color: blue">Admin Utama</div>
                        @else Admin Bidang
                        @endif
                    </td>
                    <td>
                        @if ($user->isAktif) <div style="color: green">Aktif</div>
                        @else <div style="color: red">Tidak Aktif</div>
                        @endif
                        
                        <div class="clear" style="margin-bottom: 10px"></div>
                        @if ($user->isAktif)
                        <a class="btn btn-danger" style="padding: 8px 14px; font-size: 14px" href="{!! action('UserViewController@aktivasi', $user->id) !!}">
                        @else 
                        <a class="btn btn-primary" style="padding: 8px 14px; font-size: 14px" href="{!! action('UserViewController@aktivasi', $user->id) !!}">
                        @endif
                            <div class="icon">
                                @if ($user->isAktif) Non-Aktifkan
                                @else Aktifkan
                                @endif
                            </div>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-info" style="padding: 8px 14px; font-size: 14px" href="{!! action('UserViewController@edit', $user->id) !!}">
                           <div class="icon">
                                <i class="icon-edit" style=""></i>
                             Edit
                            </div>
                        </a>
                        
                        <form action="{{ route('userView.destroy', $user->id) }}" method="POST" class="hapus" onsubmit="return confirm('Konfirmasi Hapus Data User dengan Nama {{ $user->name }}');"> 
			{{ method_field("DELETE") }} 
			{{ csrf_field() }} 
                        <button class="btn btn-danger" type="submit" name="submit" style="padding: 4px 8px; font-size: 14px">
                            <i class="icon-trash" style=""></i> Hapus</button>
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