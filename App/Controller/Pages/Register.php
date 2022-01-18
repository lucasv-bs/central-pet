<?php
namespace App\Controller\Pages;

use App\Model\Entity\Organization;
use App\View\View;

class Register Extends Page {
    public static function getRegister() {
        
        $content = View::render('pages/register', [
            'title' => 'Central Pet'
        ]);

        return parent::getPage('Central Pet - Register', $content);
    }
}