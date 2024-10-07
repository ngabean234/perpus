@extends('layouts.master')
@section('content')

@if (\Auth::user()->role_id == 2)
<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            @if($message = Session::get('success'))
            <div class="row mt-2">
                <div class="col">
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <i class="icon fas fa-info"></i> Sukses !<br>
                        {{ $message }}
                    </div>
                </div>
            </div>
            @endif
            <form role="form" method="post" action="{{ url('sumbang/add/store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">{{$title}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Judul</label>
                                    <input id="judul" type="text"
                                        class="form-control @error('judul') is-invalid @enderror" name="judul"
                                        value="{{ old('judul') }}" placeholder="Masukan Judul Buku" required autocomplete="off">

                                    @error('judul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>*Masukan judul</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Penulis</label>
                                    <input id="penulis" type="text"
                                        class="form-control @error('penulis') is-invalid @enderror" name="penulis"
                                        value="{{ old('penulis') }}" required placeholder="Masukan nama penulis">

                                    @error('penulis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>* Masukan nama penulis</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Penerbit</label>
                                    <input id="penerbit" type="text"
                                        class="form-control @error('penerbit') is-invalid @enderror" name="penerbit"
                                        value="{{ old('penerbit') }}" required placeholder="Masukan Judul Penerbit">

                                    @error('penerbit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>* Masukan nama penerbit</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jumlah halaman</label>
                                    <input id="jml_halaman" type="number"
                                        class="form-control @error('jml_halaman') is-invalid @enderror"
                                        name="jml_halaman" value="{{ old('jml_halaman') }}" required
                                        placeholder="Masukan Jumlah halaman buku">

                                    @error('jumlah halaman')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>* Masukan jumlah halaman</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ringkasan</label>
                                    <textarea class="textarea @error('ringkasan') is-invalid @enderror"
                                        placeholder="Place some text here" name="ringkasan" required
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                         {{ old('ringkasan') }}</textarea>
                                    @error('ringkasan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>* Tulis ringksan buku</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title"></h3>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label>Cover Buku</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file">
                                                Browse… <input id="imgInp" type="file"
                                                    class="form-control @error('cover') is-invalid @enderror"
                                                    name="cover" value="{{ old('cover') }}">
                                        @error('cover')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>Masukan Cover</strong>
                                            </span>
                                        @enderror
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" value="Pilih Cover" readonly>
                                        
                                    </div>
                                    <hr>
                                    <img src="" id='img-upload' width="100%" />
                                    <center>
                                        <p>Image Preview</p>
                                    </center>
                                    <hr>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Embed Flipbook</label>
                                    <input id="embed" type="text"
                                        class="form-control @error('embed') is-invalid @enderror" name="embed" required
                                        value="{{ old('embed') }}" placeholder="contoh : https://online.anyflip.com/tegcn/ldgs/index.html" autocomplete="off">

                                    @error('embed')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>* Masukan link embed Flipbook</strong>
                                    </span>
                                    @enderror
                                </div>
                                <hr>
                                <div class="form-group" style="margin-top: -15px">
                                    <label>Category</label>
                                    <select class="form-control" style="width: 100%;" name="category_id">
                                        <option>Pilih Category</option>
                                        @foreach ($category as $ctg)
                                        <option value="{{ $ctg->id }}">{{ $ctg->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"> Simpan</i></button>
                                <br>
                                <p>*Untuk Embed flipbook silahkan export terlebih dahulu di https://anyflip.com (max: 100 Halaman untuk versi Free)</p>
                                <p>*untuk file pdf lebih dari 100 halaman silahkan bagi menjadi beberapa part, buka https://splitapdf.com</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@else
@include('layouts.404')

@endif

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '.btn-file :file', function () {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function (event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });
    });

</script>
@endsection