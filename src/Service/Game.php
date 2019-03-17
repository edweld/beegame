<?php
namespace BeeGame\Service;
use Beegame\Collection\Hive;
use BeeGame\Factory;
use \Exception;

class Game {

    protected $hive;
	
	protected $factory;
	
	protected $settings;
	
	protected $active = true;
	
	protected $hits = 0;
	
    public function __construct( Factory $factory, $settings )
	{
	    $this->factory = $factory;
	    $this->settings = $settings;
		return $this;
	}
	
	public function start()
	{
		$hive = $this->factory->getHive();
		 
		if(!array_key_exists("bees",$this->settings))
		{
			throw new Exception("Missing key 'bees' in configuration");
		}
		foreach($this->settings["bees"] as $type=>$bee )
		{
		    if(!array_key_exists("total", $bee)){
			    throw new Exception("Missing key 'total' for bee " .$type);
			}
		    for($i=0;$i<$bee["total"]; $i++)
			{
			     $hive->add(  $this->factory->getBee($type, $bee));
			}
		}
		$this->hive = $hive;
		return $hive;
	}
	
	public function action(string $action): string
	{
	    $res = "";
	    switch(trim($action))
		{
		    case "hit":
			    $res = $this->hit();
			break;
			case "quit":
			    $this->active = false;
				$res = $this->settings["copy"]["endquit"];
			break;
			default:
			     $res = $this->settings["copy"]["errorinput"];
			break;
	    }
	    return $res;
	}
	
	public function hit(): string
	{
	    $bee = $this->hive->getRandomBee();
		$life = $bee->hit();
		$this->hits++;
		if($bee->dead() && ("Queen"==$bee->getType()))
		{
		    $res = sprintf($this->settings["copy"]["deadbee"], $bee->getType());
		    // By design the game is over, but the spec said remove points
			$this->hive->destroyBees();
			$this->active = false;
		}
		elseif($bee->dead()){
			$res = sprintf($this->settings["copy"]["deadbee"], $bee->getType());
			$this->hive->remove($bee);
		}else{
		     $res = sprintf($this->settings["copy"]["hitbee"], $life, $bee->getType());
		}
		if(count($this->hive)==0)
		{
			$this->active = false;
			$res .=  sprintf($this->settings["copy"]["end"], $this->hits);
		}
		return $res;
	}
	
	public function active() : bool
	{
	    if(count($this->hive)==0){
		    return false;
		}
	    return $this->active;
	}
}