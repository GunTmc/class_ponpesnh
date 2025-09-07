@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1><i class="fas fa-file-invoice-dollar"></i> Laporan Pengumpulan Biaya</h1>
              </div>
              <div class="col-sm-6" style="text-align: right;">
                <a href="{{ url('admin/fees_collection') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
              </div>
            </div>
          </div>
        </section>

        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">

                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title"> Cari Laporan Pengumpulan Biaya</h3>
                  </div>
                  <form method="get" action="">
                    <div class="card-body">
                      <div class="row">

                        <div class="form-group col-md-2">
                          <label> ID Siswa</label>
                          <input type="text" class="form-control" placeholder="Student ID" value="{{ Request::get('student_id') }}" name="student_id">
                        </div>

                        <div class="form-group col-md-2">
                          <label> Nama Siswa</label>
                          <input type="text" class="form-control" placeholder="Student Name" value="{{ Request::get('student_name') }}" name="student_name">
                        </div>

                        <div class="form-group col-md-2">
                          <label> Nama Akhir Siswa</label>
                          <input type="text" class="form-control" placeholder="Student Last Name" value="{{ Request::get('student_last_name') }}" name="student_last_name">
                        </div>

                        <div class="form-group col-md-2">
                          <label> Kelas</label>
                          <select class="form-control" name="class_id">
                              <option value="">Pilih</option>
                              @foreach($getClass as $class)
                                <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                              @endforeach
                          </select>
                        </div>

                        <div class="form-group col-md-2">
                          <label> Mulai Tanggal</label>
                          <input type="date" class="form-control" value="{{ Request::get('start_created_date') }}" name="start_created_date">
                        </div>

                        <div class="form-group col-md-2">
                          <label> Akhir Tanggal</label>
                          <input type="date" class="form-control" value="{{ Request::get('end_created_date') }}" name="end_created_date">
                        </div>

                        <div class="form-group col-md-2">
                          <label> Tipe Pembayaran</label>
                          <select class="form-control" name="payment_type">
                              <option value="">Pilih</option>
                              <option {{ (Request::get('payment_type') == 'Cash') ? 'selected' : '' }} value="Cash">Tunai</option>
                              <option {{ (Request::get('payment_type') == 'Cheque') ? 'selected' : '' }} value="Cheque">Cek</option>
                              <option {{ (Request::get('payment_type') == 'Paypal') ? 'selected' : '' }} value="Paypal">Paypal</option>
                              <option {{ (Request::get('payment_type') == 'Stripe') ? 'selected' : '' }} value="Stripe">Stripe</option>
                          </select>
                        </div>

                        <div class="form-group col-md-2">
                          <button class="btn btn-primary" type="submit" style="margin-top: 30px;"> Cari</button>
                          <a href="{{ url('admin/fees_collection/collect_fees_report') }}" class="btn btn-success" style="margin-top: 30px;"><i class="fas fa-sync"></i> Reset</a>
                        </div>

                      </div>
                    </div>
                  </form>
                </div>

                @include('_message')

                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title">Laporan Pengumpulan Biaya</h3>
                    <form style="float: right;" method="post" action="{{ url('admin/fees_collection/export_collect_fees_report') }}">
                      {{ csrf_field() }}
                      <input type="hidden" value="{{ Request::get('student_id') }}" name="student_id">
                      <input type="hidden" value="{{ Request::get('student_name') }}" name="student_name">
                      <input type="hidden" value="{{ Request::get('student_last_name') }}" name="student_last_name">
                      <input type="hidden" value="{{ Request::get('class_id') }}" name="class_id">
                      <input type="hidden" value="{{ Request::get('start_created_date') }}" name="start_created_date">
                      <input type="hidden" value="{{ Request::get('end_created_date') }}" name="end_created_date">
                      <input type="hidden" value="{{ Request::get('payment_type') }}" name="payment_type">
                      <button type="submit" class="btn btn-success"> Export Excel</button>
                    </form>
                  </div>

                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th class="text-nowrap"> #</th>
                            <th class="text-nowrap"> ID Siswa</th>
                            <th> Nama Siswa</th>
                            <th> Nama Kelas</th>
                            <th class="text-nowrap"> Jumlah Total</th>
                            <th class="text-nowrap"> Jumlah Terbayar</th>
                            <th class="text-nowrap"> Jumlah Tersisa</th>
                            <th> Tipe Pembayaran</th>
                            <th> Komentar</th>
                            <th> Dibuat Oleh</th>
                            <th class="text-nowrap"> Tanggal Dibuat</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($getRecord as $value)
                            <tr>
                              <td>{{ $value->id }}</td>
                              <td>{{ $value->student_id }}</td>
                              <td>{{ $value->student_name_first }} {{ $value->student_name_last }}</td>
                              <td>{{ $value->class_name }}</td>
                              <td class="text-nowrap"><span class="text-primary font-weight-bold">Rp {{ number_format($value->total_amount, 0, ',', '.') }}</span></td>
                              <td class="text-nowrap"><span class="text-success font-weight-bold">Rp {{ number_format($value->paid_amount, 0, ',', '.') }}</span></td>
                              <td class="text-nowrap">
                                @if($value->remaning_amount > 0)
                                  <span class="text-danger font-weight-bold">Rp {{ number_format($value->remaning_amount, 0, ',', '.') }}</span>
                                @else
                                  <span class="text-success font-weight-bold">Rp {{ number_format($value->remaning_amount, 0, ',', '.') }}</span>
                                @endif
                              </td>
                              <td>{{ $value->payment_type }}</td>
                              <td>{{ $value->remark }}</td>
                              <td>{{ $value->created_name }}</td>
                              <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                            </tr>
                          @empty
                            <tr>
                              <td colspan="11" class="text-center">Data Tidak Ditemukan</td>
                            </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>

                    <!-- Styling tambahan -->
                    <style>
                      .table-responsive {
                        overflow-x: auto;
                      }

                      .table {
                        width: auto;
                        max-width: none;
                        table-layout: auto;
                      }

                      .table td {
                        white-space: normal;
                        word-wrap: break-word;
                        min-width: 50px;
                        padding: 8px;
                        vertical-align: middle;
                      }

                      .table th {
                        background-color: #f4f6f9;
                        font-weight: 600;
                        vertical-align: middle;
                        padding: 10px 8px;
                      }

                      .text-nowrap {
                        white-space: nowrap !important;
                      }

                      .card-primary.card-outline {
                        border-top: 3px solid #007bff;
                      }

                      .text-center {
                        text-align: center !important;
                      }

                      .font-weight-bold {
                        font-weight: bold;
                      }

                      .text-primary {
                        color: #007bff !important;
                      }

                      .text-success {
                        color: #28a745 !important;
                      }

                      .text-danger {
                        color: #dc3545 !important;
                      }
                    </style>

                    <div class="d-flex justify-content-end mt-3">
                      {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

@endsection

@section('script')
@endsection
