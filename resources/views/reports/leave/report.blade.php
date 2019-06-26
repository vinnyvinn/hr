<h3>Leaves Reports</h3>
<table id="customers">
<tr>
    <td><b>Date</b></td>
    <td><b>Employee ID</b></td>
    <td><b>First Name</b></td>
    <td><b>Last Name</b></td>
    <td><b>Leave type</b></td>
    <td><b>Reason</b></td>
</tr>
@foreach($leaves as $leave)
    <tr>
        <td>{{ Carbon\Carbon::parse($leave->date)->format('d F Y') }}</td>
        <td>{{$leave->user->employee_id }}</td>
        <td>{{ $leave->user->first_name }}</td>
        <td>{{ $leave->user->last_name }}</td>
        <td>{{ $leave->leave_type->leave_type}}</td>
        <td>{{ $leave->reason }}</td>
    </tr>
@endforeach
</table>

<style>
    h3{
        text-align: center;
    }
    #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
        padding-top: 12px;

        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>
