@extends('common.template')
@section('title', 'Users')
@section('content')


   <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Item</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted"><a href="{{ url('userList') }}" class="text-muted text-hover-primary">Users</a></li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Edit Profile</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
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
                    <form id="edit_profile_form" class="form" method="post" action="javascript:void(0)"  enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $id }}">
                        
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                            <div class="col-md-3 text-md-end">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">FirstName</span>
                                </label>
                                <!--end::Label-->
                            </div>
                            <div class="col-md-9">
                                <!--begin::Input-->
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{$first_name}}" required autocomplete="name" autofocus>
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--end::Input group-->

                        
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                            <div class="col-md-3 text-md-end">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">LastName</span>
                                </label>
                                <!--end::Label-->
                            </div>
                            <div class="col-md-9">
                                <!--begin::Input-->
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{$last_name}}" required autocomplete="name" autofocus>
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--end::Input group-->
                        
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                            <div class="col-md-3 text-md-end">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Email</span>
                                </label>
                                <!--end::Label-->
                            </div>
                            <div class="col-md-9">
                                <!--begin::Input-->
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$email}}"  readonly>
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row fv-row mb-7">
                            <div class="col-md-3 text-md-end">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <span class="required">Image</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Set the name of the Item."></i>
                                </label>
                                <!--end::Label-->
                            </div>
                            <div class="col-md-9">
                                <!--begin::Input-->
                                <input type="hidden" name="old_img" id="old_img" value="{{ $profile_picture }}">
                                <div><img src="{{ asset('images/'.$profile_picture) }}" alt="img" width="50"/></div>
                                <input type="file" class="form-control form-control-solid" id="image" name="image" value="{{ asset('images/'.$profile_picture) }}"/>
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--end::Input group-->
                        
                        <!--begin::Action buttons-->
                        <div class="row">
                            <div class="col-md-9 offset-md-3">
                                <!--begin::Separator-->
                                <div class="separator mb-6"></div>
                                <!--end::Separator-->
                                <div class="d-flex justify-content-end">
                                    <!--begin::Button-->
                                    <button type="reset" data-kt-ecommerce-settings-type="cancel" class="btn btn-light me-3">Cancel</button>
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="submit" data-kt-ecommerce-settings-type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Save</span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                            </div>
                        </div>
                        <!--end::Action buttons-->
                    </form>

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

        $('#edit_profile_form').on('submit', function(e) {
            e.preventDefault(); 
            
            var formData = new FormData();

            var id = $('#id').val();
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var old_img = $("input[name=old_img]").val();
            var profile_picture = $('#image').prop('files')[0];  
            
            formData.append('profile_picture', profile_picture);
            formData.append('first_name', first_name);
            formData.append('last_name', last_name);
            formData.append('old_img', old_img);
            formData.append('id', id);

            $.ajax({
                url: "{{ url('updateProfile') }}",
                method:'post',
                contentType: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                data: formData,
                success: function(data) {
                    // console.log(data);
                    Swal.fire({
                        text: "Profile updated Succesfully",
                        icon: "success",
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "btn btn-success"
                        }
                    });
                    $('#edit_profile_form')[0].reset();
                },
                error: function(data) {
                    console.log(data);
                    Swal.fire({
                        text: "Ooops something went wrong, please try again !",
                        icon: "error",
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "btn btn-danger"
                        }
                    });
                },
            });
        });
        
       
    });
   
</script>
@endsection
 
        