<?php
/**
 * Created by PhpStorm.
 * User: rida.n
 * Date: 4/1/2019
 * Time: 10:56 AM
 */

class Posts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->model('Post_model');
        $this->load->model('Category_model');
        $this->load->model('Comment_model');
        $this->load->library('upload');
    }
    public function index(){
        $data['title'] = 'Latest Posts';

        $data['posts'] = $this->Post_model->get_posts();

        $this->load->view('templates/header');
        $this->load->view('posts/index',$data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL){
        $data['post'] = $this->Post_model->get_posts($slug);
        $post_id = $data['post']['fld_post_id'];
        $data['comments'] = $this->Comment_model->get_comments($post_id);

        if(empty($data['post'])){
            show_404();
        }
        $data['title'] = $data['post']['fld_title'];

        $this->load->view('templates/header');
        $this->load->view('posts/view',$data);
        $this->load->view('templates/footer');
    }

    public function create(){
        $data['title'] = 'Create Post';

        $data['categories'] = $this->Category_model->get_categories();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('body', 'Body', 'required');

        if($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('posts/create', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $config['upload_path'] = '.\assets\images\posts';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '2048';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->upload->initialize($config);



            if (!$this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());
                $post_image = 'noimage.jpg';
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                $post_image = $_FILES['userfile']['name'];
            }

            $this->Post_model->create_post($post_image);
            //Set Message
            $this->session->set_flashdata('post_created','Your post created successfully');
            redirect('posts/');
        }
    }
    public function delete($id){
        $this->Post_model->delete_post($id);
        //Set Message
        $this->session->set_flashdata('post_deleted','Your post deleted successfully');
        redirect('posts/');
    }

    public function edit($slug){
        $data['post'] = $this->Post_model->get_posts($slug);
        $data['categories'] = $this->Category_model->get_categories();
        if(empty($data['post'])){
            show_404();
        }
        $data['title'] = 'Edit Post';

        $this->load->view('templates/header');
        $this->load->view('posts/edit',$data);
        $this->load->view('templates/footer');
    }

    public function update(){
        $data['post'] = $this->Post_model->update_post();
        //Set Message
        $this->session->set_flashdata('post_updated','Your post updated successfully');
        redirect('posts/');
    }
}