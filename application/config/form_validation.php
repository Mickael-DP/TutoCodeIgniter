<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'site/contact' => array(
        array(
            'field' => 'name',
            'label' => 'Nom',
            'rules' => 'required'
        ), 
        array(
            'field' => 'email',
            'label' => 'E-mail',
            'rules' => array('valid_email', 'required')
        ), 
        array(
            'field' => 'title',
            'label' => 'Titre',
            'rules' => 'required'
        ), 
        array(
            'field' => 'message',
            'label' => 'Message',
            'rules' => 'required'
        )
    )
);
