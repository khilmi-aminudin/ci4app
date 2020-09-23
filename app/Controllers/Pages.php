<?php namespace App\Controllers;

use CodeIgniter\Debug\Toolbar\Collectors\Views;

class Pages extends BaseController
{
	public function index()
	{
                $data = [
                        'title' => 'Home | Khilmi Aminudin'
                ];
                return view('pages/home',$data);
        }
    
        public function about()
        {
                $data = [
                        'title' => 'About Me'
                ];
                echo view('pages/about',$data);
	}
        
        public function contact()
        {
                $data = [
                        'title' => 'Contact Us',
                        'alamat' => [
                                [
                                        'tipe' => 'Rumah',
                                        'alamat' => 'Jalan abc no 123',
                                        'kota' => 'Bandung'
                                ],
                                [
                                        'tipe' => 'Kantor',
                                        'alamat' => 'jalan Karangsari no 45',
                                        'kota' => 'Bandung'
                                ]
                        ]
                ];
                echo view('pages/contact',$data);   
        }
	//--------------------------------------------------------------------

}
