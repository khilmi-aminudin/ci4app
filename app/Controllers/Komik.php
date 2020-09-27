<?php namespace App\Controllers;

use App\Models\KomikModel;
    
class Komik extends BaseController
{
    protected $komikModel;

    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik() 
        ];
        return view('komik/index', $data);
    } 

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        // Jika Komik tidak ada
        if(empty($data['komik']))
        {
            //untuk menampilkan page not found
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik Tidak Ditemukan');
        }

        return view('komik/detail',$data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Komik',
            // Mengirim data Validasi ke halman create
            'validation' => \Config\Services::validation()
        ];

        return view('komik/create', $data);
    }

    public function save()
    {
        // Validation form for input data
        if (!$this->validate([
            'judul' => [
                // rules adalah aturan untuk validasi nya
                // errors adalah custom errors message nya
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} komik harus di isi.',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/pg,image/jpeg],image/png',
                'errors' => [
                    // 'uploaded' => 'Gambar sampul harus diisi',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // Untuk mengambil semua informasi tentang validasi
            // $validation = \Config\Services::validation();
            // return redirect()->to('/komik/create')->withInput()->with('validation',$validation);
            return redirect()->to('/komik/create')->withInput();
        }

        // Ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            // generate random name
            $namaSampul = $fileSampul->getRandomName();
            // Pindahkan gambar ke folder img
            $fileSampul->move('img', $namaSampul);
        }
        
        
        // untuk membuat slug dari judul
        $slug = url_title($this->request->getVar('judul'),'-',true);
        // untuk meng insert data dari form ke database
        // fungsi $this->request->getVar() digunakan untuk mengambil data dari from
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);
        
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        // cari gambar berdasarkan id
        $komik = $this->komikModel->find($id);

        if($komik['sampul'] != 'default.jpg'){
                // menghapus gambar
            unlink('img/'.$komik['sampul']);
        }

        $this->komikModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'From Ubah Data Komik',
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug)
        ];

        return view('/komik/edit', $data);

    }

    public function update($id)
    {
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        }else{
            $rule_judul = 'required|is_unique[komik.judul]';
        }


        // Validation form for input data
        if (!$this->validate([
            'judul' => [
                // rules adalah aturan untuk validasi nya
                // errors adalah custom errors message nya
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} komik harus di isi.',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/pg,image/jpeg],image/png',
                'errors' => [
                    // 'uploaded' => 'Gambar sampul harus diisi',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // Untuk mengambil semua informasi tentang validasi
            // $validation = \Config\Services::validation();
            // return redirect()->to('/komik/edit/'.$this->request->getVar('slug'))->withInput()->with('validation',$validation);
            
            return redirect()->to('/komik/edit/'.$this->request->getVar('slug'))->withInput();
        }
        
        $fileSampul = $this->request->getFile('sampul');

        $fileSampulLama = $this->request->getVar('sampulLama');
        // cek apakah gabar dirubah
        if($fileSampul->getError() == 4){
            $namaSampul = $fileSampulLama;
        }else{
            // rename file gambar yang di upload
            $namaSampul = $fileSampul->getRandomName();
            // pindahkan file gambar ke img
            $fileSampul->move('img');
            // hapus gambar lama jika dia bukan default gambar
            if($fileSampulLama != 'default.jpg'){
                unlink('img/'.$fileSampulLama);
            }

        }

        // untuk membuat slug dari judul
        $slug = url_title($this->request->getVar('judul'),'-',true);

        // untuk meng insert data dari form ke database
        // fungsi $this->request->getVar() digunakan untuk mengambil data dari from
        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);
        
        session()->setFlashdata('pesan', 'Data Berhasil Di Ubah');

        return redirect()->to('/komik');
    }
}
