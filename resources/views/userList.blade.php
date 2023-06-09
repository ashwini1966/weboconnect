@extends('common.template')
@section('title', 'Users')
@section('content')


<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-Userss-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-Userss-center text-dark fw-bolder fs-3 my-1">Users</h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-Userss-center gap-2 gap-lg-3">
                <!--begin::Primary button-->
                <!--end::Primary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Calendar Widget 1-->
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table-->
                    <input type="search" name="email" class="form-control searchEmail search" placeholder="Search...">
                    <br>
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th class="w-12px pe-3">Sno.</th>
                                <th class="min-w-125px">Profile Image</th>
                                <th class="min-w-125px">Name</th>
                                <th class="min-w-125px">Email</th>
                                <th class="min-w-125px">QR</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
            <!--end::Calendar Widget 1-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

<script type="text/javascript">
$(document).ready(function() {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: true,
        searching: true,
        pageLength: 5,
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        scrollX: true,
        "order": [
            [0, "desc"]
        ],
        ajax: {
            url: "{{ route('getUserList') }}",
            data: function(d) {
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [{
                "data": null,
                "sortable": false,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'profile_picture',
                name: 'profile_picture'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'qr_code',
                name: 'qr_code'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });

    $(".searchEmail").keyup(function() {
        table.draw();
    });
});
</script>
@endsection