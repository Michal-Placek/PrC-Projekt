<?php

namespace App\Model;

use Nette;
use Nette\Security\Passwords;
use Nette\Utils\Validators;

final class CharacterFacade
{
	use Nette\SmartObject;

	private Nette\Database\Explorer $database;

	private const
	TABLE_NAME = 'character',
	COLUMN_ID = 'id',
	COLUMNT_USERS_ID = 'users_id',
	COLUMN_NAME = 'name',
	COLUMN_MONEY = 'money',
	COLUMN_HEALTH = 'health',
	COLUMN_DMG = 'dmg',
	COLUMN_DEX = 'dex',
	COLUMN_DEF = 'def';

	public function __construct(Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}

	public function getAllChar()
	{
		return $this->database
			->table(self::TABLE_NAME)
			->fetchAll("*");
	}

	public function addChar(string $name, int $id): void
	{
		bdump($this->database->table(self::TABLE_NAME)->where(self::COLUMN_NAME, $name)->fetch());
		if($this->database->table(self::TABLE_NAME)->where(self::COLUMN_NAME, $name)->fetch() == null){
			$this->database->table(self::TABLE_NAME)
				->insert([
					self::COLUMN_NAME => $name,
					self::COLUMNT_USERS_ID => $id
				]);

			$this->database->table('avatar')->insert([
				'character_id' => $id,
				'race' => 0,
				'head' => 0,
				'body' => 0,
				'eyes' => 0,
				'hair' => 0,
				'mouth' => 0,
				'nose' => 0
			]);
		}else{
//			$this->flashMessage('Character with that name already exists');
			//$this->redirect(':Front:Homepage:');
		}
	}

	public function getCharacterExistsByUserId($id){
		$result = $this->database->table(SELF::TABLE_NAME)->select(SELF::COLUMNT_USERS_ID)->where(SELF::COLUMNT_USERS_ID, $id)->fetch();
		bdump($result);
		return $result;
	}

	public function getCharacterInfoByUserId($id){
		$result = $this->database->table(SELF::TABLE_NAME)->select('*')->where(SELF::COLUMNT_USERS_ID, $id)->fetch();
		bdump($result);
		return $result;
	}

	public function setNewCharacter($id){
		$result = $this->database->table(SELF::TABLE_NAME)
			->insert([
				SELF::COLUMNT_USERS_ID => $id,

			]);
		bdump($result);
		return $result;
	}
}