<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matrix extends MX_Controller {
    
	public function index()
	{
        // load datamodel
        $this->load->model('sales_model');
        // defining period
        $period_start = '20160601';
        $period_end = '20160630';
        $item_list = $this->sales_model->get_item_in_period($period_start,$period_end);
        $date_list = $this->sales_model->get_date_in_period($period_start,$period_end);
        // get data for matrix
        $matrix = array();
        foreach($item_list->result_array() as $item)
        {
            $sku = $item['SKU'];
            $matrix[$sku] = $this->sales_model->get_data($period_start,$period_end,$sku);
        }
        // get item in periode
        $data = array();
        $data['item']['list'] = $item_list;
        $data['item']['matrix'] = $matrix;
        $data['date']['list'] = $date_list;
        $this->load->view('matrix_table',$data);
	}
}
