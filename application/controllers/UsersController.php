<?php

class UsersController extends Zend_Controller_Action
{
    private $model;

    public function init()
    {
        $this->model = new Application_Model_DbTable_User();
    }

    public function indexAction()
    {
		$this->view->title = 'Users';
        $this->view->users = $this->model->listUsers();
    }

    public function addAction()
    {
    	$data = $this->getRequest()->getParams();
        $form = new Application_Form_User();
        $form->email->addValidator(new Zend_Validate_Db_NoRecordExists(
            array(
              'table' => 'user',
              'field' => 'email'
            )
        ));
        $this->view->form = $form;
        if($this->getRequest()->isPost()){
            if($form->isValid($data)){
                if ($this->model->addUser($data))
                    $this->redirect('users');
            }
        }
		$this->view->title = 'Add User';
        $this->render('form');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $form = new Application_Form_User();

        $user = $this->model->getUserById($id);
        $form->populate($user[0]);
        $this->view->form = $form;

        if($this->getRequest()->isPost()){
            $data = $this->getRequest()->getPost();
            if($form->isValid($data)){
                if ($this->model->editUser($data))
                    $this->redirect('users');
            }
        }
		$this->view->title = 'Edit User';
        $this->render('form');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        if($id){
            if ($this->model->deleteUser($id))
                $this->redirect('users');

        } else {
            $this->redirect('users');
        }
    }

}
