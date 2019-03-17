<?php

namespace BeeGame\Collection;
use \Countable;
use BeeGame\Model\Bee;

class Hive implements Countable {
    private $container = array();

    public function count()
	{
        return count($this->container);
	}
	
	public function add(Bee $bee)
	{
	     $this->container[]=$bee;
	}
	
	public function remove($value)
	{
	    $i = array_search($value, $this->container, true);
		unset($this->container[$i]);
	}
	
	public function getRandomBee()
	{
	    $bee = $this->container[array_rand($this->container)];
		return $bee;
	}
	public function destroyBees()
	{
	    $this->container = array();
	}
}