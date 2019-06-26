<h3>Expenses Reports</h3>
<table id="customers">
<tr>
    <td style="border: 1px solid #000000"><b>Date</b></td>
    <td style="border: 1px solid #000000"><b>user id</b></td>
    <td style="border: 1px solid #000000"><b>item name</b></td>
    <td style="border: 1px solid #000000"><b>amount</b></td>
</tr>
@foreach($expenses as $expense)
    <tr>
        <td>{{ Carbon\Carbon::parse($expense->date)->format('d F Y') }}</td>
        <td>{{ $expense->user->id}}</td>
        <td>{{ $expense->item_name }}</td>
        <td>{{ $expense->amount }}</td>
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
