<h3>Users Reports</h3>
<table id="customers">
<tr>
    <td><b>Employee ID</b></td>
    <td><b>Employee Name</b></td>
    <td><b>email</b></td>
    <td><b>cellphone</b></td>
</tr>
@foreach($employees as $user)
    <tr>
        <td>{{ $user->employee_id }}</td>
        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->cellphone }}</td>
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
