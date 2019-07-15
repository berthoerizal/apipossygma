<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi</title>
</head>

<body>
    <h1>Transaksi</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Meja</th>
                <th>Nama Pelanggan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 0;
            @endphp
            @foreach($gettransaksi as $data)
            <tr>
                <td>{{$no = $no + 1}}</td>
                <td>{{$data->meja_id}}</td>
                <td>{{$data->nama_pelanggan}}</td>
                <td>{{$data->status}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>