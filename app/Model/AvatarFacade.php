<?php

namespace App\Model;

use Nette;
use Nette\Security\Passwords;
use Nette\Utils\Validators;

final class AvatarFacade{

    private const
        TABLE_NAME = 'avatar',
        COLUMN_CHARACTER_ID = 'users_id',
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
        $this->database->table(self::TABLE_NAME)->update($part,$partId)->where(SELF::COLUMN_CHARACTER_ID, $characterId);
    }

    public function getPart($characterId, $part){
        return $this->database->table(SELF::TABLE_NAME)->select($part)->where(SELF::COLUMN_CHARACTER_ID, $characterId)->fetch();
    }

    public function updateAvatar()
    {
        # code...
    }

}