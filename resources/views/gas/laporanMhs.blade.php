@extends('layouts.dka')

@section('title', 'Laporan Kesehatan Mahasiswa')

@section('style')
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table th {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            cursor: pointer;
        }
        .table td {
            text-align: center;
        }
        .header {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
        }
        .divider {
            border-top: 1px solid #dee2e6;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }
        .table-striped tbody tr:nth-of-type(even) {
            background-color: #f2f2f2;
        }
        .filter-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .search-bar {
            width: 300px;
            padding: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        .btn-filter, .btn-export {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-filter:hover {
            background-color: #0056b3;
        }
        .btn-export {
            background-color: #28a745;
        }
        .btn-export:hover {
            background-color: #218838;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            font-size: 1.2rem;
            font-weight: bold;
        }
        .table-container {
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <div class="content mt-4">
        <div class="d-flex align-items-center">
            <span class="header">Fit to Work</span>
            <span class="mx-2">/</span>
            <span class="subheader">Laporan</span>
            <span class="mx-2">/</span>
            <span class="subheader">Laporan Kesehatan Mahasiswa</span>
        </div>
        <div class="divider"></div>

        <div class="card">
            <div class="card-header">
                Laporan Kesehatan Mahasiswa
            </div>
            <div class="card-body">
                <div class="filter-container">
                    <input type="text" class="search-bar" id="searchInput" placeholder="Cari berdasarkan Tanggal, Status, Nama">
                    <div>
                        <button class="btn-filter"><i class="fas fa-filter"></i> Filter</button>
                        <button class="btn-export" onclick="exportToExcel()"><i class="fas fa-download"></i> Export</button>
                    </div>
                </div>

                <div class="table-container">
                    <table class="table table-bordered table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th onclick="sortTable(0)">No <span class="sort-icon">▲</span></th>
                                <th onclick="sortTable(1)">Tanggal <span class="sort-icon">▲</span></th>
                                <th onclick="sortTable(2)">Status <span class="sort-icon">▲</span></th>
                                <th onclick="sortTable(3)">Nama <span class="sort-icon">▲</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratKeterangan as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->res_submitted_at)->translatedFormat('d F Y') }}</td>
                                    <td class="{{ $item->res_status === 'Sehat' ? 'text-success' : 'text-danger' }}">
                                        {{ $item->res_status }}
                                    </td>
                                    <td>{{ $item->mhs_nama }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-left mt-3">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.2/xlsx.full.min.js"></script>
    <script>
        document.getElementById("searchInput").addEventListener("keyup", function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll("#dataTable tbody tr");
            rows.forEach(row => {
                var text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        });

        function sortTable(columnIndex) {
            var table = document.getElementById("dataTable");
            var tbody = table.querySelector("tbody");
            var rows = Array.from(tbody.rows);
            var headers = document.querySelectorAll("#dataTable th");
            var icons = document.querySelectorAll(".sort-icon");
            var ascending = table.dataset.sortOrder !== "asc";
            table.dataset.sortOrder = ascending ? "asc" : "desc";

            rows.sort((a, b) => {
                var aText = a.cells[columnIndex].innerText.trim();
                var bText = b.cells[columnIndex].innerText.trim();
                return ascending ? aText.localeCompare(bText) : bText.localeCompare(aText);
            });
            rows.forEach(row => tbody.appendChild(row));

            icons.forEach(icon => icon.textContent = "▲");
            if (!ascending) {
                icons[columnIndex].textContent = "▼";
            }
        }

        function exportToExcel() {
        var table = document.getElementById("dataTable");
        var wb = XLSX.utils.book_new();
        var ws = XLSX.utils.table_to_sheet(table);

        let range = XLSX.utils.decode_range(ws['!ref']);
        for (let R = range.s.r + 1; R <= range.e.r; R++) { 
            let cellAddress = XLSX.utils.encode_cell({ r: R, c: 1 }); 
            if (ws[cellAddress] && ws[cellAddress].v) {
                let value = ws[cellAddress].v.toString(); 

                if (/\d{1,2}\/\d{1,2}\/\d{4}/.test(value)) { 
                    let [month, day, year] = value.split('/');
                    let date = new Date(year, month - 1, day);

                    let formattedDate = `${date.getDate()} ${new Intl.DateTimeFormat('id-ID', { month: 'long' }).format(date)} ${date.getFullYear()}`;

                    ws[cellAddress] = { v: formattedDate, t: "s" };
                }
            }
        }

        XLSX.utils.book_append_sheet(wb, ws, "Laporan");
        XLSX.writeFile(wb, "Laporan_Kesehatan_Mahasiswa.xlsx");
        }
    </script>
@endsection
