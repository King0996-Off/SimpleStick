<?php

namespace King0996;

use King0996\Events\StickEvent;
use King0996\Tasks\StickTask;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\TaskScheduler;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

class Stick extends PluginBase implements Listener{
    /** @var int[] $cooldown */
    public array $cooldown = [];

    use SingletonTrait;

    protected function onEnable(): void
    {
        $this->getLogger()->info('§9SimpleStick enable by King0996');
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents(new StickEvent(), $this);
        $this->getScheduler()->scheduleRepeatingTask(new StickTask(), 20);
    }

    protected function onLoad(): void
    {
        self::setInstance($this);
    }

    public function getScheduler(): TaskScheduler
    {
        return parent::getScheduler();
    }

    public function config(): Config{
        return new Config($this->getDataFolder()."config.yml", Config::YAML);
    }
}