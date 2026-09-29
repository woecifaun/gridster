<?php

Namespace App\Project;


class ProjectCenter
{
    public function __construct(protected $repository) {}

    public function loadProject($projectId): Project
    {
        $this->IsValidId($projectId);

        if (!is_dir($this->repository . $projectId . DIRECTORY_SEPARATOR)) {
            throw new Exception("Project [" . $projectId . "] doesn't exists.", 1);
        }

        $properties = file_get_contents($this->repository . $projectId . DIRECTORY_SEPARATOR . 'project.binary');
        $project = unserialize($properties);

        return $project;
    }

    public function createProject(array $settings)
    {
        $id = $this->IsValidId($settings['project-id']);

        $project = new Project($id);
        $project->name = $settings['project-name'];


        $this->persist($project);

        header("Location: /project.php?project=" . $project->id);
    }

    protected function IsValidId($id)
    {
        if (!preg_match('/^[\-a-z0-9]+$/', $id)) {
            throw new Exception("Invalid id : must only contain \[\-a-z0-9]\ caracters.", 1);
        }

        return $id;
    }

    public function persist(Project $project)
    {
        $folder = $this->repository . $project->id . DIRECTORY_SEPARATOR;
        if (is_dir($folder)) {
            throw new Exception("Project ID [" . $project->id . "] already in use.", 1);
        }
        mkdir($folder);

        file_put_contents($folder . 'project.binary', serialize($project));
    }

    public function listProjects()
    {
        $folders = scandir($this->repository, SCANDIR_SORT_DESCENDING);
        $projects = [];

        foreach ($folders as $key => $folder) {
            if (str_starts_with($folder, '.')) {
                continue;
            }

            $projects[$folder] = $this->loadProject($folder);
        }

        return $projects;
    }
}
