<?php

class Application_Form_Post extends Zend_Form
{

    public function init()
    {
		$id = new Zend_Form_Element_Hidden("id");
		$id->removeDecorator('label');
		$user_id = new Zend_Form_Element_Hidden("user_id");
		$user_id->removeDecorator('label');

		$title = new Zend_Form_Element_Text("title");
		$title->setRequired();
		$title->setlabel("Title:");
		$title->setAttrib("class","form-control");
		$title->setAttrib("placeholder","Enter post title");

		$body = new Zend_Form_Element_Textarea("body");
		$body->setRequired();
		$body->setlabel("Body:");
		$body->setAttrib("class","form-control");
		$body->setAttrib("placeholder","Enter your Body");

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib("class","btn btn-success");

		$this->addElements(array($id, $user_id, $title, $body, $submit));
    }

}
