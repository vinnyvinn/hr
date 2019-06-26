<html>
<tr>
    <td style="border: 1px solid #000000"><b>Date</b></td>
    <td style="border: 1px solid #000000"><b>Employee ID</b></td>
    <td style="border: 1px solid #000000"><b>First Name</b></td>
    <td style="border: 1px solid #000000"><b>Last Name</b></td>
    <td style="border: 1px solid #000000""><b>Time in</b></td>
    <td style="border: 1px solid #000000""><b>Time out</b></td>
</tr>
@foreach($attendances as $attendance)
    <tr>
        <td style="border: 1px solid #000000">{{ Carbon\Carbon::parse($attendance->date)->format('d F Y') }}</td>
        <td style="border: 1px solid #000000">{{ $attendance->user->employee_id }}</td>
        <td style="border: 1px solid #000000">{{ $attendance->user->first_name }}</td>
        <td style="border: 1px solid #000000">{{ $attendance->user->last_name }}</td>
        <td style="border: 1px solid #000000">{{ $attendance->time_in}}</td>
        <td style="border: 1px solid #000000">{{ $attendance->time_out}}</td>
    </tr>
@endforeach
</html>