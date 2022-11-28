<?php

declare(strict_types=1);

namespace App\Module\Game\Presenters;

use Nette;
use App\Model\characterFacade;
use App\Model\UserFacade;

abstract class BasePresenter extends Nette\Application\UI\Presenter
{

    private UserFacade $userFacade;
	private characterFacade $characterFacade;

    use RequireLoggedUser;

	public function __construct(UserFacade $userFacade, characterFacade $characterFacade)
	{
		$this->userFacade = $userFacade;
		$this->characterFacade = $characterFacade;
	}

    public function beforeRender(){
        parent::beforeRender();
        //$this->template->characterInfo = $this->characterFacade->getCharacterInfoByUserId($this->user->getId());;
    }
}