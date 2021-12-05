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

    <div class="container-fluid py-2">
        <div class="container-fluid py-2">
            <div class="row">
                <div class="col-12">
                    <button id="create-new-btn" type="button" class="btn btn-danger btn-sm mb-0">Create New Payment
                        Method
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-danger shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Payment Methods table</h6>
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
                                        image
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        created at
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Currencies
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
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create New Currency</h5>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="payment_method_name" class="form-label">Payment Method Name</label>
                    <input type="text" class="form-control" id="payment_method_name"
                           placeholder="Type Payment Method Here">
                </div>
                <div class="mb-3">
                    <label for="payment_method_image" class="form-label">Payment Method Image</label>
                    <input class="form-control" type="file" id="payment_method_image">
                </div>
                <div id="currencies_section">

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
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }


    $(document).ready(function () {
            var datatable = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "columns": [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'image'},
                    {data: 'created_at'},
                    {data: 'currencies_names'}
                ],
                "ajax": {
                    "url": "{{route('admin.dashboard.payment_methods.search')}}",
                    "dataType": "json",
                    "data": {
                        "_token": "{{csrf_token()}}",
                    }
                }
            });

            $(document).on('change', '.currency-checkbox', function (e) {
                if (this.checked) {
                    $("#" + $(this).attr('id') + '-section').css('display', 'block');
                } else {
                    $("#" + $(this).attr('id') + '-section').css('display', 'none');
                }
            });
            $(document).on('click', '#create-new-btn', function (e) {
                $(this).html('<i class="fa fa-spinner" aria-hidden="true"></i>');
                $.ajax({
                    type: 'POST',
                    url: '{{route('admin.dashboard.payment_methods.currencies')}}',
                    data: {
                        "_token": "{{csrf_token()}}",
                    },
                    success: (response) => {
                        if (response) {
                            response.forEach(function (item, index) {
                                $('#currencies_section').append(`<div class="form-check">
  <input class="form-check-input currency-checkbox" type="checkbox" value="" data-id="${item.id}" id="currency-${item.id}">
  <label class="form-check-label" for="currency-${item.id}">
    ${item.name}
  </label>
</div>
<div id="currency-${item.id}-section" style="display: none;">
<div class="mb-3">
                    <label for="currency-${item.id}-min_deposit" class="form-label">${item.name} Min Deposit</label>
                    <input type="number" step="0.01" class="form-control" id="currency-${item.id}-min_deposit">
                </div>
<div class="mb-3">
                    <label for="currency-${item.id}-max_deposit" class="form-label">${item.name} Max Deposit</label>
                    <input type="number" step="0.01" class="form-control" id="currency-${item.id}-max_deposit">
                </div>
<div class="mb-3">
                    <label for="currency-${item.id}-min_withdrawal" class="form-label">${item.name} Min Withdrawal</label>
                    <input type="number" step="0.01" class="form-control" id="currency-${item.id}-min_withdrawal">
                </div>
<div class="mb-3">
                    <label for="currency-${item.id}-max_withdrawal" class="form-label">${item.name} Max Withdrawal</label>
                    <input type="number" step="0.01" class="form-control" id="currency-${item.id}-max_withdrawal">
                </div>
</div>
`);
                            })

                            $(this).html('Create New Payment Method');
                            $('#createModal').modal('show');
                        }
                    }
                });
            });
            $(document).on('click', '#create-btn', async function (e) {
                e.preventDefault();
                var currencies = [];

                var image;
                var filereader = new FileReader();
                await filereader.readAsDataURL($("#payment_method_image")[0].files[0]);
                while (!image) {
                    await sleep(100);
                    image = filereader.result;
                }
                $('.currency-checkbox').each(function () {
                    if (this.checked) {
                        currencies.push({
                            'id': $(this).attr('data-id'),
                            "min_deposit": $("#" + $(this).attr('id') + '-min_deposit').val(),
                            "max_deposit": $("#" + $(this).attr('id') + '-max_deposit').val(),
                            "min_withdrawal": $("#" + $(this).attr('id') + '-min_withdrawal').val(),
                            "max_withdrawal": $("#" + $(this).attr('id') + '-max_withdrawal').val()
                        });
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{route('admin.dashboard.payment_methods.create')}}',
                    beforeSend: function () {

                    },
                    data: {
                        "name": $("#payment_method_name").val(),
                        "image": image,
                        "currencies": currencies,
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
