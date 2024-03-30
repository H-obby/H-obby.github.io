<?php

class Toolbox {
    public const ROUGE = "danger";
    public const ORANGE = "warning";
    public const VERTE = "success";

    public static function addAlert(string $message, $type): void {
        $_SESSION["alert"][]=[
            "message"=>$message,
            "type"=>$type
        ];
    }

    public static function displayAlerts():void {
        if(!empty($_SESSION["alert"])) {
            foreach($_SESSION["alert"] as $alert){
                switch($alert["type"]) {
                    case self::ROUGE:
                    case self::ORANGE:
                    case self::VERTE:
                        echo '
                        <div class="alert-container-'.$alert["type"].'">
                            <span class="alert-text">'.$alert["message"].'</span>
                        </div>
                        ';
                        break;
                    default:
                        throw new Exception("La couleur n'existe pas! ".$alert["type"]);
                }
            }
            unset($_SESSION["alert"]);
        }
    }
}