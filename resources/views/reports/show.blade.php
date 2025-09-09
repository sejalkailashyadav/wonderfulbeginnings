@extends('layouts.app')

@section('content')
    <div class="container">

        <head>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        </head>

<h2>Monthly Report: {{ $reportInfo->report_name }}</h2>
<div style="margin-bottom: 20px;">
    <!-- <p><strong>Center ID:</strong> {{ $reportInfo->center_id }}</p> -->
    <p><strong>Center:</strong> {{ $reportInfo->center_name }}</p>
    <p><strong>Month-Year:</strong> {{ $reportInfo->month_year }}</p>
</div>


       {{-- Export Button --}}
    <button
        type="button"
        class="btn btn-success mb-3 ml-20"
        onclick="exportTableToExcel('childRecordsTable','child-records.xlsx')"
    >
        <i class="fas fa-file-excel"></i> Export to Excel
    </button>
        <a href="{{ url('/monthly-reports') }}" class="btn btn-secondary mb-3" style="margin-left: 710px;">Back to Monthly Reports</a>

        <div id="messageBox" style="color: red; margin-top: 10px;margin-bottom:10px;"></div>


        <table id="childRecordsTable"  class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Child Name</th>
                    <th>Parent Name</th>
                    <!-- <th>Center</th> -->
                    <th>Program</th>
                    <th>No of Days</th>
                    <th>DOB</th>
                    <th>Fees</th>
                    <th>CCFRI</th>
                    <th>ACCB</th>
                    <th>Received Fees</th>
                     <th>Admission Date</th>
                         <th>Institution Number</th>
                      <th>Transit Number</th>
                       <th>Account Number</th>
                    
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td>{{ $log->child_name }}</td>
                        <td>{{ $log->parent_name }}</td>
                        <!-- <td>{{ $log->center_name }}</td> -->
                        <td>{{ $log->program_name }}</td>
                        <td>{{ $log->number_of_days }}</td>
                        <td>{{ $log->date_of_birth }}</td>
                        <!-- <td>{{ $log->total_fees }}</td>
                                                        <td>{{ $log->ccfri }}</td> -->



                        <td id="total-fees-{{ $log->report_log_id }}">{{ $log->total_fees }}</td>
                        <td id="ccfri-{{ $log->report_log_id }}">{{ $log->ccfri }}</td>


                        <!-- <td>{{ $log->accb }}</td> -->
                        <td>
                            <form class="accb-form-{{ $log->report_log_id }}"
                                action="{{ url('monthly-reports/update-accb/' . $log->report_log_id) }}" method="POST">
                                @csrf
                                <span class="accb-value-{{ $log->report_log_id }}">{{ $log->accb
                                                                                            }}</span>
                                <input type="number" step="0.01" name="accb"
                                    class="form-control d-none accb-input-{{ $log->report_log_id }}" value="{{ $log->accb }}"
                                    style="width: 100px; display: inline-block;" />
                                <input type="hidden" name="report_log_id" value="{{ $log->report_log_id }}"
                                    class="accb-hidden-{{ $log->report_log_id }}">
                                <button type="button" onclick="editAccb({{ $log->report_log_id }})"><i
                                        class="fa-solid fa-pen"></i></button>
                                <button type="button" style="color: #5e2dd8" ;
                                    class="btn btn-sm btn-success d-none save-btn-{{ $log->report_log_id }}"
                                    onclick="updateAccb({{ $log->report_log_id }})"><i class="fa-solid fa-save"></i></button>
                            </form>
                        </td>
                        <!-- <td>{{ $log->received_parent_fees }}</td> -->
                        <td id="parent-fees-{{ $log->report_log_id }}">
                            {{ number_format($log->total_fees - ($log->ccfri + $log->accb), 2) }}
                        </td>
                        <td>{{ $log->admission_date }}</td>
                         <td>{{ $log->institution_number}}</td>
                      <td>	{{ $log->transit_number}}</td>
                       <td>{{ $log->account_number}}</td>
                        <td>
                            <a href="{{ url('/report-logs/' . $log->report_log_id . '/edit') }}"><i
                                    class="fa-solid fa-pen"></i></a>

                            <!-- <form action="{{ url('/report-logs/' . $log->report_log_id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: #ce378b;" onclick="return confirm('Are you sure?')"><i
                                        class="fa-solid fa-trash"></i></button>
                            </form> -->
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No report logs found for this month.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        function editAccb(feeId) {
            document.querySelector(`.accb-value-${feeId}`).classList.add('d-none');
            document.querySelector(`.accb-input-${feeId}`).classList.remove('d-none');
            document.querySelector(`.save-btn-${feeId}`).classList.remove('d-none');
        }
        function updateAccb(feeId) {
            const form = document.querySelector(`.accb-form-${feeId}`);
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // alert(data.message);
                        const messageBox = document.getElementById('messageBox');
                        if (data.success) {
                            messageBox.style.color = 'green';
                            messageBox.textContent = data.message || 'Update successful.';
                        } else {
                            messageBox.style.color = 'red';
                            messageBox.textContent = data.message || 'Update failed.';
                        }
                        setTimeout(() => {
                            messageBox.textContent = '';
                        }, 1000);


                        const newAccb = parseFloat(form.querySelector(`.accb-input-${feeId}`).value) || 0;
                        const ccfri = parseFloat(document.querySelector(`#ccfri-${feeId}`).innerText) || 0;
                        const totalFees = parseFloat(document.querySelector(`#total-fees-${feeId}`).innerText) || 0;

                        const newParentFees = totalFees - (ccfri + newAccb);

                        // Update UI
                        document.querySelector(`.accb-value-${feeId}`).innerText = newAccb.toFixed(2);
                        document.querySelector(`.accb-value-${feeId}`).classList.remove('d-none');
                        form.querySelector(`.accb-input-${feeId}`).classList.add('d-none');
                        form.querySelector(`.save-btn-${feeId}`).classList.add('d-none');

                        // Update parent fees field
                        document.querySelector(`#parent-fees-${feeId}`).innerText = newParentFees.toFixed(2);

                        //     } else {
                        //         alert(data.message || 'Update failed.');
                        //     }
                        // })
                        // .catch(error => {
                        //     console.error('Error:', error);
                        //     // alert('Something went wrong.');
                        // });
                    } else {
                        const messageBox = document.getElementById('messageBox');
                        messageBox.textContent = data.message || 'Update failed.';
                    }
                }).catch(error => {
                    console.error('Error:', error);
                    const messageBox = document.getElementById('messageBox');
                    messageBox.textContent = 'Something went wrong.';
                });

        }
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