<h3>Absence Reports</h3>
<table id="customers">
<tr>
    <td><b>Date</b></td>
    <td><b>Employee ID</b></td>
    <td><b>First Name</b></td>
    <td><b>Last Name</b></td>
    <td><b>Reason</b></td>
</tr>
@foreach($absencess as $absence)
<tr>
    <td>{{ Carbon\Carbon::parse($absence->date)->format('d F Y') }}</td>
    <td>{{ $absence->user ? $absence->user->employee_id :''}}</td>
    <td>{{ $absence->user ? $absence->user->first_name:'' }}</td>
    <td>{{ $absence->user ? $absence->user->last_name :''}}</td>
    <td>{{ $absence->reason }}</td>
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
