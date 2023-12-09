<?php
class DbBox extends AbstractBox
{
    private static $instance = null;
    private $db;

    /**
     * @return DbBox
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self(new mysqli);
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
     * @param \mysqli $db
     */
    private function __construct(\mysqli $db)
    {
        $this->db = $db;
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
            $result = $this->db->query("SELECT `key`, `value` FROM table_box");
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                if (isset($new_data[$row['key']]) && $new_data[$row['key']] != $row['value']) {
                    $this->db->query("UPDATE table_box SET `value` = " . $this->data[$row['key']] . " WHERE `key` = " . $row['key']);
                    unset($new_data[$row['key']]);
                }
            }

            foreach ($new_data as $key => $value) {
                $this->db->query("INSERT INTO table_box (`key`, `value`) VALUES (" . $key . "," . $value . ")");
            }
        }
    }

    /**
     * @return void
     */
    public function load()
    {
        $result = $this->db->query("SELECT `key`, `value` FROM table_box");

        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->data[$row['key']] = $row['value'];
        }
    }
}
