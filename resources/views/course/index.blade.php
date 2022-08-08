<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
{{--    <link rel="stylesheet" href="bulma.css">--}}
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
            <form action="/course/create" method="get">
                <button class="btn btn-primary" type="submit" style="width: 100%;" >Create</button>
            </form>
        </th>
    </tr>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Maestro</th>
        <th scope="col">Students</th>
        <th scope="col">Status</th>
        <th scope="col">jobs</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($courses as $course)
        <tr>
            <th scope="row">{{ $course->id }}</th>
            <td>{{ $course->name }}</td>
            <td>{{ $course->description }}</td>
            <td>{{ $course->maestro->name }}</td>
            <td>
                @forelse($course->students as $student)

                    <span class="block" style="margin: 5px;height: auto;width: auto;">
                      <span class="tag is-success">
                        {{$user_names[$student->student_id]}}
                          <form action="/course/{{$course->id}}/delete" method="post">
                        <button  type="submit" name="student_id" value="{{$student->id}}"  class="delete is-small"></button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                      </span>
                    </span>
{{--                    <span style="background: #87d37c;padding: 5px 10px 5px 10px;border: 1px solid none; border-radius: 10px; box-shadow: 1px 1px 5px grey;">--}}
{{--                        <form action="/course/{{$course->id}}/delete" method="post">--}}
{{--                            <button type="submit" name="student_id" value="{{$student->id}}" class="btn btn-danger btn-square-md" style="width: 20px !important;max-width: 100% !important;max-height: 100% !important;height: 20px !important;text-align: center;padding: 0px;font-size:12px;">X</button>--}}
{{--                            <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                        </form>--}}
{{--                        {{$user_names[$student->student_id]}}--}}
{{--                    </span>--}}
                @empty
                    No students!
                @endforelse
            </td>
            <td>{{ $course->status }}</td>

            <td>

                <form action="/course/{{$course->id}}" method="get" style="all: unset !important;">
                    <button type="submit" class="btn btn-success">Students</button>
                </form>
                <form action="/course/{{$course->id}}/edit" method="get" style="all: unset !important;">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
                <form action="/course/{{$course->id}}" method="post" style="all: unset !important;">
                    <button class="btn btn-danger" type="submit" >Delete</button>
                    <input type="hidden" name="_method" value="delete" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>

            </td>

        </tr>
    @empty
        <p>No Courses</p>
    @endforelse
    </tbody>
</table>


{{-- Pagination --}}
<div class="d-flex justify-content-center">
    {!! $courses->links() !!}
</div>

</body>
</html>
