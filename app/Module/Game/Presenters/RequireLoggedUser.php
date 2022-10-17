<?php

declare(strict_types=1);

namespace App\Module\Game\Presenters;


trait RequireLoggedUser
{
	public function injectRequireLoggedUser(): void
	{
		$this->onStartup[] = function () {
			if (!$this->getUser()->isLoggedIn()) {
				$this->redirect(':Front:Sign:in', ['backlink' => $this->storeRequest()]);
			}
		};
	}
}
