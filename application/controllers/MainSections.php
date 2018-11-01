<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainSections extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModels');
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $arraydata = $this->session->userdata['login'];
        if (empty($arraydata)) {
            redirect(site_url() . 'mainAdmin/');
        }
    }

//  Грузит страничку добавление спорт питания
    public function sportpit()
    {
        $array['imgerror'] = '';
        $this->load->view('admin/header');
        $this->load->view('admin/navbar', $array);
        $this->load->view('admin/addSportpit');
        $this->load->view('admin/footer');
    }

// для загрузки фото
    public function do_upload($location, $name)
    {
        $config['upload_path'] = './public/images/' . $location . '/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = 500;
        $config['max_width'] = 700;
        $config['max_height'] = 700;
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($name)) {
            return array('error' => $this->upload->display_errors());
        } else {
            return array('upload_data' => $this->upload->data());
        }
    }

//  для добавления в бд.
    public function addSportpit()
    {

        $this->form_validation->set_rules('name', 'First Name', 'required|max_length[60]',
            array('required' => 'Заполните название.',
                'max_length' => 'Должно содержать не больше 60 символов.'
            )
        );
        $this->form_validation->set_rules('price', 'Last Name', 'required',
            array('required' => 'Заполните цену.')
        );

        $this->form_validation->set_rules('text', 'role', 'required|max_length[220]',
            array('required' => 'Заполните.',
                'max_length' => 'Должно содержать не больше 220 символов.'
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $array['imgerror'] = '';
            $this->load->view('admin/header');
            $this->load->view('admin/navbar', $array);
            $this->load->view('admin/container');
            $this->load->view('admin/addSportpit');
            $this->load->view('admin/footer');
        } else {
            $array['name'] = $this->input->post('name');
            $array['price'] = $this->input->post('price');
            $array['text'] = $this->input->post('text');
            $array['section'] = $this->input->post('section');
            $location = 'sportpit';
            $imgname = 'photo';
            $ph = $this->do_upload($location, $imgname);
            if (isset($ph['upload_data'])) {
                $array['imgname'] = $ph['upload_data']['file_name'];
                if (!$this->AdminModels->addpit($array)) {
                    $this->session->set_flashdata('flash_message', 'Не удалось добавить данные!');
                } else {
                    $this->session->set_flashdata('success_message', 'Данные успешно добавлены.');
                }
                redirect(site_url() . 'MainSections/addSportpit');

            } else {
                $array['imgerror'] = $ph['error'];
                $this->load->view('admin/header');
                $this->load->view('admin/navbar', $array);
                $this->load->view('admin/container');
                $this->load->view('admin/addSportpit');
                $this->load->view('admin/footer');
            }

        }


    }

// для загрузки всех спорт питаний
    public function allsportpit()
    {
        $config['base_url'] = base_url() . 'MainSections/allsportpit/';
        $config['total_rows'] = $this->db->count_all('spo');
        $config['per_page'] = 1;
        $config['full_tag_open'] = '<p class="pag">';
        $config['full_tag_close'] = '</p>';
        $this->pagination->initialize($config);
        $table = 'spo';
        $data['sportpits'] = $this->AdminModels->selectAll($table, $config['per_page'], $this->uri->segment(3));

        $this->load->view('admin/header');
        $this->load->view('admin/navbar');
        $this->load->view('admin/container');
        $this->load->view('admin/allsportpit', $data);
        $this->load->view('admin/footer');
    }

// для удаление одного спорт питания
    public function deletesportpit($id)
    {
        $table = 'spo';
        $result = $this->AdminModels->deleteOne($table, $id);
        if ($result == FALSE){
            $this->session->set_flashdata('flash_message', 'Упс! Произошла ошибка');
        }
        else{
            $this->session->set_flashdata('success_message', 'Успешно удален!');
        }
        redirect(site_url() . 'MainSections/allsportpit');
    }

    public function updateSp($id){
        echo $id;
        $this->load->view('admin/header');
        $this->load->view('admin/navbar');
        $this->load->view('admin/container');
        $this->load->view('admin/updateSportPit');
        $this->load->view('admin/footer');
    }


}