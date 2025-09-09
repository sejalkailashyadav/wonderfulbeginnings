<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Center</th>
                <th>Class</th>
                <th>Fees</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($children as $child)
                <tr>
                    <td>{{ $child->child_first_name }} {{ $child->child_last_name }}</td>
                    <td>{{ $child->center->center_name ?? 'N/A' }}</td>
                    <td>{{ $child->class->class_name ?? 'N/A' }}</td>
                    <td>{{ $child->fee->fees_name ?? 'N/A' }}</td>
                    <td>{{ $child->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
