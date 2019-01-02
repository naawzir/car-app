@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="{{--row --}}justify-content-center">
            <div class="col-md-24">
                @include ('layouts.errors')
                @include ('layouts.message')
                <div class="card">
                    <div class="card-header"></div>

                    {{--<select id="makesFilter" class="col-md-1">
                        <option selected value=""></option>
                        @foreach($makeValues as $makeValue)
                            <option value="{{ $makeValue->make }}">{{ $makeValue->make }}</option>
                        @endforeach
                    </select>--}}

                    <div id="content-area" class="panel col-sm-23">
                        <div class="panel-body">
                            <table class="table table-bordered" id="carsTable">
                                <thead>
                                <tr>
                                    <th id="">Make</th>
                                    <th id="">Model</th>
                                    <th id="">Registration</th>
                                    <th id="">Owner</th>
                                    <th id="">Date Created</th>
                                    <th id="">Date Updated</th>
                                    <th id="viewmore">Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($cars as $car)
                                        <tr>
                                            <td>{{ $car['car']->make }}</td>
                                            <td>{{ $car['car']->model }}</td>
                                            <td>{{ $car['car']->registration_number }}</td>
                                            <td>{{ $car['owner']->title . ' ' .  $car['owner']->first_name . ' ' . $car['owner']->last_name }}</td>
                                            <td>{{ $car['car']->created_at }}</td>
                                            <td>{{ $car['car']->updated_at }}</td>
                                            <td>
                                                <a href="/cars/{{ $car['car']->slug }}"><i class="far fa-edit"></i></a>
                                                <a class="delete" href="/cars/{{ $car['car']->slug }}/delete"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        {{--<tr>
                                            <td>{{ $car->make }}</td>
                                            <td>{{ $car->model }}</td>
                                            <td>{{ $car->registration_number }}</td>
                                            <td>{{ $car->title . ' ' .  $car->first_name . ' ' . $car->last_name }}</td>
                                            <td>{{ $car->created_at }}</td>
                                            <td>{{ $car->updated_at }}</td>
                                            <td>
                                                <a href="/cars/{{ $car->slug }}"><i class="far fa-edit"></i></a>
                                                <a class="delete" href="/cars/{{ $car->slug }}/delete"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>--}}
                                    @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
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
        /*const datatables_info =
            [{
                url: '/cars/get-records',
                dataTableID: '#carsTable',
                ordering: [[0, "asc"]],
                stateSave: true,
                cols:
                    [
                        {
                            data: 'make',
                            name: 'make'
                        },
                        {
                            data: 'model',
                            name: 'model'
                        },
                        {
                            data: 'registration_number',
                            name: 'registration_number'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
/!*                            ,render: function (data, type, full, meta) {
                                return '<span class="' + typeArray['Branch'] + '">From:</span> ' + full.LegalFee;
                            }*!/
                        },
                        {
                            render: function (data, type, full, meta) {
                                const url = '/cars/' + full.slug;
                                return '<a href="' + url + '"><button class="col-sm-24 success-button">View More</button></a>';
                            }
                        }
                    ]
            }];*/

       /* var dataTables_filter =
            [
                {
                    input_id: '#makesFilter',
                    col_ref: 0,
                    type: 'default',
                    make_options: false,
                    dataTableID: '#carsTable',
                    stateSave: true
                }
            ];

        //makeDatatable(datatables_info);
        initalizeSelectBoxItems(dataTables_filter);*/

        const table = $('#carsTable').DataTable({
            /*"sPaginationType": "full_numbers",
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.header()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }*/
        });
        table.draw();

        $(".delete").click(function(ev) {
            ev.preventDefault();
            const url = $(this).prop("href");
            var r = confirm("Are you sure you want to delete this item?");
            if (r === true) {
                location.href = url;
            } else {
                txt = "You pressed Cancel!";
            }

        });
    });
</script>
@endpush
