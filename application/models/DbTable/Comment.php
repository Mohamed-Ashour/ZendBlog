<?php

class Application_Model_DbTable_Comment extends Zend_Db_Table_Abstract
{

    protected $_name = 'comment';

	function listComments($post_id)
    {
    	return $this->fetchAll("post_id = $post_id")->toArray();
    }

    function addComment($data, $user_id, $post_id)
    {
    	if (isset($data['module']))
  			unset( $data['module']) ;
  		if (isset($data['controller']))
  	 		unset( $data['controller']);
  		if (isset($data['action']))
  		 	unset( $data['action']);
  		if (isset($data['submit']))
  		 	unset( $data['submit']);

		$data['user_id'] = $user_id;
		$data['post_id'] = $post_id;
		return $this->insert($data);
    }


    function editComment($data)
    {
    	$id = $data['id'];
    	if (isset($data['module']))
			unset( $data['module']) ;
		if (isset($data['controller']))
	 		unset( $data['controller']);
		if (isset($data['action']))
		 	unset( $data['action']);
		if (isset($data['submit']))
		 	unset( $data['submit']);
   		if (isset($data['id']))
		 	unset( $data['id']);

    	return $this->update( $data, 'id='.$id);
    }


    function deleteComment($id)
    {
    	return $this->delete('id='.$id);
    }

	function deletePostComments($post_id)
    {
    	$comments = $this->fetchAll("post_id = $post_id")->toArray();
		for ($i=0; $i < count($comments) ; $i++) {
			$this->deleteComment( $comments[$i]['id'] );
		}
		return true;
    }

    function getCommentById($id)
    {
    	return $this->find($id)->toArray();
    }

	function countPostComments($post_id)
	{
		return count($this->fetchAll("post_id = $post_id")->toArray());
	}

}
