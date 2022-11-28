<?php

declare(strict_types=1);

namespace App\Module\Front\Presenters;

use Nette;
use App\Model\characterFacade;
use Nette\Application\UI\Form;
use App\Model\avatarFacade;

final class CharacterPresenter extends Nette\Application\UI\Presenter
{
	private characterFacade $characterFacade;
	private avatarFacade $avatarFacade;

	public function __construct(characterFacade $characterFacade, avatarFacade $avatarFacade)
	{
		$this->characterFacade = $characterFacade;
		$this->avatarFacade = $avatarFacade;
	}

    public function renderDefault()
    {
        $this->template->character = $this->characterFacade->getAllChar();
		$this->template->isSetCharacter = $this->characterFacade->getCharacterByUserId($this->user()->getId());
    }

	public function renderCreate(){

	}

    public function createComponentNewCharacterForm(): Form
	{
		$form = new Form;
		$form->addText('name', 'Jméno Postavy:')
			->setRequired('Prosím vyplňte jméno postavy.');
		
		$form->addSubmit('send', 'Vytvořit');
		$form->onSuccess[] = [$this, 'onNewCharacterCreated'];
		return $form;
	}

	public function renderAvatar(){
		$character = $this->characterFacade->getCharacterInfoByUserId($this->user->id);
		$avatar = $this->avatarFacade->getAvatarById($character->id);
		if($character){
			bdump($character);
			bdump($avatar);
			$this->template->race = $avatar->race;

			$this->template->bodyId = $avatar->bodyId;
			$this->template->headId = $avatar->headId;
			$this->template->eyesId = $avatar->eyesId;
			$this->template->hairId = $avatar->hairId;
			$this->template->mouthId = $avatar->mouthId;
			$this->template->noseId = $avatar->noseId;
		}else{
			$this->characterFacade->setNewCharacter($this->user->id);
			$this->template->race = 0;

			$this->template->bodyId = 0;
			$this->template->headId = 0;

			$this->template->eyesId = 0;
			$this->template->hairId = 0;
			$this->template->mouthId = 0;
			$this->template->noseId = 0;
		}
	}

	public function handleeditCharacter($part, $action){
		bdump($this->user->getIdentity()->character);
		bdump($this->avatarFacade->getPart($this->user->character->id, $part));

		$this->redirect(":Character:avatar");
	}

	public function onNewCharacterCreated(Form $form, \stdClass $data)
	{
		$this->characterFacade->addChar($data->name, $this->getUser()->getId());

		$this->flashMessage('Postava byla úspěšně vytvořena');
		$this->redirect('Character:avatar');
	}
}