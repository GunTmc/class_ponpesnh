@extends('layouts.app')

@section('content')

 <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambahkan Pengumuman Baru</h1>
          </div>

        </div>
      </div>
    </section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <form method="post" action="">
                 {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="title" required placeholder="Title">
                  </div>


                  <div class="form-group">
                    <label>Tanggal Pemberitahuan</label>
                    <input type="date" class="form-control" name="notice_date" required>
                  </div>

                  <div class="form-group">
                    <label>Tanggal Terbit</label>
                    <input type="date" class="form-control" name="publish_date" required>
                  </div>

                  <div class="form-group">
                    <label style="display: block;">Pesan Ke </label>
                    <label style="margin-right: 50px;"><input type="checkbox" value="3" name="message_to[]"> Siswa </label>
                    <label style="margin-right: 50px;"><input type="checkbox" value="4" name="message_to[]"> Orang Tua </label>
                    <label><input type="checkbox" value="2" name="message_to[]"> Guru </label>
                  </div>


                  <div class="form-group">
                    <label>Pesan</label>
                    <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px"></textarea>
                  </div>




                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>


          </div>
        </div>

      </div>
    </section>

  </div>

@endsection

@section('script')

	<script src="{{ url('public/plugins/summernote/summernote-bs4.min.js') }}"></script>


	<script type="text/javascript">

		  $(function () {

		  	$('#compose-textarea').summernote({
			  height: 200
			});


		  });

	</script>
@endsection
