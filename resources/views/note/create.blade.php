<!DOCTYPE html>
<html>
<head>
    <title>Create Note</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Create Note</h2>

    <form method="post" action="/store">

        @csrf

        <div class="mb-3">

            <label>Title</label>

            <input type="text"
                   name="title"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Content</label>

            <textarea name="content"
                      rows="5"
                      class="form-control"></textarea>

        </div>

        <button class="btn btn-success">
            Save Note
        </button>

    </form>

</div>

</body>
</html>