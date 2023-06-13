<!DOCTYPE html>
<html>
<head>
    <title>Audio Player</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Files</th>
                <th>Player</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $file)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>

                    <audio controls>
                        <source src="{{ url('/audio/', $file->filename) }}" type="audio/mpeg">
                        <source src="{{ url('/storage/files', $file->filename) }}" type="audio/mpeg">
                    </audio>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>