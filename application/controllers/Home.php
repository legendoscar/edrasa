<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helpers('custom_fields');
        $this->load->model('email_model');
        $this->load->model('testimonial_model');
    }

    public function index()
    {
        $this->home();
    }

    public function home()
    {
        $branchID = $this->home_model->getDefaultBranch();
        $this->data['branchID'] = $branchID;
        $this->data['page_data'] = $this->home_model->get('front_cms_home_seo', array('branch_id' => $branchID), true);
        $this->data['main_contents'] = $this->load->view('home/index', $this->data, true);
        $this->load->view('home/layout/index', $this->data);
    }

    public function about()
    {
        $branchID = $this->home_model->getDefaultBranch();
        $this->data['branchID'] = $branchID;
        $this->data['page_data'] = $this->home_model->get('front_cms_about', array('branch_id' => $branchID), true);
        $this->data['main_contents'] = $this->load->view('home/about', $this->data, true);
        $this->load->view('home/layout/index', $this->data);
    }

    public function faq()
    {
        $branchID = $this->home_model->getDefaultBranch();
        $this->data['branchID'] = $branchID;
        $this->data['page_data'] = $this->home_model->get('front_cms_faq', array('branch_id' => $branchID), true);
        $this->data['main_contents'] = $this->load->view('home/faq', $this->data, true);
        $this->load->view('home/layout/index', $this->data);
    }

    public function events()
    {
        $branchID = $this->home_model->getDefaultBranch();
        $this->data['branchID'] = $branchID;
        $this->data['page_data'] = $this->home_model->get('front_cms_events', array('branch_id' => $branchID), true);
        $this->data['main_contents'] = $this->load->view('home/events', $this->data, true);
        $this->load->view('home/layout/index', $this->data);
    }

    public function event_view($id)
    {
        $branchID = $this->home_model->getDefaultBranch();
        $this->data['branchID'] = $branchID;
        $this->data['event'] = $this->home_model->get('event', array('id' => $id, 'branch_id' => $branchID, 'status' => 1, 'show_web' => 1), true);
        $this->data['page_data'] = $this->home_model->get('front_cms_events', array('branch_id' => $branchID), true);
        $this->data['main_contents'] = $this->load->view('home/event_view', $this->data, true);
        $this->load->view('home/layout/index', $this->data);
    }

    public function teachers()
    {
        $branchID = $this->home_model->getDefaultBranch();
        $this->data['branchID'] = $branchID;
        $this->data['page_data'] = $this->home_model->get('front_cms_teachers', array('branch_id' => $branchID), true);
        $this->data['departments'] = $this->home_model->get_teacher_departments($branchID);
        $this->data['doctor_list'] = $this->home_model->get_teacher_list("", $branchID);
        $this->data['main_contents'] = $this->load->view('home/teachers', $this->data, true);
        $this->load->view('home/layout/index', $this->data);
    }

    public function admission()
    {
        if (!$this->data['cms_setting']['online_admission']) {
            redirect(site_url('home'));
        }
        $branchID = $this->home_model->getDefaultBranch();
        $captcha = $this->data['cms_setting']['captcha_status'];
        if ($captcha == 'enable') {
            $this->load->library('recaptcha');
            $this->data['recaptcha'] = array(
                'widget' => $this->recaptcha->getWidget(),
                'script' => $this->recaptcha->getScriptTag(),
            );
        }
        if ($_POST) {
            $this->form_validation->set_rules('class_id', translate('class'), 'trim|required');
            $this->form_validation->set_rules('section_id', translate('section'), 'trim|required');
            $this->form_validation->set_rules('first_name', translate('first_name'), 'trim|required');
            $this->form_validation->set_rules('last_name', translate('last_name'), 'trim|required');
            $this->form_validation->set_rules('gender', translate('gender'), 'trim|required');
            $this->form_validation->set_rules('birthday', translate('birthday'), 'trim|required');
            $this->form_validation->set_rules('mobile_no', translate('mobile_no'), 'trim|required|numeric');
            $this->form_validation->set_rules('address', translate('address'), 'trim|required');
            $this->form_validation->set_rules('guardian_name', translate('guardian_name'), 'trim|required');
            $this->form_validation->set_rules('grd_occupation', translate('occupation'), 'trim|required');
            $this->form_validation->set_rules('guardian_relation', translate('guardian_relation'), 'trim|required');
            $this->form_validation->set_rules('grd_mobile_no', translate('guardian') . " " . translate('mobile_no'), 'trim|required|numeric');
            $this->form_validation->set_rules('grd_address', translate('guardian') . " " . translate('address'), 'trim|required');
            if ($captcha == 'enable') {
                $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'trim|required');
            }
            // custom fields validation rules
            $customFields = getCustomFields('online_admission', $branchID);
            foreach ($customFields as $fields_key => $fields_value) {
                if ($fields_value['required']) {
                    $fieldsID = $fields_value['id'];
                    $fieldLabel = $fields_value['field_label'];
                    $this->form_validation->set_rules("custom_fields[online_admission][" . $fieldsID . "]", $fieldLabel, 'trim|required');
                }
            }

            if ($this->form_validation->run() == true) {
                $arrayData = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'gender' => $this->input->post('gender'),
                    'birthday' => date("Y-m-d", strtotime($this->input->post('birthday'))),
                    'mobile_no' => $this->input->post('mobile_no'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('address'),
                    'guardian_name' => $this->input->post('guardian_name'),
                    'guardian_relation' => $this->input->post('guardian_relation'),
                    'father_name' => $this->input->post('father_name'),
                    'mother_name' => $this->input->post('mother_name'),
                    'grd_occupation' => $this->input->post('grd_occupation'),
                    'grd_income' => $this->input->post('grd_income'),
                    'grd_education' => $this->input->post('grd_education'),
                    'grd_email' => $this->input->post('grd_email'),
                    'grd_mobile_no' => $this->input->post('grd_mobile_no'),
                    'grd_address' => $this->input->post('grd_address'),
                    'status' => 1,
                    'branch_id' => $branchID,
                    'class_id' => $this->input->post('class_id'),
                    'section_id' => $this->input->post('section_id'),
                    'apply_date' => date("Y-m-d H:i:s"),
                );
                $this->db->insert('online_admission', $arrayData);
                $studentID = $this->db->insert_id();

                // handle custom fields data
                $class_slug = 'online_admission';
                $customField = $this->input->post("custom_fields[$class_slug]");
                if (!empty($customField)) {
                    saveCustomFields($customField, $studentID);
                }

                $success = 'Appointment requested successfully. You can track your requests status at Login to your account.';
                $this->session->set_flashdata('success', $success);
                $array = array('status' => 'success');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }

        $this->data['branchID'] = $branchID;
        $this->data['page_data'] = $this->home_model->get('front_cms_admission', array('branch_id' => $branchID), true);
        $this->data['main_contents'] = $this->load->view('home/admission', $this->data, true);
        $this->load->view('home/layout/index', $this->data);
    }

    public function contact()
    {
        $branchID = $this->home_model->getDefaultBranch();
        $captcha = $this->data['cms_setting']['captcha_status'];
        if ($captcha == 'enable') {
            $this->load->library('recaptcha');
            $this->data['recaptcha'] = array(
                'widget' => $this->recaptcha->getWidget(),
                'script' => $this->recaptcha->getScriptTag(),
            );
        }

        if ($_POST) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('phoneno', 'Phone', 'trim|required');
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
            if ($captcha == 'enable') {
                $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'trim|required');
            }
            if ($this->form_validation->run() !== false) {
                if ($captcha == 'enable') {
                    $captchaResponse = $this->recaptcha->verifyResponse($this->input->post('g-recaptcha-response'));
                } else {
                    $captchaResponse = array('success' => true);
                }
                if ($captchaResponse['success'] == true) {
                    $name = $this->input->post('name');
                    $email = $this->input->post('email');
                    $phoneno = $this->input->post('phoneno');
                    $subject = $this->input->post('subject');
                    $message = $this->input->post('message');
                    $msg = '<h3>Sender Information</h3>';
                    $msg .= '<br><br><b>Name: </b> ' . $name;
                    $msg .= '<br><br><b>Email: </b> ' . $email;
                    $msg .= '<br><br><b>Phone: </b> ' . $phoneno;
                    $msg .= '<br><br><b>Subject: </b> ' . $subject;
                    $msg .= '<br><br><b>Message: </b> ' . $message;
                    $emailsetting = $this->db->get_where('email_config', array('branch_id' => $branchID))->row();
                    if ($emailsetting->email_protocol == 'smtp') {
                        $config = array(
                            'smtp_host' => $emailsetting->smtp_host,
                            'smtp_port' => $emailsetting->smtp_port,
                            'smtp_user' => $emailsetting->smtp_user,
                            'smtp_pass' => $emailsetting->smtp_pass,
                            'smtp_crypto' => $emailsetting->smtp_encryption,
                        );
                    }
                    $config['protocol'] = $emailsetting->email_protocol;
                    $config['mailtype'] = "html";
                    $config['newline'] = "\r\n";
                    $config['charset'] = 'utf-8';
                    $this->load->library('email', $config);
                    $this->email->from($emailsetting->email);
                    $this->email->to($this->data['cms_setting']['receive_contact_email']);
                    $this->email->reply_to($email, $name);
                    $this->email->subject('Contact Form Email');
                    $this->email->message($msg);
                    if ($this->email->send()) {
                        $this->session->set_flashdata('msg_success', 'Message Successfully Sent. We will contact you shortly.');
                    } else {
                        $this->session->set_flashdata('msg_error', $this->email->print_debugger());
                    }
                } else {
                    $error = 'Captcha is invalid';
                    $this->session->set_flashdata('error', $error);
                }
                redirect(base_url('home/contact'));
            }
        }
        $this->data['page_data'] = $this->home_model->get('front_cms_contact', array('branch_id' => $branchID), true);
        $this->data['main_contents'] = $this->load->view('home/contact', $this->data, true);
        $this->load->view('home/layout/index', $this->data);
    }

    public function page()
    {
        $url = $this->uri->segment(3);
        $this->db->select('front_cms_menu.title as menu_title,front_cms_menu.alias,front_cms_pages.*');
        $this->db->from('front_cms_menu');
        $this->db->join('front_cms_pages', 'front_cms_pages.menu_id = front_cms_menu.id', 'inner');
        $this->db->where('front_cms_menu.alias', $url);
        $this->db->where('front_cms_menu.publish', 1);
        $getData = $this->db->get()->row_array();
        if (empty($getData)) {
            redirect('404_override');
        }
        $this->data['page_data'] = $getData;
        $this->data['active_menu'] = 'page';
        $this->data['main_contents'] = $this->load->view('home/page', $this->data, true);
        $this->load->view('home/layout/index', $this->data);
    }

    public function getSectionByClass()
    {
        $html = "";
        $classID = $this->input->post("class_id");
        if (!empty($classID)) {
            $result = $this->db->select('sections_allocation.section_id,section.name')
                ->from('sections_allocation')
                ->join('section', 'section.id = sections_allocation.section_id', 'left')
                ->where('sections_allocation.class_id', $classID)
                ->get()->result_array();
            if (is_array($result) && count($result)) {
                $html .= '<option value="">' . translate('select') . '</option>';
                foreach ($result as $row) {
                    $html .= '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
                }
            } else {
                $html .= '<option value="">' . translate('no_selection_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('select_class_first') . '</option>';
        }
        echo $html;
    }

    public function get_branch_url()
    {
        $branch_id = $this->input->post("branch_id");
        $url = $this->db->where('branch_id', $branch_id)->get('front_cms_setting')->row_array();
        $school = "";
        if ($this->uri->segment(4)) {
            $school = $this->uri->segment(4);
        } else {
            $school = $this->uri->segment(3);
        }
        echo json_encode(array('url_alias' => base_url("home/index/" . $url['url_alias'])));
    }
}
