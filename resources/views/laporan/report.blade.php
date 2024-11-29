@extends('layouts.app')
  <!-- Subhead================================================== -->
@section('content')
<section id="subintro">

    <div class="container-fluid">
      <div class="row-fluid" style="margin-bottom: 0px">
        <div class="span4">
            <div class="icon">
                <i class="icon-bg-light icon-circled icon-search icon-2x active" style="position: absolute; font-size: 20px !important; width: 40px !important; height: 40px !important; line-height: 40px !important;"></i>
            </div>
            <h3 style="margin-left: 50px">Pencarian <strong></strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li><a href="{{ url('laporan') }}">Laporan Penelitian</a><span class="divider">/</span></li>
            <li class="active">Buat File Excel</li>
          </ul>
        </div>
      </div>
    </div>

  </section>

  <section id="maincontent">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
            <form action="{{ url('laporan/generateReport') }}" method="GET" class="comment-form" name="comment-form">
            {{ method_field("PUT") }} 
            {!! csrf_field() !!}
            
            <div class="span5">            
                <label for="tipe" class="control-label">Tipe Penelitian</label>
                <select id="tipe" class="form-control btn-primary" name="tipe" >>
                    <option selected value>-- Semua Tipe Penelitian --</option>
                    <option value="0">Internal</option>
                    <option value="1">Eksternal</option>
                </select>
                <div class="clear"></div>
            
                <label for="tahun_penelitian" class="control-label">Tahun Penelitian</label>
                <select id="tahun_penelitian" name="tahun_penelitian[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" data-selected-text-format="count > 2" multiple title="-- Semua Tahun Penelitian --">
                    @php($curYear = date("Y"))
                    @for($i=$curYear; $i>=2000; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <div class="clear"></div>   
                
                <label for="kategori_id" class="control-label">Bidang Penelitian</label>
                <select id="kategori_id" name="kategori_id[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" data-selected-text-format="count > 2" multiple title="-- Semua Bidang --">
                    @foreach ($kategoris as $key => $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                <div class="clear"></div>
                
            </div>
                
                <!--=====================================================-->
            
            <div class="span1"></div>
            
                <!--================= RIGhT SIDE =======================-->
            <div class="span5">
                <div style="text-align: center">
                <button type="submit" class="btn btn-info" style="padding: 12px 18px; font-size: 16px; font-weight: bold;">
                    Buat File Excel
                </button>
            </div>
            </div>
            </form>
        </div>
      </div>
    </div>
  </section>

@endsection