<?php

class FileBox extends AbstractBox
{
    private static $instance = null;
    private $file;

    /**
     * @return FileBox
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self('file_name');
        }
        return self::$instance;
    }

    /**
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * @param mixed $file
     */
    private function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * @return void
     */
    public function __wakeup()
    {
    }

    /**
     * @return void
     */
    public function save()
    {
        if ($this->data) {
            $new_data = $this->data;
            $data_file = unserialize(file_get_contents($this->file));

            foreach ($new_data as $key => $value) {
                if (isset($data_file[$key]) && $data_file[$key] != $value) {
                    $data_file[$key] = $value;
                    unset($new_data[$key]);
                }
            }
            $this->data = array_merge($new_data, $data_file);

            file_put_contents($this->file, serialize($this->data));
        }
    }

    /**
     * @return void
     */
    public function load()
    {
        $this->data = unserialize(file_get_contents($this->file));
    }
}
