<?php

namespace BeeGame;
use BeeGame\Collection\Hive;
use BeeGame\Service\Game;
use BeeGame\Model\Bee;
use BeeGame\Model\QueenBee;
use BeeGame\Model\WorkerBee;
use BeeGame\Model\DroneBee;

class Factory 
{
    protected $settings;
	
    public function __construct( array $settings)
	{
	    $this->settings = $settings;
		return $this;
	}
	
	public function getHive(): Hive
	{
	    return new Hive();
	}
	
	public function getBee( string $type, array $settings) : Bee
	{
		if(!array_key_exists('points', $settings))
		{
		     throw new \Exception("Missing configuration key 'points' constructing Bee ".$type);
		}
		if(!array_key_exists('hit', $settings))
		{
		     throw new \Exception("Missing configuration key 'hit' constructing Bee ".$type);
		}
	     switch($type)
		 {
			case "queen" : 
			    return new QueenBee($settings['points'], $settings['hit']);
			break;
			case "worker" :
			    return new WorkerBee($settings['points'], $settings['hit']);
		    break;
			case "drone" :
			    return new DroneBee($settings['points'], $settings['hit']);
			break;
			default:
			    throw new \Exception("getBee: incorrect Bee type");
		 }
	}
	
	public function getGame()
	{
	    $game = new Game($this, $this->settings);
		return $game;
	}
}