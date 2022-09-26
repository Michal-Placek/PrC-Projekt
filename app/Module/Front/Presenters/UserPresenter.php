<?php
namespace App\Module\Front\Presenters;

use Nette;
use App\Model\UserFacade;
use Nette\Application\UI\Form;

final class UserPresenter extends Nette\Application\UI\Presenter
{
    private UserFacade $userFacade;

    public function __construct(UserFacade $userFacade)
    {
        $this->userFacade = $userFacade;
    }

     public function renderDetail(int $id)
    {
        $this->template->profiles = $this->userFacade->getUserById($id)[$id];
    }
}