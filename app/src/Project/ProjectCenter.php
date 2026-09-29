<?php

Namespace App\Project;


class ProjectCenter
{
    public function __construct(protected $repository) {}

    public function createProject(array $settings)
    {
        $id = $this->IsValidId($settings['project-id']);

        $project = new Project($id);

        $this->persist($project);
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
}
