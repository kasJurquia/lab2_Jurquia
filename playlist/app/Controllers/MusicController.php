<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class MusicController extends BaseController
{
    public function index()
{
    // Fetch the list of uploaded music from the database
    $musicModel = new \App\Models\MusicModel(); // Replace with your actual model class name
    $data['music'] = $musicModel->findAll();

    // Load the view to display the list of music
    return view('music_all_in_one', $data);
}

    public function upload()
    {
        // Handle music file upload and store information in the database
        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'title' => 'required',
                'music_file' => 'uploaded[music_file]|mime_in[music_file,audio/mpeg,audio/ogg]',
                'playlist' => 'required',
            ];
    
            if ($this->validate($validationRules)) {
                $title = $this->request->getPost('title');
                $file = $this->request->getFile('music_file');
                $playlist = $this->request->getPost('playlist');
    
                // Generate a unique filename
                $newFileName = $file->getRandomName();
    
                // Move the uploaded file to a directory (assuming 'uploads' is your directory)
                $file->move(ROOTPATH . 'public/uploads', $newFileName);
    
                // Insert music information into the database along with the selected playlist
                $musicModel = new \App\Models\MusicModel(); // Replace with your actual model class name
                $musicModel->insert([
                    'title' => $title,
                    'file_name' => $newFileName,
                    'playlist' => $playlist, // Assuming 'playlist' is the column name in your database
                ]);
    
                // Redirect back to the music list
                return redirect()->to('music');
            }
        }
    
        // Load the view for uploading music
        return view('music_all_in_one');
    }
    
    public function play($id)
    {
        // Fetch the music record with the given ID from the database
        $musicModel = new \App\Models\MusicModel(); // Replace with your actual model class name
        $music = $musicModel->find($id);

        if ($music) {
            // Generate the full path to the music file
            $musicPath = 'uploads/' . $music['file_name'];

            // Load the view to play the music
            return view('music_all_in_one', ['music_to_play' => $music, 'music_path' => $musicPath]);
        } else {
            // Music not found, you can handle this accordingly
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
            // Music not found, you can handle this accordingly
            return redirect()->to('music');
        }
    }
}
