<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laravel 7 Crud Ajax and File Upload</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('bootstrap_4.1.3/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
    <style>
        .dropdown-menu {
            min-width: inherit !important;
            padding: 0px;
        }
        .dropdown-menu .dropdown-item{
            color: white;
        }
        #showImage img.my-image-show{
            height: 150px !important;
        }

    </style>
</head>

<body>

    <div class="container pt-3">
        <h1 class="text-center ">Laravel CRUD Ajax and File Upload</h1>
        <button class="btn btn-info btn-sm" id="Addbtn">Add New Category</button>
        <br><br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Create At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="catList">

            </tbody>
        </table>
    </div>


    @include('category.inc.create')
    @include('category.inc.edit')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('bootstrap_4.1.3/js/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // show modal form category
            $("#Addbtn").on('click',function(e){
                e.preventDefault();
                $("#AddCategoryModal").modal('show');
            });

            // save data to Database
            $("#frmData").on('submit',function(e){
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('ajax.store') }}",
                    data: data,
                    dataType: "JSON",
                    contentType:false,
                    cache:false,
                    processData:false,
                    success: function (data) {
                        console.log(data);
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Your data has been saved successfully',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#frmData")[0].reset();
                        $("#btnClose").click();
                        readData();

                    }
                });
            });

            // read data from Database
            function readData(){
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.list') }}",
                    success: function (data) {
                        $("#catList").html(data);
                    }
                });
            }
            readData(); //call is function to show data from Database

            // Delete data from Database
            function deleteData(){
                var id = $(".delete").data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('ajax.delete') }}",
                    data: {category_id:id},
                    success: function (data) {
                        console.log(data);
                        readData();
                    }
                });
            }
            $(document).on('click','.delete',function(e){
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.value) {
                        deleteData(); //call function deleteData() whent click yes.
                        Swal.fire(
                        'Deleted!',
                        'Your data has been delete successfully.',
                        'success'
                        )
                    }
                });
            });

            // Edit data
            function editImage() {
                var img = document.createElement("IMG");
                var imgv = $("#old_image").val();
                var path_image = "upload/categories/";
                img.src = path_image + imgv;
                $('#showImage').html(img);
            }
            $(document).on('click','.edit',function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.Edit') }}",
                    data:{cat_id: id},
                    success: function (data) {
                        $("#frmEdit").find("#ename").val(data.name);
                        $("#frmEdit").find("#old_image").val(data.image);
                        $("#frmEdit").find("#preview").hide();
                        editImage();
                        $("#frmEdit").find('#showImage img').addClass("my-image-show");
                        $("#frmEdit").find('#showImage').show();
                        $("#frmEdit").find("#cat_id").val(data.id);
                        $("#EditCategoryModal").modal('show');
                    }
                });
            });
            // Update data
            $("#frmEdit").on('submit',function(e) {
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('ajax.Update') }}",
                    data: data,
                    dataType: "JSON",
                    contentType:false,
                    cache:false,
                    processData:false,
                    success: function (data) {
                        console.log(data);
                        $("#frmEdit").trigger('reset');
                        // $("#frmEdit")[0].reset();
                        $("#btnEditClose").click();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Your data has been updates successfully',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        readData();
                    }
                });
            });
        });

        function updateImage() {
            $("#frmEdit").find('#showImage img.my-image-show').hide();
            $("#frmEdit").find("#eimage").click();
            $("#frmEdit").find("#preview").show();
        }
        function getImage() {
            $("#frmData").find("#image").click();
        }
        $('#image').change(function () {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
                readURL(this);
            else
                alert("Please select image file (jpg, jpeg, png).")
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                };
            // $("#remove").val(0);
            }
        }
        function removeImage() {
                //$('#preview').attr('src', '');
            $('#preview').attr('src',"{{ asset('images/noimage.jpg') }}");
            $("#remove").val(1);
        }
    </script>
</body>

</html>
