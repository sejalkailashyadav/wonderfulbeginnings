
@extends('layouts.app')

@section('content')

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
            integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
            integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .icon-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 34px;
                height: 34px;
                border-radius: 50%;
                border: none;
                background-color: transparent;
                color: #6c757d;
                transition: 0.3s ease;
                font-size: 14px;
                border: 2px solid black;
            }

            .icon-btn:hover {
                background-color: #f0f0f0;
                color: #fff;
            }

            .edit-icon:hover {
                background-color: #28a745;
                color: white;
                border: 2px solid #28a745;
            }

            .delete-icon:hover {
                background-color: #dc3545;
                color: white;
                border: 2px solid #dc3545;
            }

            .icon-btn i {
                pointer-events: none;
            }
        </style>
    </head>
<div class="container-fluid">
    <h3>Child Records</h3>
        {{-- Export Button --}}
    <button
    style="margin-left: 86%;margin-bottom: 31px;"
        type="button"
        class="btn btn-success mb-3 ml-20"
        onclick="exportTableToExcel('childRecordsTable','child-records.xlsx')"
    >
        <i class="fas fa-file-excel"></i> Export to Excel
    </button>

    <form method="GET" class="row g-2 align-items-center mb-3">
        <div class="col-md-3">
            <select name="center_name" class="form-select">
                <option value="">All Centers</option>
                @foreach ($centers as $c)
                    <option value="{{ $c }}" {{ request('center_name') == $c ? 'selected' : '' }}>
                        {{ $c }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="program_name" class="form-select">
                <option value="">All Programs</option>
                @foreach ($programs as $p)
                    <option value="{{ $p }}" {{ request('program_name') == $p ? 'selected' : '' }}>
                        {{ $p }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="month" class="form-select">
                <option value="">Month</option>
                @foreach (range(1, 12) as $m)
                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="year" class="form-select">
                <option value="">Year</option>
                @for ($y = date('Y'); $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>



    <div class="table-responsive">
        <table id="childRecordsTable" class="table table-bordered table-hover text-center align-middle">
            <thead>
                <tr>
                    <th>CENTER NAME</th>
                    <th>PROGRAM NAME</th>
                    <th>TOTAL Enrolled Children</th>
                    <th>NEW Registrations</th>
                    <th>Withdrawals</th>
                    <th>DETAILS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                    <tr>
                        <td>{{ $item->center_name }}</td>
                        <td>{{ $item->program_name }}</td>
                        <td>{{ $item->total_kids }}</td>
                        <td>{{ $item->new }}</td>
                        <td>{{ $item->leftout }}</td>
                        <td>
                            <a
                                href="{{ route('center-report.details', [
                                    'center'  => $item->center_name,
                                    'program' => $item->program_name,
                                    'month'   => request('month'),
                                    'year'    => request('year')
                                ]) }}"
                                class="btn btn-sm btn-success"
                                target="_blank"
                            >
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No data available for the selected filters.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
  <script>
            const centerSelect = document.querySelector('select[name="center_name"]');
            const programSelect = document.querySelector('select[name="program_name"]');
            const monthSelect = document.querySelector('select[name="month"]');
            const yearSelect = document.querySelector('select[name="year"]');
            function toggleProgramDropdown() {
                programSelect.disabled = centerSelect.value === '';
                monthSelect.disabled = centerSelect.value === '';
                yearSelect.disabled = centerSelect.value === '';
            }

            centerSelect.addEventListener('change', toggleProgramDropdown);
            window.addEventListener('DOMContentLoaded', toggleProgramDropdown);

        </script>
{{-- SheetJS CDN --}}
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
{{-- FontAwesome for the Excel icon --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>

<script>
/**
 * Export an HTML table to an .xlsx file
 * @param {string} tableID - the id of the table element
 * @param {string} filename - the desired filename (with .xlsx)
 */
function exportTableToExcel(tableID, filename = 'export.xlsx') {
  // Create a workbook from the table DOM
  const wb = XLSX.utils.table_to_book(
    document.getElementById(tableID),
    { sheet: "Sheet1" }
  );
  // Trigger the download
  XLSX.writeFile(wb, filename);
}
</script>
@endsection
