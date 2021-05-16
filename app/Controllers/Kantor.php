<?php

namespace App\Controllers;

use CodeIgniter\Controllers;
use \App\Models\M_kantor;

class Kantor extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->M_kantor = new M_kantor();
    }
    public function index()
    {
        $data = [
            'title' => 'Kantor',
            'kantor' => $this->M_kantor->get_all_data(),
            'isi' => 'v_kantor',
        ];
        echo view('layout/v_template', $data);
    }
    public function add()
    {
        $data = [
            'title' => ' Add Kantor',
            'isi' => 'v_add_kantor',
        ];
        echo view('layout/v_template', $data);
    }

    public function save()
    {
        $valid = $this->validate([
            'nama_kantor' => [
                'label' => 'Nama Kantor',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ]
            ],
            'no_telpon' => [
                'label' => 'No Telpon Kantor',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ]
            ],
            'alamat' => [
                'label' => 'Alamat  Kantor',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ]
            ],
            'lat' => [
                'label' => 'Lokasi  Kantor',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ]
            ],
            'long' => [
                'label' => 'Lokasi  Kantor',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ]
            ],
            'foto' => [
                'label' => 'Foto  Kantor',
                'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,1500]',
                'errors' => [
                    'uploaded' => '{field} Wajib Diisi'
                ]
            ],
        ]);
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('kantor/add'));
        } else {
            $image = $this->request->getFile('foto');
            $name = $image->getRandomName();
            $data = [
                'nama_kantor' =>  $this->request->getPost('nama_kantor'),
                'alamat' =>  $this->request->getPost('alamat'),
                'no_telpon' =>  $this->request->getPost('no_telpon'),
                'lat' =>  $this->request->getPost('lat'),
                'long' =>  $this->request->getPost('long'),
                'deskripsi' =>  $this->request->getPost('deskripsi'),
                'foto' => $name,
            ];
            $image->move('foto', $name);
            $this->M_kantor->insert_data($data);
            session()->setFlashdata('success', 'Data Kantor Berhasil Ditambahkan!!!');
            return redirect()->to(base_url('kantor'));
        }
    }

    public function edit($id)
    {
        $data = [
            'title' => ' Edit Kantor',
            'kantor' => $this->M_kantor->detail($id),
            'isi' => 'v_edit_kantor',
        ];
        echo view('layout/v_template', $data);
    }


    public function update($id)
    {
        $valid = $this->validate([
            'nama_kantor' => [
                'label' => 'Nama Kantor',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ]
            ],
            'no_telpon' => [
                'label' => 'No Telpon Kantor',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ]
            ],
            'alamat' => [
                'label' => 'Alamat  Kantor',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ]
            ],
            'lat' => [
                'label' => 'Lokasi  Kantor',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ]
            ],
            'long' => [
                'label' => 'Lokasi  Kantor',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi'
                ]
            ],
            'foto' => [
                'label' => 'Foto  Kantor',
                'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,1500]',
                'errors' => [
                    'uploaded' => '{field} Wajib Diisi'
                ]
            ],

        ]);

        $kantor = $this->M_kantor->detail($id);
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('kantor/edit/' . $kantor['id']));
        } else {
            $image = $this->request->getFile('foto');
            $name = $image->getRandomName();
            $data = [

                'nama_kantor' =>  $this->request->getPost('nama_kantor'),
                'alamat' =>  $this->request->getPost('alamat'),
                'no_telpon' =>  $this->request->getPost('no_telpon'),
                'lat' =>  $this->request->getPost('lat'),
                'long' =>  $this->request->getPost('long'),
                'deskripsi' =>  $this->request->getPost('deskripsi'),
                'foto' => $name,
            ];
            $image->move('foto', $name);
            $this->M_kantor->update_kantor($data, $id);
            session()->setFlashdata('success', 'Data Kantor Berhasil DiUpdate!!!');
            return redirect()->to(base_url('kantor'));
        }
    }

    public function delete($id)
    {
        $this->M_kantor->delete_kantor($id);
        session()->setFlashdata('success', 'Data Kantor Berhasil DiHapus!!!');
        return redirect()->to(base_url('kantor'));
    }
    //--------------------------------------------------------------------


}
