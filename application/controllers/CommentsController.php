<?php

class CommentsController extends Zend_Controller_Action
{

    private $model;

    public function init()
    {
        $this->model = new Application_Model_DbTable_Comment();
    }

    public function indexAction()
    {

    }

    public function addAction()
    {
    	$data = $this->getRequest()->getParams();
        $form = new Application_Form_Comment();

        $this->view->form = $form;
        if($this->getRequest()->isPost()){
            if($form->isValid($data)){
                if ($this->model->addComment($data))
                    $this->redirect('comments');
            }
        }
        $this->render('form');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $form = new Application_Form_Comment();
        $comment = $this->model->getCommentById($id);
		$post_id = $comment[0]['post_id'];
        $form->populate($comment[0]);
        $this->view->form = $form;

        if($this->getRequest()->isPost()){
            $data = $this->getRequest()->getPost();
            if($form->isValid($data)){
                if ($this->model->editComment($data))
                    $this->redirect('posts/show/id/'.$post_id);
            }
        }

        $this->render('form');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        if($id){
            if ($this->model->deleteComment($id))
                $this->redirect('comments');

        } else {
            $this->redirect('comments');
        }
    }

    public function postCommentsAction()
    {
		$post_id = $this->getRequest()->getParam('post');
        $this->view->comments = $this->model->listComments($post_id);

    }


}
