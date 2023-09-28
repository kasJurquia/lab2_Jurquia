<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Management</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Spotify-like CSS -->
    <style>
        body {
            background-color: #121212;
            color: #fff;
        }

        .container {
            background-color: #000;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        h2 {
            color: #1DB954;
        }

        .form-label {
            font-weight: bold;
            color: #1DB954;
        }

        .form-control,
        .form-select {
            background-color: #121212;
            border: 1px solid #1DB954;
            color: #fff;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #121212;
            border: 1px solid #1DB954;
            color: #fff;
            box-shadow: none;
        }

        .btn-success {
            background-color: #1DB954;
            border-color: #1DB954;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #1ED760;
            border-color: #1ED760;
        }

        .btn-primary {
            background-color: #1DB954;
            border-color: #1DB954;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #1ED760;
            border-color: #1ED760;
        }

        .btn.btn-primary.btn-block {
            background-color: #1DB954;
            border-color: #1DB954;
            color: #fff;
        }

        .btn.btn-primary.btn-block:hover {
            background-color: #1ED760;
            border-color: #1ED760;
        }

        .btn.btn-primary.btn-back {
            background-color: transparent;
            border-color: #1DB954;
            color: #1DB954;
        }

        .btn.btn-primary.btn-back:hover {
            background-color: transparent;
            border-color: #1ED760;
            color: #1ED760;
        }

        .table {
            background-color: #121212;
            color: #fff;
            border: 1px solid #1DB954;
        }

        .table thead th {
            background-color: #000;
            color: #1DB954;
        }

        .btn-danger {
            background-color: #1DB954;
            border-color: #1DB954;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #1ED760;
            border-color: #1ED760;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Add New Playlist</h2>
        <form action="<?= site_url('music/add_playlist') ?>" method="post">
            <div class="mb-3">
                <label for="playlist_name" class="form-label">Playlist Name:</label>
                <input type="text" name="playlist_name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success btn-block">Add Playlist</button>
        </form>
    </div>
    <div class="container mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Playlist</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($playlist as $playlist): ?>
                    <tr>
                        <td>
                            <?= $playlist['playlist_name'] ?>
                        </td>
                        <td>
                            <a href="<?= site_url('music/delete_playlist/' . $playlist['id']) ?>"
                                class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="container mt-4">
        <a class="btn btn-primary btn-back" href="/music">Go back</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
