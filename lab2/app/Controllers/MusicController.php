<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class MusicController extends BaseController
{
    public function delete_playlist($id)
{
    // Load the playlist model
    $playlistModel = new \App\Models\PlaylistModel();

    // Find the playlist with the given ID
    $playlist = $playlistModel->find($id);

    if ($playlist) {
        // Delete the playlist
        $playlistModel->delete($id);

        // Redirect back to the music management page
        return redirect()->to('music/add_playlist');
    } else {
        // Playlist not found, you can handle this accordingly
        return redirect()->to('music');
    }
}

    public function add_playlist()
{
    $playlistModel = new \App\Models\PlaylistModel();
        $data['playlist'] = $playlistModel->findAll();

    if ($this->request->getMethod() === 'post') {
        // Get the playlist name from the form input
        $playlistName = $this->request->getPost('playlist_name');

        // Load the playlist model
        $playlistModel = new \App\Models\PlaylistModel();

        // Insert the new playlist into the 'playlist' table
        $playlistModel->insert([
            'playlist_name' => $playlistName,
        ]);

        // Redirect back to the music management
        return redirect()->to('music/add_playlist');
    }
    return view('uploadPlaylist', $data);
    
}

    public function uploadform()
    {
        $playlistModel = new \App\Models\PlaylistModel();
        $data['playlist'] = $playlistModel->findAll();
        return view('upload' ,$data);
    }
    public function index()
    {
        // Fetch the list of uploaded music from the 'music' table
        $musicModel = new \App\Models\MusicModel();
        $data['music'] = $musicModel->findAll();

        // Fetch the list of playlists from the 'playlist' table
        $playlistModel = new \App\Models\PlaylistModel();
        $data['playlist'] = $playlistModel->findAll();

        // Load the view to display the list of music and playlists
        return view('music_all_in_one', $data);
    }

    public function upload()
{
    // Load the music model and fetch all music records from the 'music' table
    $musicModel = new \App\Models\MusicModel();
    $data['music'] = $musicModel->findAll();

    // Load the playlist model and fetch all playlists from the 'playlist' table
    $playlistModel = new \App\Models\PlaylistModel();
    $data['playlist'] = $playlistModel->findAll();

    // Handle music file upload and store information in the 'music' table
    if ($this->request->getMethod() === 'post') {
        $validationRules = [
            'music_file' => 'uploaded[music_file]|mime_in[music_file,audio/mpeg,audio/ogg]',
        ];

        if ($this->validate($validationRules)) {
            $file = $this->request->getFile('music_file');

            // Use the original name of the uploaded file as the title
            $title = $file->getName();

            // Generate a unique filename
            $newFileName = $file->getRandomName();

            // Specify the upload path (public/uploads)
            $uploadPath = ROOTPATH . 'public/uploads/';

            // Move the uploaded file to the upload path
            if ($file->move($uploadPath, $newFileName)) {
                // Insert music information
                $musicModel->insert([
                    'title' => $title,
                    'file_name' => $newFileName,
                    'playlist' => $this->request->getPost('playlist'),
                ]);

                // Redirect back to the music list
                return redirect()->to('music');
            } else {
                // Handle the file move failure
                return redirect()->to('music/upload')->with('error', 'Failed to upload the file.');
            }
        }
    }

    // Load the view for uploading music with playlists
    return view('music_all_in_one', $data);
}


    public function play($id)
    {
        // Fetch the music record with the given ID from the database
        $musicModel = new \App\Models\MusicModel();
        $music = $musicModel->find($id);

        if ($music) {
            // Generate the full path to the music file
            $musicPath = 'uploads/' . $music['file_name'];

            // Load the view to play the music
            return view('music_all_in_one', ['music_to_play' => $music, 'music_path' => $musicPath]);
        } else {
            // Music not found
            return redirect()->to('music');
        }
    }

    public function delete($id)
    {
        // Fetch the music record with the given ID from the database
        $musicModel = new \App\Models\MusicModel(); // Replace with your actual model class name
        $music = $musicModel->find($id);

        if ($music) {
            // Load the view to confirm the music deletion
            return view('music_all_in_one', ['music_to_delete' => $music]);
        } else {
            // Music not found, you can handle this accordingly
            return redirect()->to('music');
        }
    }

    public function delete_confirm($id)
    {
        // Fetch the music record with the given ID from the database
        $musicModel = new \App\Models\MusicModel(); // Replace with your actual model class name
        $music = $musicModel->find($id);

        if ($music) {
            // Delete the music file from the file system
            $musicPath = ROOTPATH . 'public/uploads/' . $music['file_name'];
            if (file_exists($musicPath)) {
                unlink($musicPath);
            }

            // Delete the music record from the database
            $musicModel->delete($id);

            // Redirect back to the music list
            return redirect()->to('music');
        } else {
            // Music not found
            return redirect()->to('music');
        }
    }
}