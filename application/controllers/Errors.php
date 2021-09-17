<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @package : Losin School Management System
 * @version : 1.0.0
 * @developed by : LosinSMS
 * @support : dev@losinsms.com
 * @author url : https://losinsms.com
 * @filename : Accounting.php
 * @copyright : Reserved LosinSMS Team
 */

class Errors extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('errors/error_404_message.php');
    }
}
