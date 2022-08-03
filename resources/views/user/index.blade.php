<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<table class="table table-striped" style="margin: 50px;">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Type</th>
        <th scope="col">jobs</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->type }}</td>

            <td>
                <button type="button" class="btn btn-success">Add</button>
                <button type="button" class="btn btn-primary">Edit</button>
                <button type="button" class="btn btn-danger">Delete</button>
            </td>
        </tr>
    @empty
        <p>No users</p>
    @endforelse
    </tbody>
</table>

</body>
</html>
