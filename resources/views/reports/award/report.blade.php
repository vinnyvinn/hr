<h3>Awards Reports</h3>
<table id="customers">
<tr>
    <td><b>Employee ID</b></td>
    <td><b>Employee Name</b></td>
    <td><b>Name</b></td>
    <td><b>Gift item</b></td>
    <td><b>Cash price</b></td>
</tr>
@foreach($awards as $award)

    <tr>
        <td>{{ $award->user? $award->user->employee_id :''}}</td>
        <td>{{ $award->user ? $award->user->first_name :''}} {{ $award->user ? $award->user->last_name :''}}</td>
        <td>{{ $award->award_name }}</td>
        <td>{{ $award->gift_item }}</td>
        <td>{{ number_format($award->cash_price, 2) }}</td>
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
