<?php

class Application_Model_DbTable_Post extends Zend_Db_Table_Abstract
{

    protected $_name = 'post';

	function listPosts()
    {
    	return $this->fetchAll()->toArray();
    }


    function addPost($data, $user_id)
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

		return $this->insert($data);
    }


    function editPost($data)
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


    function deletePost($id)
    {
    	return $this->delete('id='.$id);
    }


    function getPostById($id)
    {
    	return $this->find($id)->toArray();
    }

}
