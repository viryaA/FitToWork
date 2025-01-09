<!-- resources/views/form.blade.php -->
@extends('layouts.ga')

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
            <span class="subheader">Absensi</span>
    </div>
    <div class="divider"></div>
    <div class="card mb-4">
        <div class="card-header" style="background-color: #007bff; color: white;">
            <i><strong>Kuesioner Self-Assessment Fit to Work</strong></i>
        </div>
    </div>

    <div class="card mb-4">
        <!-- Card Header with Blue Background -->
        <div class="card-header" style="background-color: #007bff; color: white;">
            <strong>Instruksi</strong>
        </div>

        <!-- Card Body with White Background -->
        <div class="card-body">
            <p>Silakan jawab pertanyaan di bawah ini dengan jujur dan sesuai dengan kondisi Anda saat ini. Kuesioner ini membantu menilai apakah Anda layak bekerja demi menjaga keselamatan dan kesehatan Anda serta rekan kerja.</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header" style="background-color: #007bff; color: white;">
            <i><strong>Form Absensi Kesehatan</strong></i>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama">Nama <span class="required">*</span></label>
                        <p id="nama">Virya Yasa Santoso</p>
                    </div>
                    <div class="form-group">
                        <label for="bagian">Bagian <span class="required">*</span></label>
                        <p id="bagian">General Advisor</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="npk">Nomor Pokok Karyawan(NPK) <span class="required">*</span></label>
                        <p id="npk">0320230119</p>
                    </div>
                </div>
            </div>
    
            <hr class="my-4">
    
            <!-- Date Section -->
            <div class="form-group mb-4">
                <label for="tanggal">Tanggal <span class="required">*</span></label>
                <p id="tanggal">{{ date('Y-m-d') }}</p>
            </div>

            <!-- Sleep Time Inputs -->
            <div class="form-group mb-4">
                <label for="tidurmalam">Pukul berapa Anda tidur tadi malam? <span class="required">*</span></label>
                <input type="time" class="form-control" id="tidurmalam" required>
            </div>
    
            <div class="form-group mb-4">
                <label for="bangunpagi">Pukul berapa Anda bangun pagi ini? <span class="required">*</span></label>
                <input type="time" class="form-control" id="bangunpagi" required>
            </div>
    
            <!-- Physical Health Question -->
        <div class="form-group mb-4">
            <label for="sehatfisik">Apakah Anda merasa cukup sehat secara fisik untuk melakukan tugas pekerjaan Anda saat ini? <span class="required">*</span></label>
            <div>
                <label>
                    <input type="radio" name="sehatfisik" value="ya" required> Ya
                </label>
                <label>
                    <input type="radio" name="sehatfisik" value="tidak" required> Tidak
                </label>
            </div>
        </div>

            <!-- Symptoms Question -->
        <div class="form-group mb-4">
            <label for="gejala">Apakah Anda mengalami salah satu dari gejala berikut dalam 7 hari terakhir? <span class="required">*</span></label>
            <div>
                <label>
                    <input type="checkbox" name="gejala" value="demam"> Demam (≥37.5°C)
                </label><br>
                <label>
                    <input type="checkbox" name="gejala" value="batuk"> Batuk
                </label><br>
                <label>
                    <input type="checkbox" name="gejala" value="sesak-napas"> Sesak napas
                </label><br>
                <label>
                    <input type="checkbox" name="gejala" value="sakit-tenggorokan"> Sakit tenggorokan
                </label><br>
                <label>
                    <input type="checkbox" name="gejala" value="nyeri-tubuh"> Nyeri tubuh
                </label><br>
                <label>
                    <input type="checkbox" name="gejala" value="kehilangan-indra"> Kehilangan indra perasa atau penciuman
                </label><br>
                <label>
                    <input type="checkbox" name="gejala" value="diare"> Diare
                </label><br>
                <label>
                    <input type="checkbox" name="gejala" value="mual-muntah"> Mual/Muntah
                </label><br>
                <label>
                    <input type="checkbox" name="gejala" value="tidak-ada"> Tidak ada gejala di atas
                </label>
            </div>
        </div>

        <!-- Chronic Illness Question -->
            <div class="form-group mb-4">
                <label for="penyakit-kronis">Apakah Anda memiliki penyakit kronis (misalnya asma, diabetes, hipertensi) yang saat ini memengaruhi kemampuan Anda untuk bekerja? <span class="required">*</span></label>
                <div>
                    <label>
                        <input type="radio" name="penyakit-kronis" value="ya" required onclick="togglePenyakitKronis(true)"> Ya
                    </label>
                    <label>
                        <input type="radio" name="penyakit-kronis" value="tidak" required onclick="togglePenyakitKronis(false)"> Tidak
                    </label>
                </div>
            </div>
            <div id="penyakit-kronis-wrapper" style="display:none;">
                <label for="penyakit-kronis-detail">Jika Ya, sebutkan:</label>
                <textarea class="form-control" name="penyakit-kronis-detail" id="penyakit-kronis-detail" rows="4"></textarea>
            </div>
            <!-- Action Buttons -->
            <div class="form-group">
                <button type="reset" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        function toggleTextarea(show) {
            const textareaWrapper = document.getElementById('textareaWrapper');
            if (show) {
            textareaWrapper.style.display = 'block';
            } else {
            textareaWrapper.style.display = 'none';
            }
        }
    </script>
@endsection
