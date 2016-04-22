<?php

class PostsController extends Zend_Controller_Action
{

    private $model = null;
	private $userModel = null;
    private $commentModel = null;

    public function init()
    {
        $this->model = new Application_Model_DbTable_Post();
        $this->userModel = new Application_Model_DbTable_User();
        $this->commentModel = new Application_Model_DbTable_Comment();
    }

    public function indexAction()
    {
		$this->view->title = 'Posts';
        $posts = $this->model->listPosts();
		for($i=0; $i< count($posts); $i++) {
			$posts[$i]['comments'] = $this->commentModel->countPostComments($posts[$i]['id']);
		}
		$this->view->posts = $posts;
    }

    public function addAction()
    {
        $form = new Application_Form_Post();

        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getParams();
            if ($form->isValid($data)) {
                if ($this->model->addPost($data, 3))
                    $this->redirect('posts');
            }
        }
		$this->view->title = 'Add Post';
        $this->render('form');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $form = new Application_Form_Post();

        $post = $this->model->getPostById($id);
        $form->populate($post[0]);
        $this->view->form = $form;

        if($this->getRequest()->isPost()){
            $data = $this->getRequest()->getPost();
            if($form->isValid($data)){
                if ($this->model->editPost($data))
                    $this->redirect('posts');
            }
        }
		$this->view->title = 'Edit Post';
        $this->render('form');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
			$this->commentModel->deletePostComments($id);
            if ($this->model->deletePost($id))
                $this->redirect('posts');
        } else {
            $this->redirect('posts');
        }
    }

    public function showAction()
    {
        $id = $this->getRequest()->getParam('id');
		$post = $this->model->getPostById($id);
		$post[0]['author'] = $this->userModel->getUserById($post[0]['user_id'])[0]['name'];
		$this->view->post = $post[0];
		$comments = $this->commentModel->listComments($id);
		for($i=0; $i< count($comments); $i++) {
			$comments[$i]['commenter'] = $this->userModel->getUserById($comments[$i]['user_id'])[0]['name'];
		}
		$this->view->comments = $comments;
		$form = new Application_Form_Comment();
		$this->view->form = $form;
		$this->view->title = $post[0]['title'];
		if ( $this->getRequest()->isPost() ) {
			$data = $this->getRequest()->getPost();
			if($form->isValid($data)){
                if ($this->commentModel->addComment($data, 3, $id ))
                    $this->redirect('posts/show/id/'.$id);
            }
		}
    }


}
