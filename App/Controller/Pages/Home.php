<?php
namespace App\Controller\Pages;

use App\Model\Entity\Organization;
use App\View\View;

class Home Extends Page {
    public static function getHome() {

        $content = View::render('pages/home', [
            'title' => 'Central Pet',
            'description' => 'A segunda casa do seu pet'
        ]);

        return parent::getPage('Central Pet - Home', $content);
    }
}