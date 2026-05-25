<!DOCTYPE html>
<html>
<head>
    <title>Edit Note</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Edit Note</h2>

    <form method="post" action="/update/{{ $note->id }}">

        @csrf

        <div class="mb-3">

            <label>Title</label>

            <input type="text"
                   name="title"
                   value="{{ $note->title }}"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Content</label>

            <textarea name="content"
                      rows="5"
                      class="form-control">{{ $note->content }}</textarea>

        </div>

        <button class="btn btn-primary">
            Update Note
        </button>

    </form>

</div>

</body>
</html>