<?php

class FileIterator implements Iterator

{
    protected $file_path;
    protected $position = 0;
    protected $handle;

    public function __construct($file_path) {
        $this->file_path = $file_path;
    }

    public function rewind() {
        if ($this->handle) {
            fclose($this->handle);
            $this->handle = null;
        }
        $this->position = 0;
    }

    public function valid() {
        if (!$this->handle) {
            $this->handle = fopen($this->file_path, 'r');
            if (!$this->handle) {
                return false;
            }
        }
        while ($this->position > 0 && !feof($this->handle)) {
            fgets($this->handle);
            $this->position--;
        }
        return !feof($this->handle);
    }

    public function key() {
        return $this->position;
    }

    public function current() {
        return fgets($this->handle);
    }

    public function next() {
        if (!$this->handle) {
            $this->handle = fopen($this->file_path, 'r');
        }
        fgets($this->handle);
        $this->position++;
    }
}