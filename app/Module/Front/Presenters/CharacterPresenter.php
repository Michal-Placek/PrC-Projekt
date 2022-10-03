<?php

declare(strict_types=1);

namespace App\Module\Front\Presenters;

use Nette;
use App\Model\characterFacade;
use Nette\Application\UI\Form;

final class CharacterPresenter extends Nette\Application\UI\Presenter
{
	private characterFacade $characterFacade;

	public function __construct(characterFacade $characterFacade)
	{
		$this->characterFacade = $characterFacade;
	}

    public function renderDefault()
    {
        $this->template->character = $this->characterFacade->getAllChar();
    }

    public function createComponentNewCharacterForm(): Form
{
	$form = new Form;
	$form->addText('name', 'Jméno Postavy:')
		->setRequired('Prosím vyplňte jméno posttavy.');
	
	$form->addSubmit('send', 'Vytvořit');
	$form->onSuccess[] = [$this, 'onNewCharacterCreated'];
	return $form;
}
public function onNewCharacterCreated(Form $form, \stdClass $data)
{
	$this->characterFacade->addChar($data->name);

	$this->flashMessage('Postava byla úspěšně vytvořena');
	$this->redirect('Homepage:');
}

}