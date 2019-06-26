@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
             Terminated Contracts
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('alert.success')
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Terminated Contracts List</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>Staff</th>
                                    <th>Date</th>
                                    <th>Reason </th>
                                </tr>
                                @foreach($contracts as $contract)
                                    <tr>
                                        <td>{{ $contract->id }}</td>
                                        <td>
                                            <table class="table table-responsive no-border">
                                                <tr>
                                                    @foreach($contract->users as $empl)
                                                        <td class="list-group-item">{{$empl->first_name .' '.$empl->last_name}}</td>
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </td>
                                        <td>{{$contract->termination_date}}</td>
                                        <td>{{ $contract->reasons->reason }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
