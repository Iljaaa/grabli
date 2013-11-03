<?php

class IssueHelper {


	private static $_issuesNames = array (
		'bug'				=> 'bug',
		'featurerequest'	=> 'feature request',
		'enhancement'		=> 'enhancement',
		'other'				=> 'other',
		'task'				=> 'task',
		'idea'				=> 'idea'
	);

	private static $_issuesAbbreviation = array (
		'bug'				=> 'b',
		'featurerequest'	=> 'fr',
		'enhancement'		=> 'e',
		'other'				=> 'o',
		'task'				=> 't',
		'idea'				=> 'i'
	);



	/**
	 * Название по типу проблемы
	 *
	 * @param string $issueType
	 * @return string
	 */
	public static function getIssueNameByType ($issueType)
	{
		yii::app()->firephp->log ('IssueHelper::getIssueNameByType('.$issueType.')');

		if (isset(static::$_issuesNames[$issueType])){
			return static::$_issuesNames[$issueType];
		}

		return $issueType;
	}

	/**
	 * Абравиатура по типу проблемы
	 *
	 * @param $issueType
	 * @return mixed
	 */
	public static function getIssueAbbreviation ($issueType)
	{
		yii::app()->firephp->log ('IssueHelper::getIssueAbbreviation('.$issueType.')');

		if (isset(static::$_issuesAbbreviation[$issueType])){
			return static::$_issuesAbbreviation[$issueType];
		}

		return $issueType;
	}


}