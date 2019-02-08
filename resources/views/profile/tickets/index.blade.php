<a href="{{ route('tickets.create') }}"> تیکت جدید </a>
<ol>
    @forelse($tickets as $index => $ticket)
        <div>
            <li> گیرنده : {{ $ticket->title }}</li>
            <li>
                <a href="{{ route('tickets.show', $ticket) }}">
                    نمایش
                </a>
            </li>
            <li>
                <a href="{{ route('tickets.toggle', $ticket) }}"
                   onclick="event.preventDefault();document.getElementById('toggle_{{ $index }}').submit();">
                    @if($ticket->is_open)
                        بستن
                    @else
                        باز
                    @endif
                </a>
                <form id="toggle_{{ $index }}" action="{{ route('tickets.toggle', $ticket) }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                </form>
            </li>
        </div>
    @empty
        You have no address submitted yet!
    @endforelse
</ol>