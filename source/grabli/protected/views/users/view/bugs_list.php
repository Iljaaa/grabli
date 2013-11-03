<?php 

$projectsIds = array ();
foreach ($bugs as $bug) {
	if (!in_array($bug->project_id, $projectsIds)) $projectsIds[] = $bug->project_id;
}



foreach ($projectsIds as $projectId) :
	$project = Project::model()->findByPk($projectId);
	if ($project == null) continue;

	?>

	<h3><?=$project->name ?></h3>
	<?php
		$projectBugs = array();
	
		foreach ($bugs as $b) :
			if ($b->project_id != $project->id) continue;
			$projectBugs[] = $b; 
		endforeach; ?>
	
	<?php if (count($projectBugs) > 0) 
		echo $this->renderPartial('/projects/view/issues', array('bugs' => $projectBugs));
endforeach; ?>