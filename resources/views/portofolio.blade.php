<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portofolio</title>
</head>
<body>
    <h1>Fahril Ilham Pangestu</h1>
    <p>Software Engineering Learner</p>

    <h2>My Projects</h2>
    <a href="/projects/create">+ Tambah Project</a>

    @if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    @if ($projects->count())
        <ul>
            @foreach ($projects as $project)
                <div>
                    <h3>{{ $project->title }}</h3>
                    <p>{{ $project->description }}</p>
                    <ul>
                        <li>{{ $project->tech_stack }}</li>
                    </ul>
                </div>
            @endforeach
        </ul>
    @else
        <p>Belum ada project.</p>
    @endif
</body>
</html>
