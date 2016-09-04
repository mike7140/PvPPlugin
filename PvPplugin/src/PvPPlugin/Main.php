<?php
namespace PvPPlugin;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\item\Item;
class Main extends PluginBase implements Listener {
	public function onEnable() {
        	$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
//今回は今までの知識を使って簡単なPvPプラグインを作ります。少し紛らわしいのでわからないところがあれば聞いてください。
	public function onDeath(PlayerDeathEvent $event){//プレイヤーが死んだ時のイベントです
		$player = $event->getEntity();//'死んだ'プレイヤーを取得します
		$event1 = $event->getEntity()->getLastDamageCause();//なぜプレイヤーは死んだのか!?を取得します。
		if ($event1 instanceof EntityDamageByEntityEvent) {//もし死んだ理由がエンティティによるものだったら...
			$killer = $event1->getDamager();//ここでようやくプレイヤーを殺した'エンティティ'が取得できます(プレイヤーとは限りません)
			if ($killer instanceof Player) {//$killerがプレイヤーだったら...
				//ここから好きなコードを書けばいいのですが、参考として殺したプレイヤー($killer)に原木を渡すコードを書きます。
				$item = Item::get(17, 0, 1);//ID17でダメージ値0のアイテム(オークの原木)が1個
				$killer->getInventory()->addItem($item);//$killerに$itemを渡します
			}
		}
	}
}
