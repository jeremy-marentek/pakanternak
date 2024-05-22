<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    //===============================================
    //                LOGIN ADMIN
    //===============================================

    public function index()
    {
        //SESSION
        if ($this->session->userdata('id')) {
            redirect('dashboard');
        }

        //title
        $data['title'] = 'Warma CIC | Login';

        //form validation setrules
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        //jika validasi salah
        if ($this->form_validation->run() == false) {
            $this->load->view('auth/admin/login_admin', $data);
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $admin = $this->db->select('*')
                ->from('admin')
                ->where('username_admin', $username)
                ->or_where('email_admin', $username)
                ->get()->row_array();

            //jika user ada
            if ($admin) {
                //cek password
                if (password_verify($password, $admin['password_admin'])) {
                    $data = [
                        'id' => $admin['id_admin'],
                        'nama' => $admin['nama_admin'],
                        'email' => $admin['email_admin'],
                        'id_level' => $admin['id_level'],
                        'foto' => $admin['foto_admin']
                    ];
                    $this->session->set_userdata($data);
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('message', '<div class="flash-data" data-passworderror="Periksa kembali password anda"></div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="flash-data" data-loginadmin="Periksa kembali email atau username anda"></div>');
                redirect('auth');
            }
        }
    }

    //logout admin
    public function logout_admin()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('foto');
        $this->session->unset_userdata('id_level');
        redirect('auth');
    }

    //lupa password admin
    public function lupa_password_admin()
    {
        $data['title'] = 'Warma CIC | Lupa Password';

        //validasi set rules
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');

        //jika salah
        if ($this->form_validation->run() == false) {
            $this->load->view('auth/admin/lupa_password', $data);
        } else {
            $email = $this->input->post('email');
            $admin = $this->db->get_where('admin', ['email_admin' => $email])->row_array();

            if ($admin) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot_admin');
                $this->session->set_flashdata('message', '<div class="flash-data" data-sendemail="Cek email untuk mereset password"></div>');
                redirect('auth/lupa_password_admin');
            } else {
                $this->session->set_flashdata('message', '<div class="flash-data" data-emailerror="Harap periksa kembali email anda"></div>');
                redirect('auth/lupa_password_admin');
            }
        }
    }

    //reset password admin
    public function reset_password_admin()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $admin = $this->db->get_where('admin', ['email_admin' => $email])->row_array();

        if ($admin) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->ubah_password_admin();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" align="center" role="alert">Token salah</div>');
                redirect('auth/lupa_password_admin');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" align="center" role="alert">Gagal mereset password</div>');
            redirect('auth/lupa_password_admin');
        }
    }

    //ubah password admin
    public function ubah_password_admin()
    {
        // cek session
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $data['title'] = 'Warma CIC | Ubah Password';

        //form validasi
        $this->form_validation->set_rules('password1', 'password', 'required|min_length[3]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Password di isi minimal 3 karakter'
        ]);
        $this->form_validation->set_rules('password2', 'password', 'required|min_length[3]|matches[password1]', [
            'required' => 'Konfirmasi password tidak boleh kosong',
            'matches' => 'Password tidak sama',
            'min_length' => 'Konfirmasi password minimal 3 karakter'
        ]);

        //jika form validasi salah
        if ($this->form_validation->run() == false) {
            $this->load->view('auth/admin/ubah_password', $data);
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password_admin', $password);
            $this->db->where('email_admin', $email);
            $this->db->update('admin');

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="flash-data" data-ubahpassword="Password berhasil diubah"></div>');
            redirect('auth');
        }
    }

    //konfigurasi email
    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'bkmcic.official@gmail.com',
            'smtp_pass' => 'bkmendas2019',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->email->initialize($config);
        $this->email->from('bkmcic.oficial@gmail.com', 'Waroeng penjual UCIC');
        $this->email->to($this->input->post('email'));

        if ($type == 'forgot_admin') {
            $this->email->subject('Reset Password');
            $this->email->message('Klik untuk mereset password : <a href="' . base_url() . 'auth/reset_password_admin?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        } else if ($type == 'forgot_penjual') {
            $this->email->subject('Reset Password');
            $this->email->message('Klik untuk mereset password : <a href="' . base_url() . 'auth/reset_password_penjual?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        } else if ($type == 'forgot_umum') {
            $this->email->subject('Reset Password');
            $this->email->message('Klik untuk mereset password : <a href="' . base_url() . 'auth/reset_password_umum?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        } else if ($type == 'verify_penjual') {
            $this->email->subject('Aktivasi akun');
            $this->email->message('Klik untuk mengaktifkan akun : <a href="' . base_url() . 'auth/verify_penjual?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktifkan akun</a>');
        } else if ($type == 'verify_umum') {
            $this->email->subject('Aktivasi akun');
            $this->email->message('Klik untuk mengaktifkan akun : <a href="' . base_url() . 'auth/verify_umum?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktifkan akun</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    //===============================================
    //                LOGIN penjual
    //===============================================

    public function login_penjual()
{
    //title
    $data['title'] = 'Warma CIC | Login Penjual';

    //form validation setrules
    $this->form_validation->set_rules('username', 'username', 'required', [
        'required' => 'Username tidak boleh kosong'
    ]);
    $this->form_validation->set_rules('password', 'password', 'required|min_length[3]', [
        'required' => 'Password tidak boleh kosong',
        'min_length'  => 'Password minimal 3 karakter'
    ]);

    //jika validasi salah
    if ($this->form_validation->run() == false) {
        $this->paggingFrontend('auth/penjual/login_penjual', $data);
    } else {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $penjual = $this->db->select('*')
            ->from('akun_penjual')
            ->where('username', $username)
            ->or_where('email_penjual', $username)
            ->get()->row_array();

        //jika penjual ada
        if ($penjual) {

            //cek akun aktif
            if ($penjual['status_aktif'] == 1) {

                //cek password
                if (password_verify($password, $penjual['password'])) {
                    $data = [
                        'id' => $penjual['id_penjual'],
                        'email' => $penjual['email_penjual'],
                        'foto' => $penjual['foto_penjual'],
                        'nama' => $penjual['nama_penjual'],
                        'telepon' => $penjual['telepon_penjual'],
                        'tipe' => $penjual['tipe']
                    ];
                    $this->session->set_userdata($data);

                    // Check apakah pengguna sudah memiliki alamat utama
                    $alamat_utama = $this->db->get_where('alamat', ['id_pengguna' => $penjual['id_penjual'], 'set_alamat_utama' => 1])->row_array();
                    if ($alamat_utama) {
                        // Jika sudah memiliki alamat utama, redirect ke beranda
                        redirect('beranda');
                    } else {
                        // Jika belum memiliki alamat utama, redirect ke halaman checkout
                        redirect('alamatpenjual');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="flash-data" data-passworderror="Password salah"></div>');
                    redirect('auth/login_penjual');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" align="center" role="alert">Akun tidak aktif</div>');
                redirect('auth/login_penjual');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="flash-data" data-loginadmin="Username atau email tidak ditemukan"></div>');
            redirect('auth/login_penjual');
        }
    }
}

    //buat akun penjual
    public function buat_akun_penjual()
    {
        //title
        $data['title'] = 'Warma CIC | Buat Akun';
    
        //form validation setrules
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[akun_penjual.email_penjual]', [
            'required' => 'Email tidak boleh kosong',
            'valid_email'  => 'Format email tidak valid',
            'is_unique' => 'Email sudah terdaftar'
        ]);
        $this->form_validation->set_rules('nama', 'nama', 'required|trim', [
            'required' => 'Nama tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('username', 'username', 'required|trim', [
            'required' => 'Username tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('telepon', 'telepon', 'required|trim|numeric|is_unique[akun_penjual.telepon_penjual]', [
            'required' => 'Nomor telepon tidak boleh kosong',
            'numeric' => 'Nomor telepon harus berupa angka',
            'is_unique' => 'Nomor telepon sudah terdaftar'
        ]);
        $this->form_validation->set_rules('password1', 'password1', 'required|min_length[3]', [
            'required' => 'Password tidak boleh kosong',
            'min_length'  => 'Password minimal 3 karakter'
        ]);
    
        //jika validasi salah
        if ($this->form_validation->run() == false) {
            $this->paggingFrontend('auth/penjual/buat_akun_penjual', $data);
        } else {
            //input ke table penjual
            $this->auth_model->buatAkun_penjual();
            $this->session->set_flashdata('message', '<div class="flash-data" data-registrasi="Silahkan Login"></div>');
            redirect('auth/login_penjual');
        }
    }
    
    //logout penjual
    public function logout_penjual()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('foto');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('telepon');
        redirect('beranda');
    }
    
    //lupa password penjual
    public function lupa_password_penjual()
    {
        $data['title'] = 'Warma CIC | Lupa Password';
    
        //validasi set rules
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Format email tidak valid'
        ]);
    
        //jika salah
        if ($this->form_validation->run() == false) {
            $this->paggingFrontend('auth/penjual/lupa_password_penjual', $data);
        } else {
            $email = $this->input->post('email');
            $penjual = $this->db->get_where('akun_penjual', ['email_penjual' => $email])->row_array();
    
            if ($penjual) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
    
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot_penjual');
                $this->session->set_flashdata('message', '<div class="flash-data" data-sendemail="Cek email untuk mereset password"></div>');
                redirect('auth/lupa_password_penjual');
            } else {
                $this->session->set_flashdata('message', '<div class="flash-data" data-emailerror="Email tidak terdaftar"></div>');
                redirect('auth/lupa_password_penjual');
            }
        }
    }
    
    //reset password penjual
    public function reset_password_penjual()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $penjual = $this->db->get_where('akun_penjual', ['email' => $email])->row_array();
    
        if ($penjual) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->ubah_password_penjual();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" align="center" role="alert">Token salah</div>');
                redirect('auth/lupa_password_penjual');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" align="center" role="alert">Gagal mereset password</div>');
            redirect('auth/lupa_password_penjual');
        }
    }
    
    //ubah password penjual
    public function ubah_password_penjual()
    {
        // cek session
        if (!$this->session->userdata('reset_email')) {
            redirect('auth/login_penjual');
        }
    
        $data['title'] = 'Warma CIC | Ubah Password';
    
        //form validasi
        $this->form_validation->set_rules('password1', 'password', 'required|min_length[3]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Password minimal 3 karakter'
        ]);
        $this->form_validation->set_rules('password2', 'password', 'required|min_length[3]|matches[password1]', [
            'required' => 'Ulangi password tidak boleh kosong',
            'matches' => 'Password tidak sama',
            'min_length' => 'Password minimal 3 karakter'
        ]);
    
        //jika form validasi salah
        if ($this->form_validation->run() == false) {
            $this->paggingFrontend('auth/penjual/ubah_password_penjual', $data);
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');
    
            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('akun_penjual');
    
            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="flash-data" data-ubahpassword="Password berhasil diubah"></div>');
            redirect('auth/login_penjual');
        }
    }
    


    //===============================================
    //                LOGIN UMUM
    //===============================================

    public function login_umum()
    {
        //title
        $data['title'] = 'Warma CIC | Login Umum';

        //form validation setrules
        $this->form_validation->set_rules('username', 'username', 'required', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password', 'password', 'required|min_length[3]', [
            'required' => 'Form ini tidak boleh kosong',
            'min_length'  => 'Minimal di isi dengan 3 karakter'
        ]);

        //jika validasi salah
        if ($this->form_validation->run() == false) {
            $this->paggingFrontend('auth/umum/login_umum', $data);
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $umum = $this->db->select('*')
                ->from('akun_umum')
                ->where('username', $username)
                ->or_where('email', $username)
                ->get()->row_array();

            //jika user ada
            if ($umum) {

                //cek akun aktif
                if ($umum['status_aktif'] == 1) {

                    //cek password
                    if (password_verify($password, $umum['password'])) {
                        $data = [
                            'id' => $umum['id_umum'],
                            'email' => $umum['email'],
                            'foto' => $umum['foto'],
                            'nama' => $umum['nama'],
                            'telepon' => $umum['telepon'],
                            'tipe' => $umum['tipe']
                        ];
                        // unset($umum['password_umum']);
                        $this->session->set_userdata($data);
                        $this->session->set_flashdata('message', '<div class="flash-data" data-loginsuccess="Selamat berbelanja"></div>');
                        redirect('beranda');
                    } else {
                        $this->session->set_flashdata('message', '<div class="flash-data" data-passworderror="Periksa kembali password anda"></div>');
                        redirect('auth/login_umum');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" align="center" role="alert">Akun anda tidak aktif</div>');
                    redirect('auth/login_umum');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="flash-data" data-loginadmin="Periksa kembali email atau username anda"></div>');
                redirect('auth/login_umum');
            }
        }
    }

    //buat akun umum
    public function buat_akun_umum()
    {
        //title
        $data['title'] = 'Warma CIC | Buat Akun';

        //form validation setrules
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[akun_umum.email]', [
            'required' => 'Form ini tidak boleh kosong',
            'valid_email'  => 'Email tidak valid',
            'is_unique' => 'Email sudah terdaftar'
        ]);
        $this->form_validation->set_rules('nama', 'nama', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('username', 'username', 'required|trim', [
            'required' => 'Form ini tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('telepon', 'telepon', 'required|trim|numeric|is_unique[akun_umum.telepon]', [
            'required' => 'Form ini tidak boleh kosong',
            'numeric' => 'Harus di isi dengan angka',
            'is_unique' => 'Nomor telepon sudah terdaftar'
        ]);
        $this->form_validation->set_rules('password1', 'password1', 'required|min_length[3]', [
            'required' => 'Form ini tidak boleh kosong',
            'min_length'  => 'Minimal di isi dengan 3 karakter'
        ]);

        //jika validasi salah
        if ($this->form_validation->run() == false) {
            $this->paggingFrontend('auth/umum/buat_akun_umum', $data);
        } else {
            //input ke table umum
            $this->auth_model->buatAkun_umum();
            $this->session->set_flashdata('message', '<div class="flash-data" data-registrasi="Silahkan Login"></div>');
            redirect('auth/login_umum');
        }
    }

    //logout umum
    public function logout_umum()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('foto');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('telepon');
        redirect('beranda');
    }

    //lupa password umum
    public function lupa_password_umum()
    {
        $data['title'] = 'Warma CIC | Lupa Password';

        //validasi set rules
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email', [
            'required' => 'Form ini tidak boleh kosong',
            'valid_email' => 'Email tidak valid'
        ]);

        //jika salah
        if ($this->form_validation->run() == false) {
            $this->paggingFrontend('auth/umum/lupa_password_umum', $data);
        } else {
            $email = $this->input->post('email');
            $umum = $this->db->get_where('akun_umum', ['email' => $email])->row_array();

            if ($umum) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot_umum');
                $this->session->set_flashdata('message', '<div class="flash-data" data-sendemail="Cek email untuk mereset password"></div>');
                redirect('auth/lupa_password_umum');
            } else {
                $this->session->set_flashdata('message', '<div class="flash-data" data-emailerror="Harap periksa kembali email anda"></div>');
                redirect('auth/lupa_password_umum');
            }
        }
    }

    //reset password umum
    public function reset_password_umum()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $umum = $this->db->get_where('akun_umum', ['email' => $email])->row_array();

        if ($umum) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->ubah_password_umum();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" align="center" role="alert">Token salah</div>');
                redirect('auth/lupa_password_umum');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" align="center" role="alert">Gagal mereset password</div>');
            redirect('auth/lupa_password_umum');
        }
    }

    //ubah password umum
    public function ubah_password_umum()
    {
        // cek session
        if (!$this->session->userdata('reset_email')) {
            redirect('auth/login_umum');
        }

        $data['title'] = 'Warma CIC | Ubah Password';

        //form validasi
        $this->form_validation->set_rules('password1', 'password', 'required|min_length[3]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Password di isi minimal 3 karakter'
        ]);
        $this->form_validation->set_rules('password2', 'password', 'required|min_length[3]|matches[password1]', [
            'required' => 'Ulangi password tidak boleh kosong',
            'matches' => 'Password tidak sama',
            'min_length' => 'Minimal di isi dengan 3 karakter'
        ]);

        //jika form validasi salah
        if ($this->form_validation->run() == false) {
            $this->paggingFrontend('auth/umum/ubah_password_umum', $data);
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('akun_umum');

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="flash-data" data-ubahpassword="Password berhasil diubah"></div>');
            redirect('auth/login_umum');
        }
    }
}