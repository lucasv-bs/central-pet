<?php
namespace App\Controller\Pages;

use App\Model\Entity\Register as EntityRegister;
use App\View\View;


class Register Extends Page {
    public static function getRegister() {
        
        $content = View::render('pages/register', [
            'title' => 'Central Pet'
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