<?php


Class Tasks {

    private $id;
    private $label;
    private $duration;
    private $created_at;
    private $completed;

    /*Getter*/
    public function getId_Tasks()
    {
        return $this->id;
    }
    public function getLabel_Tasks()
    {
        return $this->label;
    } 
    public function getDuration_Tasks()
    {
        return $this->duration;
    } 
    public function getCreated_Tasks()
    {
        return $this->created_at;
    }
    public function getCompleted_Tasks()
    {
        return $this->completed;
    }
}
?>