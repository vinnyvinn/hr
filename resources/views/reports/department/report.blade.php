<h3>Departments Reports</h3>
<table id="customers">
<tr>
    <td style="border: 1px solid #000000"><b>Department Name</b></td>
    <td style="border: 1px solid #000000"><b>Employee Name</b></td>
</tr>
@foreach($departments as $department)
    <tr>
        <td style="border: 1px solid #000000">{{ $department->department}}</td>
        <td style="border: 1px solid #000000">{{ $department->first_name }} {{ $department->last_name }}</td>
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
