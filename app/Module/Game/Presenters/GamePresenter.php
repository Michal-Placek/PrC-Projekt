<?php

declare(strict_types=1);

namespace App\Module\Game\Presenters;

use Nette;
use App\Model\characterFacade;
use App\Model\UserFacade;

final class GamePresenter extends BasePresenter
{
    use RequireLoggedUser;


}