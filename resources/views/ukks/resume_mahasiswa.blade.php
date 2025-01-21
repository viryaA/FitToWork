<!-- resources/views/form.blade.php -->
@extends('layouts.ukk')

@section('title', 'Form Absensi Kesehatan')
@section('style')
<style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
        }
        .subheader {
            font-size: 1.5rem;
            font-weight: bold;
            color: #000;
        }
        .divider {
            border-top: 1px solid #dee2e6;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }
    </style>
@endsection
@section('content')
<div class="content">
    <div class="d-flex align-items-center">
            <span class="header">Fit to Work</span>
            <span class="mx-2">/</span>
            <span class="subheader">Kesehatan</span>
            <span class="mx-2">/</span>
            <span class="subheader">Resume Mahasiswa</span>
    </div>
    <div class="divider"></div>
    <div class="card mb-4">
        <div class="card-header" style="background-color: #007bff; color: white;">
            <i><strong>Mengirim Resume Ke Mahasiswa</strong></i>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="programStudi">Program Studi <span class="required">*</span></label>
                        <select id="programStudi" class="form-control" required>
                            <option value="">-- Pilih Program Studi --</option>
                            <option value="TI">Teknik Informatika</option>
                            <option value="SI">Sistem Informasi</option>
                            <option value="MI">Manajemen Informatika</option>
                            <option value="TK">Teknik Komputer</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="namaMahasiswa">Nama Mahasiswa <span class="required">*</span></label>
                    <textarea id="namaMahasiswa" class="form-control" rows="1" placeholder="Masukkan Nama Mahasiswa" required></textarea>
                </div>
            </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tingkat">Tingkat <span class="required">*</span></label>
                        <textarea id="tingkat" class="form-control" rows="1" placeholder="Masukkan Tingkat Mahasiswa" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nim">NIM <span class="required">*</span></label>
                        <textarea id="nim" class="form-control" rows="1" placeholder="Masukkan NIM Mahasiswa" required></textarea>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <!-- Date Section -->
            <div class="form-group mb-4">
                <div class="row">
                    <!-- Kolom Tanggal -->
                    <div class="col-md-6">
                        <label for="tanggal">Tanggal <span class="required">*</span></label>
                        <p id="tanggal">{{ date('Y-m-d') }}</p>
                    </div>
                    <!-- Kolom Keterangan -->
                    <div class="col-md-6">
                        <label for="keterangan">Keterangan <span class="required">*</span></label>
                        <textarea id="keterangan" class="form-control" rows="4" placeholder="Masukkan Keterangan Sakit" required></textarea>
                    </div>
                </div>
                <!-- Kolom Dokumen -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label for="dokumen">Dokumen <span class="required">*</span></label>
                        <input type="file" id="dokumen" class="form-control" accept=".pdf" required>
                        <small class="form-text text-muted">Unggah file dalam format PDF. Maksimal ukuran 2 MB.</small>
                    </div>
                </div>
            </div>
            <!-- Tombol Kembali dan Simpan -->
            <div class="form-group text-right">
                <button type="button" class="btn btn-secondary">Kembali</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection