<?php

namespace App\Controllers;

use Hleb\Constructor\Handlers\Request;

class Controller extends \MainController
{   
    public function index() {
        if (Request::getMethod() == "GET") {
            $data = json_decode(file_get_contents("data.json"), true);

            return $data["result"];
        }

        $req = Request::getJsonBodyList();

        $methods = [
            "get_current_DateTime",
            "get_current_UNIX_time"
        ];

        $data = [
            "jsonrpc" => "2.0",
            "result" => null,
            "id" => $req["id"]
        ];


        if (!$req)
            return $this->error($req, "Parse error");

        if (!array_key_exists("jsonrpc", $req) || !array_key_exists("method", $req) || $req["jsonrpc"] != "2.0")
            return $this->error($req, "Invalid Request");

        if (!in_array($req["method"], $methods))
            return $this->error($req, "Method not found");

        if (array_key_exists("params", $req) && $req["params"])
            return $this->error($req, "Invalid params");

        if (!array_key_exists("id", $req)) return;


        if ($req["method"] == "get_current_DateTime") {
            return $this->get_current_DateTime($req, $data);
        }

        return $this->get_current_UNIX_time($req, $data);
    }

    private function get_current_DateTime($req, $data) {
        $date_time = date("Y-m-d H:m:s");

        $data["result"] = $date_time;
        $resp = json_encode($data);

        file_put_contents("data.json", $resp);

        return $resp;
    }

    private function get_current_UNIX_time($req, $data) {
        $unix_time = time();

        $data["result"] = $unix_time;
        $resp = json_encode($data);

        file_put_contents("data.json", $resp);

        return $resp;
    }

    private function error($resp, $code) {
        $errors = [
            "Parse error" => -32700,
            "Invalid Request" => -32600,
            "Method not found" => -32601,
            "Invalid params" => -32602
        ];

        $data = [
            "jsonrpc" => "2.0",
            "error" => $errors[$code],
            "id" => $resp["id"]
        ];

        $resp = json_encode($data);
        
        file_put_contents("data.json", $resp);

        return $resp;
    }
}