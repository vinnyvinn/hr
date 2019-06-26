<h3>Recruitment Reports</h3>
<table id="customers">
<tr>
    <td style="border: 1px solid #000000" colspan="4"><b>{{ strtoupper($vacancy->job_title) }}</b></td>
</tr>
<tr>
    <td><b>Candidate name</b></td>
    <td><b>E-Mail</b></td>
    <td><b>Contact Number</b></td>
    <td><b>Application Date</b></td>
</tr>
@foreach($vacancy->candidates as $candidate)
    <tr>
        <td>{{ $candidate->first_name}} {{ $candidate->last_name }}</td>
        <td>{{ $candidate->email}}</td>
        <td>{{ $candidate->contact_no }}</td>
        <td>{{ \Carbon\Carbon::parse($candidate->application_date)->format('d F Y') }}</td>
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
