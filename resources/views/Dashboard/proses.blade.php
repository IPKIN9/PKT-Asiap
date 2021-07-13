@extends('layouts.DsTemplate')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="small">
                @if (session('status'))
                <div class="alert alert-success mt-2">
                    {{ session('status') }}
                </div>
                @endif
            </div>
            <div class="card-header">
                <h4>Data Proses Kirim</h4>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Tabel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Tambah Data</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No. Resi</th>
                                    <th>Pengirim</th>
                                    <th>Tujuan</th>
                                    <th>Hp</th>
                                    <th>Keterangan</th>
                                    <th>Created at</th>
                                    <th>Deleted at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['proses'] as $d)
                                <tr>
                                    <th>{{$d->no_resi}}</th>
                                    <th>{{$d->pengirimi_rerol->nama}}</th>
                                    <th>{{$d->tujuan_rerol->cabang}}</th>
                                    <th>{{$d->no_hp}}</th>
                                    <th>{{$d->ket}}</th>
                                    <th>{{date('d-m-Y', strtotime($d->created_at))}}</th>
                                    <th>{{date('d-m-Y', strtotime($d->updated_at))}}</th>
                                    <th>
                                        <button type="button" data-id="{{$d->id}}"
                                            class="md-detail btn btn-icon btn-info">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        <button type="button" data-id="{{$d->id}}"
                                            class="md-hapus btn btn-icon btn-danger">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No. Resi</th>
                                    <th>Pengirim</th>
                                    <th>Tujuan</th>
                                    <th>Hp</th>
                                    <th>Keterangan</th>
                                    <th>Created at</th>
                                    <th>Deleted at</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="col-12">
                            <form action="" method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <h4>BUat data baru</h4>
                                    </div>
                                    <div class="card-body">
                                        <form class="wizard-content mt-2">
                                            <div class="wizard-pane">
                                                <div class="form-group row align-items-center">
                                                    @error('pengirim_id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <label class="col-md-4 text-md-right text-left">Nama
                                                        Pengirim</label>
                                                    <select name="pengirim_id" class="col-lg-6 col-md-6 form-control">
                                                        <option selected disabled>Pilih</option>
                                                        @foreach ($data['pengirim'] as $d)
                                                        <option value="{{$d->id}}">{{$d->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    @error('asal')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <label class="col-md-4 text-md-right text-left">Asal</label>
                                                    <select name="asal" class="col-lg-6 col-md-6 form-control">
                                                        <option selected disabled>Pilih</option>
                                                        @foreach ($data['lokasi'] as $d)
                                                        <option value="{{$d->id}}">{{$d->cabang}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    @error('tujuan')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <label class="col-md-4 text-md-right text-left">Tujuan</label>
                                                    <select name="tujuan" class="col-lg-6 col-md-6 form-control">
                                                        <option selected disabled>Pilih</option>
                                                        @foreach ($data['lokasi'] as $d)
                                                        <option value="{{$d->id}}">{{$d->cabang}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    @error('no_hp')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <label class="col-md-4 text-md-right text-left">Nomor Hp</label>
                                                    <div class="col-lg-6 col-md-6">
                                                        <input type="text" name="no_hp" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    @error('ket')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <label
                                                        class="col-md-4 text-md-right text-left mt-2">Keterangan</label>
                                                    <div class="col-lg-6 col-md-6">
                                                        <textarea class="form-control" name="ket"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    @error('supir')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <label class="col-md-4 text-md-right text-left">Supir</label>
                                                    <select name="supir" class="col-lg-6 col-md-6 form-control">
                                                        <option selected disabled>Pilih</option>
                                                        @foreach ($data['supir'] as $d)
                                                        <option value="{{$d->id}}">{{$d->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    @error('mobil_id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <label class="col-md-4 text-md-right text-left">Mobil</label>
                                                    <select name="mobil_id" class="col-lg-6 col-md-6 form-control">
                                                        <option selected disabled>Pilih</option>
                                                        @foreach ($data['mobil'] as $d)
                                                        <option value="{{$d->id}}">{{$d->plat}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-lg-6 col-md-6 text-right">
                                                        <button type="submit"
                                                            class="btn btn-icon icon-right btn-primary">Next <i
                                                                class="fas fa-arrow-right"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')

@endsection
@section('js')
<script>
    $(document).ready(function()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#myTable').DataTable();
    });
</script>
@endsection