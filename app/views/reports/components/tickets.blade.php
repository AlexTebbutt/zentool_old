<div class="month-heading">

	<h2 class="left">{{ $headings->count }} Ticket(s) closed in {{ $headings->monthTitle }}</h2><h2 class="right">Time Spent: {{ $headings->totalTime }}</h2>
	
</div>

@if($headings->count > 0)

	<table><thead><th align="center">Ticket #</th><th align="left">Closed On</th><th align="left">Task</th><th align="center">Time Taken (m)</th><th align="left">Status</th></thead>
	
	@foreach($tickets as $ticket)
		<tr>
		
			<td width="150" align="center" valign="top">
				
				<a href="{{ $ticket->url }}" target="_blank">{{ $ticket->id }}</a>
			
			</td>
			
			<td width="150" align="left" valign="top">{{ $ticket->updatedAt }}</td>
			
			<td width="400" align="left">{{ $ticket->subject }}</td>
			
			<td width="150" align="center" valign="top">{{ $ticket->time }}</td>
			
			<td width="150" align="left" valign="top">{{ $ticket->status }}</td >
		
		</tr>
	
	@endforeach
	
	</table>

@endif