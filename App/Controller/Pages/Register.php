<?php
namespace App\Controller\Pages;

use App\Model\Entity\Register as EntityRegister;
use App\View\View;


class Register Extends Page {
    public static function getRegister() {
        
        $content = View::render('pages/register', [
            'title' => 'Central Pet',
            'pet_name' => '',
            'breed' => '',
            'birth_date' => '',
            'last_vaccine_date' => '',
            'owner_name' => '',
            'owner_birth_date' => '',
            'document_number' => '',
            'phone' => '',
            'email' => '',
            'postal_code' => '',
            'address' => '',
            'state' => '',
            'city' => ''
        ]);

        return parent::getPage('Central Pet - Register', $content);
    }
    

    public static function setNewRegister($request) {
        $data = $request->getPostVars();

        if ( !EntityRegister::setNewRegister($data) ) {
            echo "Falha na inserção";
        }
        else {
            echo "Registro inserido com sucesso";
        }
    }
}