<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'user';

    function listUsers()
    {
    	return $this->fetchAll()->toArray();
    }


    function addUser($data)
    {
    	if (isset($data['module']))
  			unset( $data['module']) ;
  		if (isset($data['controller']))
  	 		unset( $data['controller']);
  		if (isset($data['action']))
  		 	unset( $data['action']);
  		if (isset($data['submit']))
  		 	unset( $data['submit']);

    	$data['password']=md5($data['password']);

		return $this->insert($data);

    }


    function editUser($data)
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

		$data['password']=md5($data['password']);
    	return $this->update( $data, 'id='.$id);
    }


    function deleteUser($id)
    {
    	return $this->delete('id='.$id);
    }


    function getUserById($id)
    {
    	return $this->find($id)->toArray();
    }
}
