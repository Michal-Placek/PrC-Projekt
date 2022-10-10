<?php

declare(strict_types=1);

namespace App\Module\Front\Presenters;

use Nette;
use App\Model\UserFacade;

final class HomepagePresenter extends Nette\Application\UI\Presenter
{
	private UserFacade $userFacade;

	public function __construct(UserFacade $userFacade)
	{
		$this->userFacade = $userFacade;
	}

    public function renderDefault()
    {
        $this->template->profiles = $this->userFacade->getAll();
    }
}