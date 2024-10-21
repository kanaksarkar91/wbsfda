<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CMS extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mcommon');
	}

	public function cmsPage($page)
	{
		$data = array();
		$data['cmsData'] = $this->mcommon->getRow('master_cms', array('slug' => $page));
		$data['content'] = 'frontend/cms';
		$this->load->view('frontend/layouts/index', $data);
	}
}
