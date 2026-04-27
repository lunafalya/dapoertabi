<tr>
    <td class="fw-bold">#ORD-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}</td>
    <td>
        <div class="fw-bold">{{ $booking->user->name }}</div>
        <small class="text-muted" style="font-size: 0.8rem;">{{ $booking->user->email ?? '-' }}</small>
    </td>
    <td>
        @foreach ($booking->items as $item)
            {{ $item->product->name }} ({{ $item->qty }})<br>
            <small class="text-muted" style="font-size: 0.8rem;">{{ $item->product->category }}</small>
        @endforeach
    </td>
    <td>
        <div>{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</div>
        <small class="text-muted" style="font-size: 0.8rem;">{{ $booking->booking_time ?? '-' }}</small>
    </td>
    <td>
        @if ($booking->status == 'pending')
            <span class="status-badge badge-pending">Pending</span>
        @elseif ($booking->status == 'done')
            <span class="status-badge badge-completed">Completed</span>
        @else
            <span class="status-badge bg-secondary text-white">{{ ucfirst($booking->status) }}</span>
        @endif
    </td>
    <td class="text-end">
    <button class="btn-detail" data-bs-toggle="modal" data-bs-target="#orderModal{{ $booking->id }}">
        View Detail
    </button>
</td>
</tr>