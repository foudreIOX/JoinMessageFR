<?php

namespace foudreIOX\Events;

use foudreIOX\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\Server;

class JoinEvent implements Listener
{
    public function onJoin(PlayerJoinEvent $event)
    {
        $event->setJoinMessage("");

        $player = $event->getPlayer();
        $player->getHungerManager()->setFood($player->getHungerManager()->getMaxFood());


        if ($event->getPlayer()->hasPlayedBefore()) {
            Server::getInstance()->broadcastMessage("§f[§eJoinMessage§f] §a[+] §f {$event->getPlayer()->getName()} ");
        } else {
            $event->getPlayer()->getInventory()->addItem(ItemFactory::getInstance()->get(ItemIds::WOOD, 0, 64)->setCustomName("§fKIT de base"));
            Server::getInstance()->broadcastMessage("Bienveunue aux joueur §C {$event->getPlayer()->getName()} §f qui est nouveau sur le serveur");
        }
    }

    public function onQuit(PlayerQuitEvent $event)
    {
        $event->setQuitMessage("");
        Server::getInstance()->broadcastMessage("§f[§eQuitMessage§f] §4[-] §f {$event->getPlayer()->getName()}");
    }
}