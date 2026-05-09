@extends('admin.layout')

@section('content')
<style>
    /* Theme Colors and Variables */
    :root {
        --theme-green: #ADCD25;
        --theme-green-rgb: 173, 205, 37;
        --dark-gradient: linear-gradient(90deg, #1a1a1a 0%, #2d2d2d 100%);
        --text-dark: #1a1a1a;
        --card-bg: #ffffff;
    }

    /* Page Header */
    .page-header {
        background: var(--dark-gradient);
        color: var(--theme-green);
        border-bottom: 3px solid var(--theme-green);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 15px 20px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        margin-bottom: 20px;
        text-align: center;
    }

    /* Table Styling */
    .table-modern {
        font-size: 0.85rem;
        color: var(--text-dark);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .table-modern thead {
         background: linear-gradient(90deg, #1a1a1a 0%, #2d2d2d 100%);

        /* Your Volt Green for the text and a bottom border */
        color: #ADCD25;
        border-bottom: 3px solid #ADCD25;

        /* Modern styling */
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 15px 20px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        margin-bottom: 0;
    }

    .table-modern th,
    .table-modern td {
        vertical-align: middle;
        padding: 12px 15px;
        border-bottom: 1px solid #e5e7eb;
    }

    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:after {
        display: none !important;
    }

    .table-modern tbody tr:hover {
        background: rgba(173, 205, 37, 0.05);
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }

    .table-modern tbody tr {
        transition: all 0.2s ease;
    }

    /* DataTables Buttons Styling */
    .dt-buttons .btn {
        border-radius: 6px;
        font-weight: 600;
        padding: 8px 16px;
        margin: 0 4px 20px 0;
        background: linear-gradient(45deg, #cdff00 0%, #799402 100%);
        color: #000 !important;
        border: none;
        box-shadow: 0 2px 6px rgba(121, 148, 2, 0.18);
        transition: all 0.25s ease;
    }

    .dt-buttons .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(121, 148, 2, 0.3);
        filter: brightness(1.05);
    }

    /* Mobile Vertical Table Styling */
    @media (max-width: 767px) {
        .table-modern thead {
            display: none;
        }

        .table-modern tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 2px solid var(--theme-green);
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            background: var(--card-bg);
            transition: all 0.3s ease;
        }

        .table-modern tbody tr:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(173, 205, 37, 0.2);
            border-color: #799402;
        }

        .table-modern tbody td {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dotted #ccc;
        }

        .table-modern tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            width: 40%;
            color: var(--text-dark);
        }

        .table-modern tbody td[data-label="Member Name"] {
            font-weight: 700;
            color: var(--theme-green);
            font-size: 1.05rem;
            border-bottom: 2px solid var(--theme-green);
        }
    }

    /* Desktop Table Row Hover */
    @media (min-width: 768px) {
        .table-modern tbody tr:hover {
            background: rgba(173, 205, 37, 0.08);
            border-left: 4px solid var(--theme-green);
        }

        .table-modern tbody td[data-label="Member Name"] {
            font-weight: 600;
            color: var(--theme-green);
        }
    }

    /* Responsive Container */
    .container-fluid {
        padding: 20px;
    }

    /* Page Title */
    h3.page-title {
        color: var(--theme-green);
        font-weight: 700;
        text-align: center;
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
</style>

<div class="container-fluid py-4" style="margin-top: 72px; min-width:80vw;">
    <h3 class="page-title">All Members History</h3>

    {{-- Table --}}
    <div class="table-responsive">
        <table id="historyTable" class="table table-bordered align-middle table-modern">
            <thead>
                <tr>
                    <th>Member Name</th>
                    <th>Mobile</th>
                    <th>Aadhar</th>
                    <th>Package</th>
                    <th>Signup Fees</th>
                    <th>Valid From</th>
                    <th>Valid To</th>
                    <th>Renewed At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histories as $h)
                <tr>
                    <td data-label="Member Name">{{ $h->first_name }} {{ $h->last_name }}</td>
                    <td data-label="Mobile">{{ $h->mobile }}</td>
                    <td data-label="Aadhar">{{ $h->aadhar }}</td>
                    <td data-label="Package">{{ $h->membership_name }}</td>
                    <td data-label="Signup Fees">{{ $h->signup_fee }}</td>
                    <td data-label="Valid From">{{ $h->valid_from }}</td>
                    <td data-label="Valid To">{{ $h->valid_to }}</td>
                    <td data-label="Renewed At">{{ $h->renewed_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- DataTables --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
    $(document).ready(function() {
    var isMobile = window.innerWidth <= 767; // Mobile width condition

    var buttonsConfig = isMobile
        ? [
            { extend: 'pdf', className: 'btn btn-sm me-1' },
            { extend: 'print', className: 'btn btn-sm' }
          ]
        : [
            { extend: 'csv', className: 'btn btn-sm me-1' },
            { extend: 'pdf', className: 'btn btn-sm me-1' },
            { extend: 'print', className: 'btn btn-sm' }
          ];

    $('#historyTable').DataTable({
        dom: 'Bfrtip',
        buttons: buttonsConfig,
        responsive: true,
        ordering: false
    });
});

</script>

<style>
    table#historyTable thead th {
    text-align: center;
    vertical-align: middle; /* optional, vertical center bhi kare */
}
    /* Mobile Vertical Table Styling */
    @media (max-width: 767px) {
        table#historyTable thead {
            display: none;
        }

        table#historyTable tbody tr {
            display: block;
            margin-bottom: 1rem;
            margin-left: 0.5rem;
            /* side margin */
            margin-right: 0.5rem;
            /* side margin */
            border: 2px solid var(--theme-green);
            border-radius: 0.75rem;
            padding: 0.75rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        table#historyTable tbody tr:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            border-color: #799402;
        }

        table#historyTable tbody td {
            display: flex;
            justify-content: space-between;
            padding: 0.6rem 0;
            border-bottom: 1px dotted #ccc;
        }

        table#historyTable tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            width: 40%;
            color: #555;

        }

        table#historyTable tbody td[data-label="Member Name"] {
            font-weight: 700;
            color: var(--theme-green);
            font-size: 1.05rem;
        }
    }

    /* Desktop Table Row Hover & Card Effect */
    table#historyTable tbody tr {
        transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
    }

    table#historyTable tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
        border: 2px solid var(--theme-green);
    }

    /* Highlight Member Name */
    table#historyTable tbody td[data-label="Member Name"] {
        font-weight: 600;
        color: var(--theme-green);
    }

    /* Mobile Vertical Table Styling */
    @media (max-width: 767px) {
        table#historyTable thead {
            display: none;
        }

        table#historyTable tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid var(--theme-green);
            border-radius: 0.5rem;
            padding: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-top: 15px;
        }

        table#historyTable tbody td {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px dotted #ccc;
        }

        table#historyTable tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            width: 40%;
        }
    }

    /* DataTables Buttons Styling */
    .dt-buttons .btn {
        border-radius: 0.3rem;
        font-weight: 600;
        padding: 0.3rem 2.8rem;
        color: #fff !important;
        margin-bottom: 50px;
    }

    .dt-buttons .btn-primary {
        background: linear-gradient(45deg, #cdff00 0%, #799402 100%);
        border-color: var(--theme-green);
        color: #000 !important;
    }

    .dt-buttons .btn-success {
        background-color: #198754;
        border-color: #198754;
    }

    .dt-buttons .btn-info {
        background-color: #0dcaf0;
        border-color: #0dcaf0;
    }

    .dt-buttons .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #000 !important;
    }

    .dt-buttons .btn-dark {
        background-color: #212529;
        border-color: #212529;
    }
</style>
@endsection