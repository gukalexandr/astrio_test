<?php

abstract class AbstractBox implements Box
{
    protected $data = [];

    /**
     * @param mixed $key
     * @param mixed $value
     *
     * @return void
     */
    public function setData($key, $value)
    {
        if ($key && $value) {
            $this->data[$key] = $value;
        }
    }

    /**
     * @param mixed $key
     *
     * @return mixed|null
     */
    public function getData($key)
    {
        if ($key) {
            return !empty($this->data[$key]) ? $this->data[$key] : null;
        }
    }

    /**
     * @return void
     */
    abstract public function save();

    /**
     * @return void
     */
    abstract public function load();
}
