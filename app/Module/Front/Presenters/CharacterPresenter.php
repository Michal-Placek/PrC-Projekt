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
		$this->template->race = 0;

		$this->template->bodyId = 0;
		$this->template->headId = 0;
		$this->template->eyesId = 0;
		$this->template->hairId = 0;
		$this->template->mouthId = 0;
		$this->template->noseId = 0;
	}

	public function onNewCharacterCreated(Form $form, \stdClass $data)
	{
		$this->characterFacade->addChar($data->name, $this->getUser()->getId());

		$this->flashMessage('Postava byla úspěšně vytvořena');
		$this->redirect('Character:avatar');
	}

	public function handleeditCharacter($part, $action){
		
		switch($part){

		case 'race':
			if($action == 1){
				$this->template->race++;
			}else{
				$this->template->race--;
			}
			break;
		case 'body':
			if($action == 1){
				$this->template->bodyId++;
			}else{
				$this->template->bodyId--;
			}
			break;
		case 'head':
			if($action == 1){
				$this->template->headId++;
			}else{
				$this->template->headId--;
			}

			break;
		case 'eyes':
			if($action == 1){
				$this->template->eyesId++;
			}else{
				$this->template->eyesId--;
			}

			break;
		case 'hair':
			if($action == 1){
				$this->template->hairId++;
			}else{
				$this->template->hairId--;
			}

			break;
		case 'mouth':
			if($action == 1){
				$this->template->mouthId++;
			}else{
				$this->template->mouthId--;
			}

			break;
		case 'nose':
			if($action == 1){
				$this->template->noseId = $this->template->noseId + 1;
			}else{
				$this->template->noseId = $this->template->noseId - 1;
			}
			break;
	
		}
		$this->redrawControl('characterCreator');
	}
}