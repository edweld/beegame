<?php

namespace BeeGame\Model;

abstract class Bee 
{
    protected $points = 0;
	
	protected $hit = 0;
	
	protected $type ='unknown';

    public function __construct( int $points, int $hit)
	{
	    $this->points = $points;
		$this->hit = $hit;
		return $this;
	}
    public function dead() : bool
	{
	    if( $this->points > 0)
		{
		    return false;
		}
		return true;
	}
	
	public function hit(): int
	{
	    $this->points = $this->points - $this->hit;
		
		return $this->hit;
	}
	
	public function getType()
	{
	    return $this->type;
	}
}