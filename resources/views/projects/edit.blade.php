@extends('layouts.admin')

@section('main-content')

<h1 class="h3 mb-4 text-gray-800">Edit Project</h1>

@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger border-left-danger" role="alert">
    <ul class="pl-4 my-2">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="img">Gambar Project:</label><br>
                    <img src="{{ asset('images/' . $project->img) }}" height="200" width="auto">

                    <input type="file" class="form-control-file" id="img" name="img">
                </div>

                <div class="form-group">
                    <label for="nama">Nama Project:</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $project->nama }}" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ $project->deskripsi }}</textarea>
                </div>

                <div class="form-group">
                    <label for="tujuan">Tujuan:</label>
                    <textarea class="form-control" id="tujuan" name="tujuan" required>{{ $project->tujuan }}</textarea>
                </div>

                <div class="form-group">
                    <label for="start_date">Start Date:</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $project->start_date }}" required>
                </div>

                <div class="form-group">
                    <label for="end_date">End Date:</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $project->end_date }}" required>
                </div>

                <div class="form-group">
                    <label for="provinsi">Provinsi:</label>
                    <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ $project->provinsi }}" required>
                </div>

                <div class="form-group">
                    <label for="kota">Kota:</label>
                    <input type="text" class="form-control" id="kota" name="kota" value="{{ $project->kota }}" required>
                </div>

                <div class="form-group">
                    <label for="gmaps">Google Maps URL:</label>
                    <input type="text" class="form-control" id="gmaps" name="gmaps" value="{{ $project->gmaps }}" required>
                </div>

                <div class="form-group">
                    <label for="jumlah_pendanaan">Jumlah Dana:</label>
                    <input type="number" class="form-control" id="jumlah_pendanaan" name="jumlah_pendanaan" value="{{ $project->jumlah_pendanaan }}" required>
                </div>

                <div class="form-group">
                    <label for="jenis_dana">Jenis Dana:</label>
                    <select class="form-control" id="jenis_dana" name="jenis_dana" required>
                        <option value="Hibah" {{ $project->jenis_dana == 'Hibah' ? 'selected' : '' }}>Hibah</option>
                        <option value="Investasi" {{ $project->jenis_dana == 'Investasi' ? 'selected' : '' }}>Investasi</option>
                        <option value="Pinjaman" {{ $project->jenis_dana == 'Pinjaman' ? 'selected' : '' }}>Pinjaman</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="dana_lain">Dana Lainnya:</label>
                    <input type="text" class="form-control" id="dana_lain" name="dana_lain" value="{{ $project->dana_lain }}" required>
                </div>

                <div class="form-group">
                    <label for="company_id">Company:</label>
                    <select class="form-control" id="company_id" name="company_id" required>
                        <option value="">Pilih Company</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}" {{ $project->company_id == $company->id ? 'selected' : '' }}>{{ $company->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tags">Tags:</label>
                    <select multiple class="form-control" id="tags" name="tag_ids[]">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" {{ $project->tags->contains($tag->id) ? 'selected' : '' }}>{{ $tag->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="sdgs">SDGs:</label>
                    <select multiple class="form-control" id="sdgs" name="sdg_ids[]">
                        @foreach($sdgs as $sdg)
                        <option value="{{ $sdg->id }}" {{ $project->sdgs->contains($sdg->id) ? 'selected' : '' }}>{{ $sdg->order }}. {{ $sdg->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="indicators">Indicators:</label>
                    <select multiple class="form-control" id="indicators" name="indicator_ids[]">
                        @foreach ($indicators as $indicator)
                            <option value="{{ $indicator->id }}" {{ $project->indicators->contains($indicator->id) ? 'selected' : '' }}>{{ $indicator->order }} {{ $indicator->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="metrics">Metrics:</label>
                    <select multiple class="form-control" id="metrics" name="metric_ids[]">
                        @foreach ($metrics as $metric)
                            <option value="{{ $metric->id }}" {{ $project->metrics->contains($metric->id) ? 'selected' : '' }}>({{ $metric->code }}) {{ $metric->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <h4>Target Pelanggan
                    <button type="button" class="btn btn-primary btn-add"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></button>
                </h4>
                <div class="form-group">
                    <label for="target_pelanggans">Target Pelanggan:</label>
                    <div class="target-pelanggan">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Status Pekerjaan</th>
                                    <th>Rentang Usia</th>
                                    <th>Deskripsi Pelanggan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($project->targetPelanggan as $index => $target)
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="target_pelanggans[{{ $index }}][status]" value="{{ $target->status }}" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="target_pelanggans[{{ $index }}][rentang_usia]" value="{{ $target->rentang_usia }}">
                                        </td>
                                        <td>
                                            <textarea class="form-control" name="target_pelanggans[{{ $index }}][deskripsi_pelanggan]">{{ $target->deskripsi_pelanggan }}</textarea>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Project</button>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    var index = {{ count($project->targetPelanggan) }};
    $(".btn-add").click(function () {
        var newRow = '<tr>' +
            '<td><input type="text" class="form-control" name="target_pelanggans[' + index + '][status]" required></td>' +
            '<td><input type="text" class="form-control" name="target_pelanggans[' + index + '][rentang_usia]"></td>' +
            '<td><textarea class="form-control" name="target_pelanggans[' + index + '][deskripsi_pelanggan]"></textarea></td>' +
            '</tr>';
        $('.target-pelanggan tbody').append(newRow);
        index++;
    });
});

</script>

@endsection
