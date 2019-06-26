<h3>Bank Accounts Reports</h3>
<table id="customers">
<tr>
    <td><b>Employee ID</b></td>
    <td><b>Employee Name</b></td>
    <td><b>Account name</b></td>
    <td><b>Account number</b></td>
    <td><b>Bank name</b></td>
</tr>
@foreach($bankAccounts as $bankAccount)
    <tr>
        <td style="border: 1px solid #000000">{{ $bankAccount->user ? $bankAccount->user->employee_id :''}}</td>
        <td style="border: 1px solid #000000">{{ $bankAccount->user ? $bankAccount->user->first_name :''}} {{ $bankAccount->user ? $bankAccount->user->last_name :''}}</td>
        <td style="border: 1px solid #000000">{{ $bankAccount->account_name }}</td>
        <td style="border: 1px solid #000000">{{ $bankAccount->account_number }}</td>
        <td style="border: 1px solid #000000; float:right">{{ $bankAccount->bank_name }}</td>
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
