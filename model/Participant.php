<?php
class Participant
{
    protected $id;
    protected $scoutname;
    protected $prename;
    protected $name;
    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data) {
        // no id if we're creating
        if(isset($data['id'])) {
            $this->id = $data['id'];
        }
        $this->scoutname = $data['title'];
        $this->prename = $data['prename'];
        $this->name = $data['name'];
    }
    public function getId() {
        return $this->id;
    }
    public function getScoutname() {
        return $this->scoutname;
    }
    public function getPrename() {
        return $this->prename;
    }
    public function getName() {
        return $this->name;
    }
}

?>