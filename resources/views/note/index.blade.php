<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Notes App</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .navbar{
            background:#212529;
        }

        .navbar-brand{
            color:white !important;
            font-weight:bold;
        }

        .note-card{
            border:none;
            border-radius:12px;
            transition:0.3s;
        }

        .note-card:hover{
            transform:translateY(-5px);
            box-shadow:0 5px 20px rgba(0,0,0,0.1);
        }

        .summary-box{
            background:#eef7ff;
            border-left:5px solid #0d6efd;
            padding:10px;
            border-radius:5px;
        }

        textarea{
            resize:none;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">
            AI Notes Management System
        </a>
    </div>
</nav>

<div class="container mt-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Notes</h2>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNoteModal">
            Add Note
        </button>
    </div>

    <!-- Search -->
     <form action="/" method="GET">
    <div class="card p-3 mb-4">
        <div class="row">
            <div class="col-md-10">
                <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search notes..."
                   >
               
            </div>

            <div class="col-md-2">
                <button class="btn btn-success w-100">
                    AI Search
                </button>
            </div>
        </div>
    </div>
</form>

    <!-- Notes Grid -->
    <div class="row">

        <!-- Note Card -->
         @foreach($notes as $note)
        <div class="col-md-4 mb-4">
            <div class="card note-card shadow-sm">

                <div class="card-body">

                    <h4 class="card-title">
                        {{$note->title}}
                    </h4>

                    <!-- AI Summary -->
                    <div class="summary-box mb-3">
                        
                        <p class="mb-0">
                          {{$note->content}}
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2">
                
                        <a href="/edit/{{ $note->id }}"
                        class="btn btn-warning btn-sm">
                        Edit
                        </a>

                        <a href="/delete/{{ $note->id }}"
                        class="btn btn-danger btn-sm">
                        Delete
                        </a>

                    </div>

                </div>

            </div>
        </div>
        @endforeach

        <!-- Another Card -->
        <!-- <div class="col-md-4 mb-4">
            <div class="card note-card shadow-sm">

                <div class="card-body">

                    <h4 class="card-title">
                        AI Semantic Search
                    </h4>

                    <p class="card-text text-muted">
                        Semantic search uses embeddings to search notes by meaning instead of exact keywords.
                    </p>

                    <div class="summary-box mb-3">
                        <strong>AI Summary:</strong>
                        <p class="mb-0">
                            AI search improves note finding using embeddings.
                        </p>
                    </div>

                    <div class="d-flex justify-content-between">

                        <button class="btn btn-warning btn-sm">
                            Edit
                        </button>

                        <button class="btn btn-danger btn-sm">
                            Delete
                        </button>

                        <button class="btn btn-info btn-sm text-white">
                            Generate Summary
                        </button>

                    </div>

                </div>

            </div>
        </div> -->

    </div>

    <!-- Pagination -->
    <nav>
          {{ $notes->links() }}
        <!-- <ul class="pagination justify-content-center">

        
        </ul> -->
    </nav>

</div>

<!-- Add Note Modal -->
<div class="modal fade" id="addNoteModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Add New Note
                </h5>

                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <form method="post" action="/store">
                @csrf
                    <div class="mb-3">
                        <label class="form-label">
                            Title
                        </label>

                        <input type="text" name="title" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Content
                        </label>

                        <textarea class="form-control" name="content" rows="5"></textarea>
                    </div>

                    <button class="btn btn-primary w-100">
                        Save Note
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>