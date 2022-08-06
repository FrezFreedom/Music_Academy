<!DOCTYPE html>
<html>
<head>
    <style>
        .pagination {
            display: inline-block;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
        }
    </style>

    <meta charset="utf-8" />
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<table class="table table-striped" style="margin: 50px;">

    <thead>
    <tr>
        <th>
            <form action="/ability/create" method="get">
                <button class="btn btn-primary" type="submit" style="width: 100%;" >Create</button>
            </form>
        </th>
    </tr>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Ability</th>
        <th scope="col">jobs</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($abilities as $ability)
        <tr>
            <th scope="row">{{ $ability->id }}</th>
            <td>{{ $user_names[$ability->maestro_id] }}</td>
            <td>{{ $ability->ability }}</td>

            <td>
                <form action="/ability/{{$ability->id}}" method="get">
                    <button type="submit" class="btn btn-success">Show</button>
                </form>
                <form action="/ability/{{$ability->id}}/edit" method="get">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
                <form action="/ability/{{$ability->id}}" method="post">
                    <button class="btn btn-danger" type="submit" >Delete</button>
                    <input type="hidden" name="_method" value="delete" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </td>
            </td>
        </tr>
    @empty
        <p>No users</p>
    @endforelse
    </tbody>
</table>


{{-- Pagination --}}
<div class="d-flex justify-content-center">
    {!! $abilities->links() !!}
</div>

</body>
</html>
