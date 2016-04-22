<?php

class Application_Form_User extends Zend_Form
{

    public function init()
    {

        $id = new Zend_Form_Element_Hidden("id");
		$id->removeDecorator('label');

		$name = new Zend_Form_Element_Text("name");
		$name->setRequired();
		$name->addValidator(new Zend_Validate_Alpha());
		$name->setlabel("Name:");
		$name->setAttrib("class","form-control");
		$name->setAttrib("placeholder","Enter your name");

		$email = new Zend_Form_Element_Text("email");
		$email->setRequired();
		$email->addValidator(new Zend_Validate_EmailAddress());
		$email->addValidator(new Zend_Validate_Db_NoRecordExists(
		    array(
			  'table' => 'user',
			  'field' => 'email'
		    )
		));
		$email->setlabel("Email:");
		$email->setAttrib("placeholder","Enter your Email");
		$email->setAttrib("class","form-control");

		$password = new Zend_Form_Element_Password("password");
		$password->setRequired();
		$password->setlabel("Password:");
		$password->setAttrib("placeholder","Enter your Password");
		$password->setAttrib("class","form-control");
		$password->addValidator(new Zend_Validate_StringLength(array('min' => 5)));

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib("class","btn btn-success");

		$this->addElements(array($id, $name, $email, $password, $submit));

    }

}
