<?php
/**
 * Created by PhpStorm.
 * User: LaFuma
 * Date: 8/8/2017
 * Time: 5:15 PM
 */

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as C;

class Main extends PluginBase implements Listener{

    public $config;

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(C::YELLOW . "by LaFuma");
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML, [

            "Hello Counter" => 0,
            "goodbye Counter" => 0,

        ]);
    }

    public function onChat(PlayerChatEvent $event){

        $i = 1;
        $p = $event->getPlayer();
        $msg = $event->getMessage();

        if($msg === "Hello") {

            $configArray = $this->config->getAll();

            ++$configArray["Hello Counter"];

            $this->config->setAll($configArray);

        }else if($msg === "goodbye"){

            $configArray = $this->config->getAll();

            ++$configArray["goodbye Counter"];

            $this->config->setAll($configArray);

        }

    }
    public function onDisable()
    {
        $this->config->save();
    }
}