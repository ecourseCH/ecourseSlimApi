<?php
abstract class Repository {
    protected $db;
    public function __construct($db) {
        $this->db = $db;
    }
}

?>