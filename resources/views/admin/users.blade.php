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

    <div class="container-fluid py-4">
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
                                        username
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        email
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        created_at
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        is blocked
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

    <!-- End Navbar -->
    <div class="container-fluid py-4">

        <x-dashboard-footer></x-dashboard-footer>
    </div>
</main>
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
                    {data: 'username'},
                    {data: 'email'},
                    {data: 'created_at'},
                    {data: 'is_blocked'}
                ],
                "ajax": {
                    "url": "{{route('admin.dashboard.users.search')}}",
                    "dataType": "json",
                    "data": {
                        "_token": "{{csrf_token()}}",
                    }
                }
            });
            $(document).on('change', '.user-block-checkbox', function (e) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('admin.dashboard.users.block')}}',
                    data: {
                        "id": $(this).attr('data-id'),
                        "status": this.checked,
                        "_token": "{{csrf_token()}}",
                    }
                });
            });
        }
    )
    ;

</script>
</body>

</html>
