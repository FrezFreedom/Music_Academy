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
<div style="margin: 100px; margin-left: 30%; margin-right: 30%;">
    <input type="hidden" name="_method" value="put" />
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Students' Name</label>
        <div style="margin-top: 20px;">
            @forelse($course->students as $student)
                <span class="block" style="margin: 5px;height: auto;width: auto;">
                      <span class="tag is-success">
                        {{$user_names[$student->student_id]}}
                          <form action="/course/{{$course->id}}/students/delete" method="post">
                              <button  type="submit" name="student_id" value="{{$student->id}}"  class="delete is-small"></button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          </form>
                      </span>
                </span>
            @empty
                No students!
            @endforelse
        </div>
    </div>

    <div class="form-group" style="margin-top: 5px;">
        <label for="student">Students</label>
        <form action="/course/{{$course->id}}/students/add" method="post">
            <select style="margin-top: 3px;" class="form-select" aria-label="Default select example" name="student" id="student">
                @foreach($students as $student)
                    <option value="{{$student->id}}" {{(old('student') == $student->id)?'selected':''}}>{{$student->name}}</option>
                @endforeach
            </select>
            @error('student')
                <div class="alert alert-danger" style="margin-top: 5px; padding: 5px;">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary" style="margin-top: 10px;width: 100%;">Submit</button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </div>

</div>

</body>
</html>
