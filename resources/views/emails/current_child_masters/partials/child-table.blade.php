@foreach ($childs as $child)
    <tr>
        <td>{{ $child->child_id }}</td>
        <td>{{ $child->child_first_name }} {{ $child->child_last_name }}</td>
        <td>{{ $child->parent_first_name }} {{ $child->parent_last_name }}</td>
        <!--<td>{{ $child->parent_email }}</td>-->
        <td>{{ $child->parent_mobile }}</td>
        <!--<td>{{ $child->center->center_name ?? '-' }}</td>-->
        <td>{{ $child->class->class_name ?? '-' }}</td>
        <td>{{ $child->fee->fees_name ?? '-' }}</td>
        <td>
    @php
        $days = collect(json_decode($child->no_of_days, true))
            ->filter(fn($v) => $v == 1)
            ->keys();
    @endphp

    @foreach ($days as $day)
        <span class="badge text-light bg-info">{{ $day }}</span>
    @endforeach
</td>
        <td>
    <span class="badge 
        @if($child->status == 1) bg-success
        @elseif($child->status == 2) bg-danger
        @elseif($child->status == 3) bg-secondary
        @else bg-primary
        @endif
    ">
        {{ $child->status_label }}
    </span>
</td>



        <td><a href="{{ route('current-child-masters.show', $child->child_id) }}" class="btn btn-sm btn-secondary">View</a></td>
    </tr>
@endforeach
