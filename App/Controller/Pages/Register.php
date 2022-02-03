<?php
namespace App\Controller\Pages;

use App\Controller\Alert\Status;
use App\Model\Entity\Owner;
use App\Model\Entity\Pet;
use App\Model\Entity\Register as EntityRegister;
use App\View\View;


class Register Extends Page {
    public static function getRegister($request) {
        
        $content = View::render('pages/register', [
            'title' => 'Central Pet',
            'status' => self::getStatus($request),
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

        $pet_id = EntityRegister::setNewRegister($data);
        if ( !$pet_id ) {
            echo "Falha na inserção";
        }
        
        $request->getRouter()->redirect("/register/{$pet_id}/edit?status=created");
    }


    public static function getRegisterEdit($request, $id) {
        $pet = Pet::getPetByValue($id);
        $owner = $pet->getOwner();

        if (!$pet instanceof Pet || !$owner instanceof Owner) {
            $request->getRouter()->redirect('/register');
        }

        $content = View::render('pages/register', [
            'title' => 'Central Pet',
            'status' => self::getStatus($request),
            'pet_name' => $pet->name,
            'breed' => $pet->breed,
            'pet_birth_date' => $pet->birth_date,
            'last_vaccine_date' => $pet->last_vaccine_date,
            'owner_name' => $owner->name,
            'owner_birth_date' => $owner->birth_date,
            'document_number' => $owner->document_number,
            'phone' => $owner->phone,
            'email' => $owner->email,
            'postal_code' => $owner->postal_code,
            'address' => $owner->address,
            'state' => $owner->state,
            'city' => $owner->city
        ]);

        return parent::getPage('Central Pet - Register', $content);
    }


    public static function setRegisterEdit($request, $id) {
        $data = $request->getPostVars();

        if ( !EntityRegister::setRegisterEdit($data, $id) ) {
            $request->getRouter()->redirect("/register/{$id}/edit?status=error");
        }

        $request->getRouter()->redirect("/register/{$id}/edit?status=updated");
    }


    public static function getStatus($request) {
        $queryParams = $request->getQueryParams();

        if (!isset($queryParams['status'])) return '';

        switch($queryParams['status']) {
            case 'created':
                return Status::getSuccess('Register created successfully');
                break;
            case 'updated':
                return Status::getSuccess('Register updated successfully');
                break;
            case 'deleted':
                return Status::getSuccess('Register deleted successfully');
                break;
            case 'duplicated':
                return Status::getError('Duplicated register');
                break;
            case 'error':
                return Status::getError('Failed to save record');
                break;
        }
    }
}