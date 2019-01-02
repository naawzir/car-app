@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="{{--row --}}justify-content-center">
            <div class="col-md-24">
                @include ('layouts.errors')
                @include ('layouts.message')
                <div class="card">
                    <div class="card-header"></div>

                    <select id="lastNamesFilter" class="col-md-1">
                        <option selected value=""></option>
                        @foreach($lastNameValues as $lastNameValue)
                            <option value="{{ $lastNameValue->last_name }}">{{ $lastNameValue->last_name }}</option>
                        @endforeach
                    </select>

                    <div id="content-area" class="panel col-sm-23">
                        <div class="panel-body">
                            <table class="table table-bordered" id="ownersTable">
                                <thead>
                                <tr>
                                    <th id="">Title</th>
                                    <th id="">First Name</th>
                                    <th id="">Last Name</th>
                                    <th id="">Date Created</th>
                                    <th id="viewmore">Edit</th>
                                </tr>
                                </thead>
                                {{--<tbody>
                                    @foreach($cars as $car)
                                        <tr>
                                            <td>{{ $car->make }}</td>
                                            <td>{{ $car->model }}</td>
                                            <td>{{ $car->registration_number }}</td>
                                            <td>{{ $car->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>--}}
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        const datatables_info =
            [{
                url: '/owners/get-records',
                dataTableID: '#ownersTable',
                ordering: [[0, "asc"]],
                stateSave: true,
                cols:
                    [
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'first_name',
                            name: 'first_name'
                        },
                        {
                            data: 'last_name',
                            name: 'last_name'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
/*                            ,render: function (data, type, full, meta) {
                                return '<span class="' + typeArray['Branch'] + '">From:</span> ' + full.LegalFee;
                            }*/
                        },
                        {
                            render: function (data, type, full, meta) {
                                const url = '/owners/' + full.slug;
                                return '<a href="' + url + '"><button class="col-sm-24 success-button">View More</button></a>';
                            }
                        }
                    ]
            }];

        var dataTables_filter =
            [
                {
                    input_id: '#lastNamesFilter',
                    col_ref: 2,
                    type: 'default',
                    make_options: false,
                    dataTableID: '#ownersTable',
                    stateSave: true
                }
            ];

        makeDatatable(datatables_info);
        initalizeSelectBoxItems(dataTables_filter);

        const table = $('#ownersTable').DataTable();
        table.draw();
    });
</script>
@endpush
