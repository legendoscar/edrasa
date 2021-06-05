<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDefaultBranch()
    {
        $school = "";
        if ($this->uri->segment(4)) {
            $school = $this->uri->segment(4);
        } else {
            $school = $this->uri->segment(3);
        }
        $row = $this->db->select('branch_id')->get_where('front_cms_setting', array('url_alias' => $school))->row_array();
        if (empty($row) || $row['branch_id'] == 0) {
            $row = $this->db->where('id',1)->get('global_settings')->row_array();
            return $row['cms_default_branch'];
        } else {
            return $row['branch_id'];
        }
    }

    public function get_doctor_profile($id)
    {
        $this->db->select('staff.*,front_cms_doctor_bio.biography,staff_designation.name as designation_name,staff_department.name as department_name');
        $this->db->from('staff');
        $this->db->join('staff_designation', 'staff_designation.id = staff.designation', 'left');
        $this->db->join('staff_department', 'staff_department.id = staff.department', 'left');
        $this->db->join('front_cms_doctor_bio', 'front_cms_doctor_bio.doctor_id = staff.id', 'left');
        $this->db->join('login_credential', 'login_credential.user_id = staff.id and login_credential.role != 7', 'inner');
        $this->db->where('login_credential.role', 3);
        $this->db->where('login_credential.user_id', $id);
        return $this->db->get()->row_array();
    }

    public function get_teacher_list($start = '', $branch_id)
    {
        $this->db->select('staff.*,staff_designation.name as designation_name,staff_department.name as department_name');
        $this->db->from('staff');
        $this->db->join('login_credential', 'login_credential.user_id = staff.id and login_credential.role != 7', 'inner');
        $this->db->join('staff_designation', 'staff_designation.id = staff.designation', 'left');
        $this->db->join('staff_department', 'staff_department.id = staff.department', 'left');
        $this->db->where('login_credential.role', 3);
        $this->db->where('login_credential.active', 1);
        $this->db->where('staff.branch_id', $branch_id);
        $this->db->order_by('staff.id', 'asc');
        if ($start != '') {
            $this->db->limit(4, $start);
        }
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function get_teacher_departments($branch_id)
    {
        $this->db->select('staff_department.id as department_id,staff_department.name as department_name');
        $this->db->from('staff_department');
        $this->db->join('staff', 'staff.department = staff_department.id', 'left');
        $this->db->join('login_credential', 'login_credential.user_id = staff.id and login_credential.role != 7', 'inner');
        $this->db->where('login_credential.role', 3);
        $this->db->where('login_credential.active', 1);
        $this->db->where('staff_department.branch_id', $branch_id);
        $this->db->group_by('staff_department.id');
        $this->db->order_by('staff.id', 'asc');
        $result = $this->db->get()->result_array();
        return $result;
    }


    public function branch_list() 
    {
        $this->db->select('b.school_name,b.id');
        $this->db->from('branch as b');
        $this->db->join('front_cms_setting as f', 'f.branch_id = b.id', 'inner');
        $this->db->where('f.cms_active', 1);
        $result = $this->db->get()->result();
        $arrayData = array();
        foreach ($result as $row) {
            $arrayData[$row->id] = $row->school_name;
        }
        return $arrayData;
    }
}
