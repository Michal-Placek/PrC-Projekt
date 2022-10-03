<?php

namespace App\Model;

use Nette;

final class CharacterFacade
{
	use Nette\SmartObject;

	private Nette\Database\Explorer $database;

	public function __construct(Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}
    private const
		TABLE_NAME = 'character',
		COLUMN_ID = 'id',
		COLUMN_NAME = 'name';


public function getAllChar()
{
    return $this->database
        ->table('character')
        ->fetchAll("*");
}
public function addChar(string $name): void
{
        $this->database->table(self::TABLE_NAME)->insert([
            self::COLUMN_NAME => $name]);

}

}