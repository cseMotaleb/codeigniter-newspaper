<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

    var $data = array();

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/login_model');
        $this->data['widget'] = $this->recaptcha->getWidget();
        $this->data['script'] = $this->recaptcha->getScriptTag();
    }

    public function index()
    {
        if ($this->session->userdata('id')) redirect(site_url('admin/cms'));

        $this->data['error'] = '';

        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $recaptcha = $this->input->post('g-recaptcha-response');
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if (ENVIRONMENT != 'production') {
                $response['success'] = true;
            }

            if (isset($response['success']) and $response['success'] === true) {
                $this->data['status'] = $this->login_model->check_user();

                if ($this->data['status'] !== TRUE) {
                    $this->data['error'] = '<div class="msgbar msg_Alert hide_onC"><span class="iconsweet">!</span><p>User Name / Password Error.</p></div>';
                } else {
                    redirect(site_url("admin/cms"));
                    return;
                }
            } else $this->data['error'] = '<div class="alert alert-danger fade in alert-dismissable"><button class="close" data-dismiss="alert" type="button">&times;</button><strong>Error! </strong>Google Recaptcha Response Error, Please try again.</div>';
        } else {
            if (validation_errors()) $this->data['error'] = '<div class="msgbar msg_Alert hide_onC"><span class="iconsweet">! </span>' . validation_errors() . '</div>';
        }

        $this->load->view('admin/login', $this->data);
    }

    public function logout()
    {
        $this->login_model->logout();
    }
}