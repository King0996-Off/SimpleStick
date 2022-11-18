<?php

namespace King0996\Events;

use King0996\Stick;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;

class StickEvent implements Listener{
    public function onInteract(PlayerInteractEvent $event)
    {
        $player = $event->getPlayer();
        $item = $event->getItem();
        $config = Stick::getInstance()->config();
        $effect = $config->get("Effect");
        $effectDuration = $config->get("EffectDuration");

        $healMessage = $config->get("HealMessage");
        $configTimeMessage = $config->get("RemainingTimeMessage");

        if($item->getId() === $config->get("StickId")){
            if($event->getAction() === 0 || $event->getAction() === 3){
                if(!isset(Stick::getInstance()->cooldown[$player->getName()])){
                    $player->getEffects()->add(new EffectInstance(VanillaEffects::$effect(), $effectDuration*20));
                    $player->sendPopup($healMessage);
                    Stick::getInstance()->cooldown[$player->getName()] = $config->get("StickCooldown");
                }else{
                    $time = Stick::getInstance()->cooldown[$player->getName()];
                    if($time != $config->get("StickCooldown")){
                        $timeMessage = str_replace("{time}", $time, $configTimeMessage);
                        $player->sendPopup($timeMessage);
                    }
                }
            }
        }
    }
}