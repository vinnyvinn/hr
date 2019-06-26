<h3>Events Reports</h3>
<table id="customers">>
<tr>

    <td><b>Event name</b></td>
    <td><b>Event description</b></td>
    <td><b>Start Date</b></td>
    <td><b>End Date</b></td>
</tr>
@foreach($events as $event)
    <tr>

        <td>{{ $event->event_name }}</td>
        <td>{{ $event->description }}</td>
        <td>{{$event->date_start}}</td>
        <td>{{$event->date_end}}</td>
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
