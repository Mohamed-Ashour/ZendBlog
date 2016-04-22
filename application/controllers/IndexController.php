<?php

class IndexController extends Zend_Controller_Action
{
	private $userModel;
	private $postModel;
	private $commentModel;

    public function init()
    {
        $this->userModel = new Application_Model_DbTable_User();
		$this->postModel = new Application_Model_DbTable_Post();
		$this->commentModel = new Application_Model_DbTable_Comment();
    }

    public function indexAction()
    {
		$posts = $this->postModel->listPosts();
		for($i=0; $i< count($posts); $i++) {
			$posts[$i]['comments'] = $this->commentModel->countPostComments($posts[$i]['id']);
		}
		$this->view->posts = $posts;

        $this->view->title = 'Home';
    }




}
