@extends('layouts.app')

@section('content')
    <!-- <h4 class="mb-4" style="color: #6023d5bd">| Children Details - {{ $center }} | {{ $program }} | -->

    <!-- </h4> -->
{{-- Export Button --}}
    <button
    style="margin-left: 86%;margin-bottom: 31px;"
        type="button"
        class="btn btn-success"
        onclick="exportTableToExcel('childRecordsTable','child-records.xlsx')"
    >
        <i class="fas fa-file-excel"></i> Export to Excel
    </button>
       <h4 class="mb-4" style="color: #6023d5bd;font-weight: 600;">| Children Details - {{ $center }} | {{ $program }} | 

     </h4>
  
    <div class="table-responsive">
        <table id="childRecordsTable" class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <!-- <th>Child ID</th> -->
                      <th>Center Name</th>
                    <th>Program Name </th>
                    <th>Child Name</th>
                    <th>Parent Name</th>
                    <th>Child DOB</th>
                    <th>Status </th>
                    <th>Number of Days</th>
                    <th>Admission Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($children as $child)
                    <tr>
                        <!-- <td>{{ $child->child_id }}</td> -->
                          <td>{{ $child->center_name }}</td>
                            <td>{{ $child->program_name }}</td>
                        <td>{{ $child->child_first_name }} {{ $child->child_last_name }}</td>
                        <td>{{ $child->parent_first_name }} {{ $child->parent_last_name }}</td>
                        <td>{{ $child->child_dob }}</td>
                        <td>{{ $child->active_status }}</td>
                        <td>{{ $child->number_of_days }}</td>
                        <td>{{ $child->admission_date }}</td>
                        <td>{{ $child->end_date ?? 'N/A' }}</td>

                        <td> <a href="javascript:void(0);" class="account-link" data-child-id="{{ $child->child_id }}">
        Edit child details
    </a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No children found for this selection.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script>
    
    document.querySelectorAll('.account-link').forEach(link => {
        link.addEventListener('click', function () {
            const childId = this.getAttribute('data-child-id');
            console.log("Child ID:", childId);

            if (childId) {
                window.location.href = `/child-masters/${childId}/edit`;
            } else {
                alert("Child ID not found.");
            }
        });
    });

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