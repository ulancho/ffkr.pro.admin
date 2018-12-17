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
        $config['max_size'] = 1000;
        $config['max_width'] = 1000;
        $config['max_height'] = 1000;
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

        $this->form_validation->set_rules('name', 'First Name', 'required|trim|max_length[60]',
            array('required' => 'Заполните название.',
                'max_length' => 'Должно содержать не больше 60 символов.'
            )
        );
        $this->form_validation->set_rules('price', 'Last Name', 'required|trim',
            array('required' => 'Заполните цену.')
        );

        $this->form_validation->set_rules('text', 'role', 'required|trim|max_length[220]',
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
            $location = 'sport-pit';
            $imgname = 'photo';
            $ph = $this->do_upload($location, $imgname);
            if (isset($ph['upload_data'])) {
                $array['imgname'] = $ph['upload_data']['file_name'];
                if (!$this->AdminModels->addpit($array)) {
                    $this->session->set_flashdata('flash_message', 'Не удалось добавить данные!');
                } else {
                    $this->session->set_flashdata('success_message', 'Данные успешно добавлены.');
                }
                redirect(site_url() . 'admin/MainSections/addSportpit');

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
        $config['base_url'] = base_url() . 'admin/MainSections/allsportpit/';
        $config['total_rows'] = $this->db->count_all('spo');
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<p class="pag">';
        $config['full_tag_close'] = '</p>';
        $this->pagination->initialize($config);
        $table = 'spo';
        $data['sportpits'] = $this->AdminModels->selectAll($table, $config['per_page'], $this->uri->segment(4));

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
        $puth = 'sport-pit';
        $result = $this->AdminModels->deleteOne($table, $id,$puth);
        if ($result == FALSE) {
            $this->session->set_flashdata('flash_message', 'Упс! Произошла ошибка');
        } else {
            $this->session->set_flashdata('success_message', 'Успешно удален!');

        }
        redirect(site_url() . 'admin/MainSections/allsportpit');
    }

    // для загрузки станички  редактирования
    public function updateSp($id)
    {
        if ($id) {
            $table = 'spo';
            $data['sportpit'] = $this->AdminModels->getId($table, $id);
            $data['imgerror'] = '';
            if ($data['sportpit'] != false) {
                $this->load->view('admin/header');
                $this->load->view('admin/navbar');
                $this->load->view('admin/container');
                $this->load->view('admin/updateSportPit', $data);
                $this->load->view('admin/footer');
            } else {
                redirect(site_url() . 'admin/mainAdmin/');
            }

        } else {
            redirect(site_url() . 'admin/mainAdmin/');
        }

    }

    // для редактирования спортивного питание
    public function updateSportpit()
    {
        $this->form_validation->set_rules('name', 'First Name', 'required|trim|max_length[60]',
            array('required' => 'Заполните название.',
                'max_length' => 'Должно содержать не больше 60 символов.'
            )
        );
        $this->form_validation->set_rules('price', 'Last Name', 'required|trim',
            array('required' => 'Заполните цену.')
        );

        $this->form_validation->set_rules('text', 'role', 'required|trim|max_length[220]',
            array('required' => 'Заполните.',
                'max_length' => 'Должно содержать не больше 220 символов.'
            )
        );

        $id = $this->input->post('id');
        $table = 'spo';
        $data['sportpit'] = $this->AdminModels->getId($table, $id);
        if ($this->form_validation->run() == FALSE) {
            $data['imgerror'] = '';
            $this->load->view('admin/header');
            $this->load->view('admin/navbar', $data);
            $this->load->view('admin/container');
            $this->load->view('admin/updateSportPit');
            $this->load->view('admin/footer');
        } else {
            $array['id'] = $id;
            $array['name'] = $this->input->post('name');
            $array['price'] = $this->input->post('price');
            $array['text'] = $this->input->post('text');
            $array['section'] = $this->input->post('section');
            $location = 'sport-pit';
            $imgname = 'photo';
            $img = $_FILES['photo'];
            $photoname = $img['name'];
            if (empty($photoname)) {

            } else {
                $ph = $this->do_upload($location, $imgname);
                $array['imgname'] = $ph['upload_data']['file_name'];
                $table = 'spo';
                $result = $this->AdminModels->getId($table, $id);
                if ($result != false) {
                    $namefile = $result->imgname;
                    $file = 'sportpit';
                    $this->deleteFiles($file, $namefile);
                }
            }

            if (!$this->AdminModels->updatepit($array)) {
                $this->session->set_flashdata('flash_message', 'Не удалось обновить данные!');
            } else {
                $this->session->set_flashdata('success_message', 'Данные успешно обновлены.');
            }
            redirect(site_url() . 'admin/MainSections/updateSp/' . $id);

        }
    }

    // для загрузки всех спорт оборудований
    public function allsporteq()
    {
        $config['base_url'] = base_url() . 'admin/MainSections/allsporteq/';
        $config['total_rows'] = $this->db->count_all('equipment');
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<p class="pag">';
        $config['full_tag_close'] = '</p>';
        $this->pagination->initialize($config);
        $table = 'equipment';
        $data['sportpits'] = $this->AdminModels->selectAll($table, $config['per_page'], $this->uri->segment(4));

        $this->load->view('admin/header');
        $this->load->view('admin/navbar');
        $this->load->view('admin/container');
        $this->load->view('admin/allsporteq', $data);
        $this->load->view('admin/footer');
    }

    // для загрузки станички  редактирования
    public function updateEq($id)
    {
        if ($id) {
            $table = 'equipment';
            $data['sportpit'] = $this->AdminModels->getId($table, $id);
            $data['imgerror'] = '';
            if ($data['sportpit'] != false) {
                $this->load->view('admin/header');
                $this->load->view('admin/navbar');
                $this->load->view('admin/container');
                $this->load->view('admin/updateEq', $data);
                $this->load->view('admin/footer');
            } else {
                redirect(site_url() . 'admin/mainAdmin/');
            }

        } else {
            redirect(site_url() . 'admin/mainAdmin/');
        }

    }

    // для редактирования спортивного питание
    public function updatefunctionEq()
    {


        $this->form_validation->set_rules('name', 'First Name', 'required|trim|max_length[60]',
            array('required' => 'Заполните название.',
                'max_length' => 'Должно содержать не больше 60 символов.'
            )
        );
        $this->form_validation->set_rules('price', 'Last Name', 'required|trim',
            array('required' => 'Заполните цену.')
        );

        $this->form_validation->set_rules('text', 'role', 'required|trim|max_length[220]',
            array('required' => 'Заполните.',
                'max_length' => 'Должно содержать не больше 220 символов.'
            )
        );

        $id = $this->input->post('id');
        $table = 'equipment';
        $data['sportpit'] = $this->AdminModels->getId($table, $id);
        if ($this->form_validation->run() == FALSE) {
            $data['imgerror'] = '';
            $this->load->view('admin/header');
            $this->load->view('admin/navbar', $data);
            $this->load->view('admin/container');
            $this->load->view('admin/updateEq');
            $this->load->view('admin/footer');
        } else {
            $array['id'] = $id;
            $array['name'] = $this->input->post('name');
            $array['price'] = $this->input->post('price');
            $array['text'] = $this->input->post('text');
            $array['phone'] = $this->input->post('phone');
            $location = 'equipment';
            $imgname = 'photo';
            $img = $_FILES['photo'];
            $photoname = $img['name'];
            if (empty($photoname)) {

            } else {
                $ph = $this->do_upload($location, $imgname);
                $array['imgname'] = $ph['upload_data']['file_name'];
                $table = 'spo';
                $result = $this->AdminModels->getId($table, $id);
                if ($result != false) {
                    $namefile = $result->imgname;
                    $file = 'sporteq';
                    $this->deleteFiles($file, $namefile);
                }
            }

            if (!$this->AdminModels->updateEquipment($array)) {
                $this->session->set_flashdata('flash_message', 'Не удалось обновить данные!');
            } else {
                $this->session->set_flashdata('success_message', 'Данные успешно обновлены.');
            }
            redirect(site_url() . 'admin/MainSections/updateEq/' . $id);

        }
    }
    // для удаление спорт оборудование
    public function deleteEq($id){
            $table = 'equipment';
            $puth = 'equipment';
            $result = $this->AdminModels->deleteOne($table, $id,$puth);
            if ($result == FALSE) {
                $this->session->set_flashdata('flash_message', 'Упс! Произошла ошибка');
            } else {
                $this->session->set_flashdata('success_message', 'Успешно удален!');
            }
            redirect(site_url() . 'admin/MainSections/allsporteq');

    }
    // для добавление спортивного оборудование
    public function addEq(){
        $array['name'] = $this->input->post('name');
        $array['price'] = $this->input->post('price');
        $array['text'] = $this->input->post('text');
        $array['number_phone'] = $this->input->post('number_phone');
        if (!isset($array['name']) && !isset($array['price']) && !isset($array['text']) && !isset($array['number_phone'])){
            $array['imgerror'] = '';
            $this->load->view('admin/header');
            $this->load->view('admin/navbar', $array);
            $this->load->view('admin/addEq');
            $this->load->view('admin/footer');
        }
        else{
            $this->form_validation->set_rules('name', 'First Name', 'required|trim|max_length[60]',
                array('required' => 'Заполните название.',
                    'max_length' => 'Должно содержать не больше 60 символов.'
                )
            );
            $this->form_validation->set_rules('price', 'Last Name', 'required|trim',
                array('required' => 'Заполните цену.')
            );

            $this->form_validation->set_rules('text', 'role', 'required|trim|max_length[220]',
                array('required' => 'Заполните.',
                    'max_length' => 'Должно содержать не больше 220 символов.'
                )
            );
            $this->form_validation->set_rules('number_phone', 'role', 'required|trim',
                array('required' => 'Заполните.'
                )
            );

            if ($this->form_validation->run() == FALSE) {
                $array['imgerror'] = '';
                $this->load->view('admin/header');
                $this->load->view('admin/navbar', $array);
                $this->load->view('admin/container');
                $this->load->view('admin/addEq');
                $this->load->view('admin/footer');
            } else {
                $location = 'equipment';
                $imgname = 'photo';
                $ph = $this->do_upload($location, $imgname);
                if (isset($ph['upload_data'])) {
                    $array['imgname'] = $ph['upload_data']['file_name'];
                    if (!$this->AdminModels->addEq($array)) {
                        $this->session->set_flashdata('flash_message', 'Не удалось добавить данные!');
                    } else {
                        $this->session->set_flashdata('success_message', 'Данные успешно добавлены.');
                    }
                    redirect(site_url() . 'admin/MainSections/addEq');

                } else {
                    $array['imgerror'] = $ph['error'];
                    $this->load->view('admin/header');
                    $this->load->view('admin/navbar', $array);
                    $this->load->view('admin/container');
                    $this->load->view('admin/addEq');
                    $this->load->view('admin/footer');
                }

            }


        }


    }

    public function test(){
        $file = 'sport-pit';
        $imgname = 'c5cf9f304da24ce5689472793cae6b7e.jpg';
       $n =  unlink(FCPATH."public/images/$file/".$imgname);
        print_r($n);
        die();
    }

}