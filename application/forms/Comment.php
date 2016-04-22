<?php

class Application_Form_Comment extends Zend_Form
{

    public function init()
    {
		$id = new Zend_Form_Element_Hidden("id");
		$id->removeDecorator('label');
		$user_id = new Zend_Form_Element_Hidden("user_id");
		$user_id->removeDecorator('label');
		$post_id = new Zend_Form_Element_Hidden("post_id");
		$post_id->removeDecorator('label');

		$body = new Zend_Form_Element_Textarea("body");
		$body->setRequired();
		$body->setlabel("Comment:");
		$body->setAttrib("class","form-control");
		$body->setAttrib("placeholder","Enter your comment");
		$body->setAttrib("rows","6");

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib("class","btn btn-success");

		$this->addElements(array($id, $user_id, $post_id, $body, $submit));

    }


}
