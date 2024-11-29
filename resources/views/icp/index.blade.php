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

                <div class="comment-post">
                    <div class="span6" style="margin-left:22px">
                        <h5>Form pendaftaran Konsultasi ICP</h5>

                        Untuk mendaftarkan  ICP, anda harus login terlebih dahulu, <br>
                        bila belum mempunyai akun, silakan melakukan registrasi pada link berikut <br>
                        <br>
                        <a href="{{'register_user'}}"> Mendaftar anggota baru</a> <br>
                        <a href="{{url('login')}}"> Sudah punya akun dan login</a> <br>

                        </div><br><br>
                        <br><br>
                    <br><br>
                </div>
                <br><br><br><br>
            </div>
        </div>
    </div>
</section>
@endsection
