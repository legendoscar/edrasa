<?php

use Alpha\Console\Console;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function hash($password)
	{
		return hash("sha512", $password . config_item("encryption_key"));
	}

	public function uploadImage($role)
	{
		$return_photo = 'defualt.png';
		$old_user_photo = $this->input->post('old_user_photo');
		if (isset($_FILES["user_photo"]) && !empty($_FILES['user_photo']['name'])) {

			Console::log('b4');
			$config = [];
			$config['allowed_types'] = '*';

			$this->upload->initialize($config);
			$file_name = $this->upload->do_upload_cloudinary('user_photo');

			Console::log($file_name);
			if ($file_name) {
				$return_photo = $file_name;
			}
		} else {
			if (!empty($old_user_photo)) {
				$return_photo = $old_user_photo;
			}
		}
		return $return_photo;
	}

	public function get($table, $where_array = NULL, $single = false, $branch = false, $columns = '*')
	{
		$this->db->select($columns);
		if (is_array($where_array)) {
			$this->db->where($where_array);
		}
		if ($branch == true) {
			if (!is_superadmin_loggedin()) {
				$this->CI->db->where("branch_id", get_loggedin_branch_id());
			}
		}
		if ($single == true) {
			$method = 'row_array';
		} else {
			$method = 'result_array';
			$this->db->order_by('id', 'ASC');
		}
		$result = $this->db->get($table)->$method();
		return $result;
	}

	public function getSingle($table, $id = NULL, $single = false)
	{
		if ($single == true) {
			$method = 'row';
		} else {
			$method = 'result';
		}
		$q = $this->db->query("SELECT * FROM " . $table . " WHERE id = " . $this->db->escape($id));
		return $q->$method();
	}
}
