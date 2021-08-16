<?php

class Template
{
    protected $_ci;

    
    function layout($content, $data = NULL)
    {
        $data['header']     = $this->_ci->load->view('template/header', $data, true);
        $data['sidebar']     = $this->_ci->load->view('template/sidebar', $data, true);
        $data['footer']     = $this->_ci->load->view('template/footer', $data, true);
        $data['content']     = $this->_ci->load->view($content, $data, true);

        $this->_ci->load->view('template/index', $data);
    }
}
