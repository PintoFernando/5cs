<?php
namespace sis5cs\Repositories;
class PrimerCRepository{
	protected $id;
	public function __construct($id)
	{
       $this->id=$id;
	}

	public function suma()
	{
		$suma=12+12;
		return $suma;
	}
}