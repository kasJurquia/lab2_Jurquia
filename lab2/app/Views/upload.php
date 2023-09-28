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
            background-color: #000;
            color: #fff;
        }

        .container {
            background-color: #121212;
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
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Upload Music</h2>
        <form action="<?= site_url('music/upload') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="music_file" class="form-label">Select Music:</label>
                <input type="file" name="music_file" class="form-control" accept=".mp3, .ogg" required>
            </div>
            <div class="mb-3">
                <label for="playlist" class="form-label">Select Playlist:</label>
                <select name="playlist" class="form-select">
                    <option value="none">Select a Playlist</option>
                    <?php if (isset($playlist)): ?>
                        <?php foreach ($playlist as $pl): ?>
                            <option value="<?= $pl['playlist_name'] ?>">
                                <?= $pl['playlist_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success btn-block">Upload</button>
        </form>
        <br>
        <a class="btn btn-primary btn-back" href="/music">Go Back</a>
    </div>
    <!-- Include Bootstrap JS and jQuery (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
