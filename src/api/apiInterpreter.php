<?php
abstract class API
{
    //essential vars for API processing
    protected $method = '';
    protected $endpoint = '';
    protected $mode = '';
    protected $args = Array();
    protected $file = Null;
    public function __construct($request) {
        header("Content-Type: application/json");
        // Seperate the request into different vars
        $this->args = explode('/', rtrim($request, '/'));
        $this->endpoint = array_shift($this->args);
        if (array_key_exists(0, $this->args) && !is_numeric($this->args[0])) {
            $this->mode = array_shift($this->args);
            //$this->mode = array_pop($this->args);
        }

        // Set request method var.
        $this->method = $_SERVER['REQUEST_METHOD'];

        //if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
        //    if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
        //        $this->method = 'DELETE';
        //    } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
        //        $this->method = 'PUT';
        //    } else {
        //        throw new Exception("Unexpected Header");
        //    }
        //}

        switch($this->method) {
        case 'POST':
            $this->request = $this->cleanInputs($_POST);
            break;
        case 'GET':
            $this->request = $this->cleanInputs($_GET);
            break;
        default:
            $this->response('Invalid Method', 405);
            break;
        }
    }

    //finds endpoint and asks it to respond.
    public function processAPI() {
        if (method_exists($this, $this->endpoint)) {
            return $this->response($this->{$this->endpoint}($this->args));
        }
        return $this->response("No Endpoint: $this->endpoint", 404);
    }
    //returns endpoint data
    private function response($data, $status = 200) {
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        return $data;
    }
    //creates an array from input vars.
    private function cleanInputs($data) {
        $clean_input = Array();
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $clean_input[$k] = $this->cleanInputs($v);
            }
        } else {
            $clean_input = trim(strip_tags($data));
        }
        return $clean_input;
    }
    //sets status
    private function requestStatus($code) {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code])?$status[$code]:$status[500];
    }
}

?>
