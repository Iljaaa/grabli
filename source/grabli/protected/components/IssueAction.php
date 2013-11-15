<?php
/**
 * Created by PhpStorm.
 * User: ilja
 * Date: 15.11.13
 * Time: 11:12
 */

class IssueAction extends CAction
{

	/**
	 * Возвращаем плохие новости
	 *
	 * @param string $error
	 */
	protected function returnError ($error = '')
	{
		if ($error != ''){
			Yii::app()->user->setFlash('issue-command-badnews', $error);
		}

		$this->getController()->redirect (Yii::app()->getRequest()->urlReferrer);
	}

	/**
	 * Возвращаем хорошие новсти
	 *
	 * @param string $message
	 */
	protected function gotoSuccess ($message = '')
	{
		if ($message != ''){
			Yii::app()->user->setFlash('issue-command-goodnews', $message);
		}

		$this->getController()->redirect (Yii::app()->getRequest()->urlReferrer);
	}
} 