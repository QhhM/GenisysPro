<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

namespace pocketmine\network\protocol;

#include <rules/DataPacket.h>

use pocketmine\item\Item;

class InventoryContentPacket extends DataPacket{
	const NETWORK_ID = Info::INVENTORY_CONTENT_PACKET;

	/** @var int */
	public $windowId;
	/** @var Item[] */
	public $items = [];

	public function decode(){
		$this->windowId = $this->getUnsignedVarInt();
		$count = $this->getUnsignedVarInt();
		for($i = 0; $i < $count; ++$i){
			$this->items[] = $this->getSlot();
		}
	}

	public function encode(){
		$this->reset();
		$this->putUnsignedVarInt($this->windowId);
		$this->putUnsignedVarInt(count($this->items));
		foreach($this->items as $item){
			$this->putSlot($item);
		}
	}
}