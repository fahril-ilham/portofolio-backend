<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Project</title>
</head>
<body>
    <h1>Edit Project</h1>

    @if ($errors->any())
        <ul style="color: red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="/projects/{{ $project->id }}" method="post">
        @csrf
        @method('put')

        <div>
            <label for="title">Judul</label><br>
            <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}">
        </div>

        <div>
            <label for="description">Deskripsi</label><br>
            <textarea name="description" id="description" cols="30" rows="10">{{ old('description', $project->description) }}</textarea>
        </div>

        <div>
            <label for="tech_stack">Tech Stack</label><br>
            <input type="text" name="tech_stack" id="tech_stack" value="{{ old('tech_stack', $project->tech_stack) }}">
        </div>

        <button type="submit">Update</button>
    </form>
</body>
</html>
