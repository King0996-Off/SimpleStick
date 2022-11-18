<?php

namespace King0996\Tasks;

use King0996\Stick;
use pocketmine\scheduler\Task;

class StickTask extends Task{
    public function onRun(): void
    {
        foreach (Stick::getInstance()->cooldown as $target => $value) {
            if ($value <= 0) {
                unset(Stick::getInstance()->cooldown[$target]);
            } else {
                Stick::getInstance()->cooldown[$target]--;
            }
        }
    }
}
