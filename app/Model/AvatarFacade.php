<?php

namespace App\Model;

use Nette;
use Nette\Security\Passwords;
use Nette\Utils\Validators;

final class AvatarFacade{

    private const
        TABLE_NAME = 'avatar',
        COLUMN_ID = "id",
        COLUMN_CHARACTER_ID = 'character_id',
        COLUMN_RACE = 'race',
        COLUMN_HEAD = 'head',
        COLUMN_BODY = 'body',
        COLUMN_EYES = 'eyes',
        COLUMN_HAIR = 'hair',
        COLUMN_MOUTH = 'mouth',
        COLUMN_NOSE = 'nose';


	public function __construct(Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}

    public function setPart($characterId, $part, $partId){
        $id = $this->database->table(self::TABLE_NAME)->select("*")->where([SELF::COLUMN_CHARACTER_ID => $characterId]);
        bdump($id);
        //bdump($part . " " . $partId . " " . $characterId);
        $this->database->table(self::TABLE_NAME)->update([$part => $partId])->where([SELF::COLUMN_ID => $id]);
    }

    public function getPart($characterId, $part){
        return $this->database->table(SELF::TABLE_NAME)->select($part)->where([SELF::COLUMN_CHARACTER_ID => $characterId])->fetch();
    }

    public function updateAvatar()
    {
        # code...
    }
    public function getAvatarById(int $id){
        return $this->database->table(SELF::TABLE_NAME)->select("*")->where(SELF::COLUMN_CHARACTER_ID, $id)->fetch();
    }

    public function setNewAvatar(int $id){
        $this->database->table(SELF::TABLE_NAME)
        ->insert([
            SELF::COLUMN_CHARACTER_ID =>$id,
            SELF::COLUMN_RACE => 0,
            SELF::COLUMN_HEAD => 0,
            SELF::COLUMN_BODY => 0,
            SELF::COLUMN_EYES => 0,
            SELF::COLUMN_HAIR => 0,
            SELF::COLUMN_MOUTH => 0,
            SELF::COLUMN_NOSE => 0
            ]);
    }


}