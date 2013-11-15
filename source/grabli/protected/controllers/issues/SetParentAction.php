<?php
/**
 * Created by PhpStorm.
 * User: ilja
 * Date: 15.11.13
 * Time: 10:13
 */

class SetParentAction extends IssueAction
{

	public function run()
	{
		$id = yii::app()->getRequest()->getParam ('id', 0);
		yii::app()->firephp->log ($id, '$id');
		if ($id == 0) $this->returnError ('Url error; id wrong');

		$issue = Issue::model()->findByPk($id);
		if ($issue == null) $this->returnError ('Issue not found');

		$parent = yii::app()->getRequest()->getParam ('parent', 0);
		if ($parent == 0) $this->returnError ('Url error; parent wrong');

		$parentIssue = Issue::model()->findByPk($parent);
		if ($parentIssue == null) $this->returnError ('Parent issue not found');

		if ($issue->id == $parentIssue->id) {
			$this->returnError ('Can\'t be self parent');
		}

		$issue->parent_id = $parentIssue->id;
		$issue->save ();

		$this->gotoSuccess ('Issue parent updated');

		return true;
	}

} 