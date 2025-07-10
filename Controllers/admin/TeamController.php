<?php
namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\TeamModel;

class TeamController extends BaseController
{
    protected $teamModel;

    public function __construct()
    {
        $this->teamModel = new TeamModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Team',
            'teams' => $this->teamModel->paginate(5),
            'pager' => $this->teamModel->pager
        ];
        return view('admin/team/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Team Member'
        ];
        return view('admin/team/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]',
            'posisi' => 'required|min_length[3]',
            'photo' => 'permit_empty|uploaded[photo]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[photo,2048]',
            'fb' => 'permit_empty|valid_url',
            'x' => 'permit_empty|valid_url',
            'ig' => 'permit_empty|valid_url'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Handle file upload
        $photoName = null;
        $photo = $this->request->getFile('photo');
        
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            // Generate unique filename
            $photoName = $photo->getRandomName();
            
            // Create upload directory if not exists
            $uploadPath = WRITEPATH . 'uploads/team/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            // Move file to upload directory
            $photo->move($uploadPath, $photoName);
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'posisi' => $this->request->getPost('posisi'),
            'photo_url' => $photoName,
            'fb' => $this->request->getPost('fb'),
            'x' => $this->request->getPost('x'),
            'ig' => $this->request->getPost('ig')
        ];

        $this->teamModel->save($data);
        return redirect()->to('/admin/team')->with('success', 'Team member berhasil ditambahkan');
    }

    public function edit($id)
    {
        $team = $this->teamModel->find($id);
        
        if (!$team) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Team member tidak ditemukan');
        }
        
        $data = [
            'title' => 'Edit Team Member',
            'team' => $team
        ];
        return view('admin/team/edit', $data);
    }

    public function update($id)
    {
        $team = $this->teamModel->find($id);
        
        if (!$team) {
            return redirect()->to('/admin/team')->with('error', 'Team member tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]',
            'posisi' => 'required|min_length[3]',
            'photo' => 'permit_empty|uploaded[photo]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[photo,2048]',
            'fb' => 'permit_empty|valid_url',
            'x' => 'permit_empty|valid_url',
            'ig' => 'permit_empty|valid_url'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Handle file upload
        $photoName = $team['photo_url']; // Keep existing photo by default
        $photo = $this->request->getFile('photo');
        
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            // Delete old photo if exists
            if ($team['photo_url'] && file_exists(WRITEPATH . 'uploads/team/' . $team['photo_url'])) {
                unlink(WRITEPATH . 'uploads/team/' . $team['photo_url']);
            }
            
            // Generate unique filename
            $photoName = $photo->getRandomName();
            
            // Create upload directory if not exists
            $uploadPath = WRITEPATH . 'uploads/team/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            // Move file to upload directory
            $photo->move($uploadPath, $photoName);
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'posisi' => $this->request->getPost('posisi'),
            'photo_url' => $photoName,
            'fb' => $this->request->getPost('fb'),
            'x' => $this->request->getPost('x'),
            'ig' => $this->request->getPost('ig')
        ];

        $this->teamModel->update($id, $data);
        return redirect()->to('/admin/team')->with('success', 'Team member berhasil diupdate');
    }

    public function delete($id)
    {
        $team = $this->teamModel->find($id);
        
        if (!$team) {
            return redirect()->to('/admin/team')->with('error', 'Team member tidak ditemukan');
        }
        
        // Delete photo file if exists
        if ($team['photo_url'] && file_exists(WRITEPATH . 'uploads/team/' . $team['photo_url'])) {
            unlink(WRITEPATH . 'uploads/team/' . $team['photo_url']);
        }
        
        $this->teamModel->delete($id);
        return redirect()->to('/admin/team')->with('success', 'Team member berhasil dihapus');
    }

    // Method untuk menampilkan foto
    public function photo($filename)
    {
        $filepath = WRITEPATH . 'uploads/team/' . $filename;
        
        if (!file_exists($filepath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File tidak ditemukan');
        }
        
        $this->response->setHeader('Content-Type', mime_content_type($filepath));
        return $this->response->setBody(file_get_contents($filepath));
    }
}