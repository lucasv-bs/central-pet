<?php
namespace App\Controller\Pages;

use App\Model\Entity\Organization;
use App\View\View;

class Home Extends Page {
    public static function getHome() {

        $obOrganization = new Organization;

        $content = View::render('pages/home', [
            'title' => $obOrganization->title,
            'description' => $obOrganization->description
        ]);

        return parent::getPage('Central Pet - Home', $content);
    }
}