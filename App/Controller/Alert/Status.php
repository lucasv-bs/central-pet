<?php
namespace App\Controller\Alert;

use App\View\View;

class Status {
    public static function getError($message) {
        return View::render('alert/status', [
            'type' => 'danger',
            'message' => $message
        ]);
    }


    public static function getSuccess($message) {
        return View::render('alert/status', [
            'type' => 'success',
            'message' => $message
        ]);
    }
}