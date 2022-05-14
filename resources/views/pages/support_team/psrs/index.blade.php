@extends('layouts.master')
@section('page_title', 'PSR Report')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">PSR Report</h6>
        {!! Qs::getPanelOptions() !!}
    </div>
    <div class="container">
        <div class="card bg-light mt-3">
            <div class="card-header">
                Import PSR Excel to database
            </div>
            <div class="card-body">
                <form action="{{ route('users-excel-upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    <button class="btn btn-success">Import PSR Data</button>
                    <a class="btn btn-warning" href="{{ route('users-excel-upload') }}">Export User Data</a>
                </form>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Customer No.</th>
                        <th>Customer Name</th>
                        <th>Dealer Location / City</th>
                        <th>Invoice No.</th>
                        <th>Billing Type</th>
                        <th>Invoice Date</th>
                        <th>Division</th>
                        <th>Description</th>
                        <th>Material Type</th>
                        <th>Quantity</th>
                      

                    </tr>

                </thead>

                <tbody>
                    <?php
                    $i = 1;
                    foreach ($psrreport as $u) {

                    ?>
                        <tr>

                            <td>
                                {{ $i++; }}
                            </td>
                            <td>
                                <center>{{ $u->customer_no }}</center>
                            </td>
                            <td>
                                <center>{{ $u->customer_name }}</center>
                            </td>
                            <td>
                                <center>{{ $u->dealer_location_city }}</center>
                            </td>
                            <td>
                                <center>{{ $u->invoice_no }}</center>
                            </td>
                            <td>
                                <center>{{ $u->billing_type }}</center>
                            </td>
                            <td>
                                <center>{{ $u->invoice_date }}</center>
                            </td>
                            <td>
                                <center>{{ $u->division }}</center>
                            </td>
                            <td>
                                <center>{{ $u->description }}</center>
                            </td>
                            <td>
                                <center>{{ $u->material_type }}</center>
                            </td>
                            <td>
                                <center>{{ $u->quantity }}</center>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $psrreport->links() !!}
            </div>
        </div>


    </div>
</div>



@foreach($user_types as $ut)
<div class="tab-pane fade" id="ut-{{Qs::hash($ut->id)}}">
    <table class="table datatable-button-html5-columns">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Customer No.</th>
                <th>Customer Name</th>
                <th>Dealer Location / City</th>
                <th>Invoice No.</th>
                <th>Billing Type</th>Division
                <th>Invoice Date</th>
                <th>Division</th>
                <th>Description</th>
                <th>Material Type</th>
                <th>Quantity</th>
                <!-- <th>action</th> -->

            </tr>
        </thead>
        <tbody>

            @foreach($users->where('user_type', $ut->title) as $u)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $u->photo }}" alt="photo"></td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->username }}</td>
                <td>{{ $u->phone }}</td>
                <td>{{ $u->email }}</td>
                <td class="text-center">
                    <div class="list-icons">
                        <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-left">
                                {{--View Profile--}}
                                <a href="{{ route('users.show', Qs::hash($u->id)) }}" class="dropdown-item"><i class="icon-eye"></i> View Profile</a>
                                {{--Edit--}}
                                <a href="{{ route('users.edit', Qs::hash($u->id)) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                @if(Qs::userIsSuperAdmin())

                                <a href="{{ route('users.reset_pass', Qs::hash($u->id)) }}" class="dropdown-item"><i class="icon-lock"></i> Reset password</a>
                                {{--Delete--}}
                                <a id="{{ Qs::hash($u->id) }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                <form method="post" id="item-delete-{{ Qs::hash($u->id) }}" action="{{ route('users.destroy', Qs::hash($u->id)) }}" class="hidden">@csrf @method('delete')</form>
                                @endif

                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endforeach

</div>
</div>
</div>

{{--Student List Ends--}}

@endsection