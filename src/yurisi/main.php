<?php

namespace yurisi;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerMoveEvent;

use pocketmine\scheduler\PluginTask;
use pocketmine\scheduler\CallbackTask;
use pocketmine\scheduler\Task;
use pocketmine\scheduler\ClosureTask;

class main extends PluginBase implements Listener {

	public $time;

	public $plugin="放置プラグイン";

	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getScheduler()->scheduleRepeatingTask(new Sendtask($this), 20);


	}
	public function onLogin(PlayerLoginEvent $event){
		$name=$event->getPlayer()->getName();
		$this->time[$name]=0;
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		switch ($command->getName()) {
			case "houchi":
				$this->time[$sender->getName()]=300;
			break;
		}
	}

	public function onMove(PlayerMoveEvent $event){
		$player=$event->getPlayer();
		$name=$player->getName();
		if($this->time[$name] > 300){
			$player->setNameTag($name);
		}
		$this->getServer()->broadcastTip("[{$this->plugin}]{$name}が放置をやめました");
		$this->time[$name]=0;

	}
}
