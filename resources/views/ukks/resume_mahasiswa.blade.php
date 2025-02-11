@extends('layouts.ukk')

@section('title', 'Resume Absensi Kesehatan')


@section('content')
<div class="content mt-4">
    <div class="d-flex align-items-center">
        <span class="header">Fit to Work</span>
        <span class="mx-2">/</span>
        <span class="subheader">Kesehatan</span>
        <span class="mx-2">/</span>
        <span class="subheader">Resume</span>
    </div>
    <div class="divider"></div>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('resume.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="tipe">Tipe *</label>
            <select id="tipe" name="tipe" class="form-control" onchange="toggleFields()">
                <option value="mahasiswa">Mahasiswa</option>
                <option value="karyawan">Karyawan</option>
            </select>
        </div>

        {{-- Form Mahasiswa --}}
        <div id="mahasiswaFields">
            <div class="form-group">
                <label for="nim">Nomor Induk Mahasiswa (NIM) *</label>
                <input type="text" id="nim" name="nim" class="form-control">
                <button type="button" class="btn btn-primary mt-2" onclick="cariMahasiswa()">Cari</button>
            </div>
            <div class="form-group">
                <label for="mhs_nama">Nama Mahasiswa *</label>
                <input type="text" id="mhs_nama" name="mhs_nama" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="program_studi">Program Studi *</label>
                <input type="text" id="program_studi" name="program_studi" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="mhs_angkatan">Angkatan *</label>
                <input type="text" id="mhs_angkatan" name="mhs_angkatan" class="form-control" readonly>
            </div>
        </div>

        {{-- Form Karyawan --}}
        <div id="karyawanFields" style="display: none;">
            <div class="form-group">
                <label for="npk">Nomor Pokok Karyawan (NPK) *</label>
                <input type="text" id="npk" name="npk" class="form-control">
                <button type="button" class="btn btn-primary mt-2" onclick="cariKaryawan()">Cari</button>
            </div>
            <div class="form-group">
                <label for="nama_karyawan">Nama Karyawan *</label>
                <input type="text" id="nama_karyawan" name="nama_karyawan" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="bagian">Bagian *</label>
                <input type="text" id="bagian" name="bagian" class="form-control" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal *</label>
            <input type="date" id="tanggal" name="tanggal" class="form-control">
        </div>

        <div class="form-group">
            <label for="dokumen">Dokumen Resume (.pdf) *</label>
            <input type="file" id="dokumen" name="dokumen" class="form-control" accept=".pdf" required>
            <small>Maksimum ukuran berkas adalah 10MB</small>
        </div>

        <button type="submit" class="btn btn-primary">Kirim</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

{{-- JavaScript --}}
<script>
    function toggleFields() {
        let tipe = document.getElementById('tipe').value;
        document.getElementById('mahasiswaFields').style.display = tipe === 'mahasiswa' ? 'block' : 'none';
        document.getElementById('karyawanFields').style.display = tipe === 'karyawan' ? 'block' : 'none';
    }

    function cariMahasiswa() {
    let nim = document.getElementById('nim').value;
    fetch(`/api/cari-mahasiswa/${nim}`)
        .then(response => response.json())
        .then(data => {
            if (data && data.mhs_nama) {
                document.getElementById('mhs_nama').value = data.mhs_nama;
                document.getElementById('program_studi').value = data.program_studi;
                document.getElementById('mhs_angkatan').value = data.mhs_angkatan;
            } else {
                alert('Data tidak ditemukan, harap masukkan NIM yang benar.');
            }
        })
        .catch(() => alert('Terjadi kesalahan, coba lagi.'));
}


    function cariKaryawan() {
        let npk = document.getElementById('npk').value.trim();
        if (!npk) {
            alert("Silakan masukkan NPK terlebih dahulu.");
            return;
        }

        fetch(`/api/cari-karyawan/${npk}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.kry_nama_depan && data.kry_nama_blk) {
                    document.getElementById('nama_karyawan').value = data.kry_nama_depan + ' ' + data.kry_nama_blk;
                    document.getElementById('bagian').value = data.hasOwnProperty('Bagian') ? data.Bagian : 'Tidak tersedia';
                } else {
                    alert('Data tidak ditemukan, harap masukkan data yang benar.');
                }
            })
            .catch(() => alert('Gagal mengambil data. Silakan coba lagi.'));
    }

    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("tanggal").valueAsDate = new Date();
    });
</script>
@endsection
