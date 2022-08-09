<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<form style="margin: 100px; margin-left: 30%; margin-right: 30%;" method="post" action="/course/{{$course->id}}">
    <input type="hidden" name="_method" value="put" />
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Amozesh 3tar" value="{{$course->name}}">
    </div>
    @error('name')
        <div class="alert alert-danger" style="margin-top: 5px; padding: 5px;">{{ $message }}</div>
    @enderror

    <div class="form-group">
        <label for="name">Description</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="....." value={{$course->description}}>
    </div>
    @error('discription')
        <div class="alert alert-danger" style="margin-top: 5px; padding: 5px;">{{ $message }}</div>
    @enderror

    <div class="form-group" style="margin-top: 5px;">
        <label for="maestro">Maestro</label>
        <select style="margin-top: 3px;" class="form-select" aria-label="Default select example" name="maestro" id="maestro">
            @foreach($maestros as $maestro)
                <option value="{{$maestro->id}}" {{($course->maestro == $maestro)?'selected':''}}>{{$maestro->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group" style="margin-top: 5px;">
        <label for="status">Status</label>
        <select style="margin-top: 3px;" class="form-select" aria-label="Default select example" name="status" id="status">
            @foreach($status_list as $status)
                <option value="{{$status}}" {{($course->status == $status)?'selected':''}}>{{$status}}</option>
            @endforeach
        </select>
    </div>


    <button type="submit" class="btn btn-primary" style="margin-top: 10px;width: 100%;">Submit</button>
</form>

</table>

</body>
</html>
