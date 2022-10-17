<?php

declare(strict_types=1);

namespace App\Module\Front\Presenters;

use Nette;
use App\Model\characterFacade;
use App\Model\UserFacade;

final class HomepagePresenter extends Nette\Application\UI\Presenter
{
	private UserFacade $userFacade;
	private characterFacade $characterFacade;

	public function __construct(UserFacade $userFacade, characterFacade $characterFacade)
	{
		$this->userFacade = $userFacade;
		$this->characterFacade = $characterFacade;
	}

    public function renderDefault()
    {
		$this->template->isSetCharacter = $this->characterFacade->getCharacterExistsByUserId($this->user->getId());
		$this->template->character = $this->characterFacade->getCharacterInfoByUserId($this->user->getId());
        $this->template->profiles = $this->userFacade->getAll();
    }
}