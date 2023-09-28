<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Management</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS for Spotify-like theme -->
    <style>
        body {
            background-color: #181818;
            color: white;
        }

        .navbar {
            background-color: #000;
        }

        .navbar-brand {
            color: #1DB954;
        }

        .navbar-toggler-icon {
            background-color: #1DB954;
        }

        .nav-link.btn {
            background-color: #1DB954;
            border-color: #1DB954;
        }

        .nav-link.btn:hover {
            background-color: #1ED760;
            border-color: #1ED760;
        }

        .input-group .btn-success {
            background-color: #1DB954;
            border-color: #1DB954;
        }

        .input-group .btn-success:hover {
            background-color: #1ED760;
            border-color: #1ED760;
        }

        .table {
            background-color: #121212;
            color: white;
        }

        .table thead th {
            background-color: #000;
            color: #1DB954;
        }

        .btn-primary {
            background-color: #1DB954;
            border-color: #1DB954;
            margin-right: 10px; /* Adjust the margin as needed */
        }

        .btn-primary:hover {
            background-color: #1ED760;
            border-color: #1ED760;
        }

        .btn-danger {
            background-color: #1DB954;
            border-color: #1DB954;
        }

        .btn-danger:hover {
            background-color: #1ED760;
            border-color: #1ED760;
        }

        .now-playing {
            background-color: #121212;
            border: 1px solid #1DB954;
            padding: 10px;
        }

        .now-playing h2, .now-playing h3, .now-playing h5 {
            color: white;
        }

        .now-playing audio {
            width: 100%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">Music Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-success" href="/upload">Upload</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-success" href="music/add_playlist">Add Playlist</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center mb-4">Search Music</h2>
                <div class="input-group mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search by Title and Playlist">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button">Search</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h2 class="text-center">Music List</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Playlist</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($music) && count($music) > 0): ?>
                            <?php foreach ($music as $song): ?>
                                <tr>
                                    <td><?= $song['title'] ?></td>
                                    <td><?= $song['playlist'] ?></td>
                                    <td>
                                        <a href="<?= site_url('music/play/' . $song['id']) ?>" class="btn btn-primary btn-sm">Play</a>
                                        <a href="<?= site_url('music/delete/' . $song['id']) ?>" class="btn btn-danger btn-sm delete-button">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center">No music available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="col-md-6">
                <?php if (isset($music_to_play)): ?>
                    <div class="now-playing">
                        <h2 class="text-center">Now Playing</h2>
                        <h3><strong>Title:</strong> <?= $music_to_play['title'] ?></h3>
                        <h5><strong>Playlist:</strong> <?= $music_to_play['playlist'] ?></h5>
                        <audio controls>
                            <source src="<?= base_url('uploads/' . $music_to_play['file_name']) ?>" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                        <a href="javascript:history.back()" class="btn btn-primary btn-block mt-3">Go Back</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (isset($music_to_delete)): ?>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h2 class="text-center">Delete Music</h2>
                    <p>Are you sure you want to delete this music?</p>
                    <p><strong>Title:</strong> <?= $music_to_delete['title'] ?></p>
                    <a href="<?= site_url('music/delete_confirm/' . $music_to_delete['id']) ?>" class="btn btn-danger">Yes, Delete</a>
                    <a href="<?= site_url('music') ?>" class="btn btn-secondary">No, Cancel</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Include Bootstrap JS and jQuery (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // JavaScript for live search
        $(document).ready(function () {
            $("#searchInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("tbody tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            // Enable all delete buttons initially
            $(".delete-button").prop("disabled", false);

            // Handle delete button click
            $(".delete-button").click(function () {
                var row = $(this).closest("tr");
                var songTitle = row.find("td:eq(0)").text();
                var confirmation = confirm("Are you sure you want to delete the song: " + songTitle + "?");
                if (confirmation) {
                    // Handle the deletion logic here
                    // You can use AJAX or other methods to delete the song
                    // For now, we'll simply remove the row
                    row.remove();
                }
            });
        });
    </script>
</body>
</html>
