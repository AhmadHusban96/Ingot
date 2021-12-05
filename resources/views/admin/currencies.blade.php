<x-dashboard-license></x-dashboard-license>
<!DOCTYPE html>
<html lang="en">

<head>
    <x-dashboard-head></x-dashboard-head>
</head>

<body class="g-sidenav-show  bg-gray-200">
<x-dashboard-sidebar></x-dashboard-sidebar>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <x-dashboard-navbar></x-dashboard-navbar>
    <!-- End Navbar -->
    <div class="container-fluid py-2">
        <div class="container-fluid py-2">
            <div class="row">
                <div class="col-12">
                    <button type="button" class="btn btn-danger btn-sm mb-0" data-bs-toggle="modal"
                            data-bs-target="#createModal">Create New Currency
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-danger shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Users table</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="table" class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        id
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        created_at
                                    </th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">

        <x-dashboard-footer></x-dashboard-footer>
    </div>
</main>
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create New Currency</h5>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="currency_name" class="form-label">Currency Name</label>
                    <input type="text" class="form-control" id="currency_name" placeholder="Type Currency Name Here">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="create-btn" type="button" class="btn btn-danger">Create</button>
            </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
<x-dashboard-js></x-dashboard-js>
<script>
    $(document).ready(function () {
            var datatable = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "columns": [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'created_at'}
                ],
                "ajax": {
                    "url": "{{route('admin.dashboard.currencies.search')}}",
                    "dataType": "json",
                    "data": {
                        "_token": "{{csrf_token()}}",
                    }
                }
            });
            $(document).on('click', '#create-btn', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '{{route('admin.dashboard.currencies.create')}}',
                    data: {
                        "name": $("#currency_name").val(),
                        "_token": "{{csrf_token()}}",
                    },
                    success: (response) => {
                        if (response) {
                            $('#table').DataTable().ajax.reload();
                            $('#createModal').modal('hide');
                        }
                    }
                });
            });
        }
    )
    ;

</script>
</body>

</html>
