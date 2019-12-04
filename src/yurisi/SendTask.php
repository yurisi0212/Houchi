<?php
namespace yurisi;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\PluginTask;
use pocketmine\scheduler\CallbackTask;
use pocketmine\scheduler\Task;

class SendTask extends Task{
	public function __construct(Main $main){
		$this->Main = $main;
	}

	public function onRun($tick){
		foreach($this->Main->getServer()->getOnlinePlayers() as $player) {
			$name=$player->getName();
			$this->Main->time[$name]++;
			if ($this->Main->time[$name] == 300) {
				$player->setNameTag("[放置中]".$name);
				$this->Main->getServer()->broadcastTip("[{$this->Main->plugin}]{$name}が放置を開始しました。");
		   	}
		}

	}
	
}