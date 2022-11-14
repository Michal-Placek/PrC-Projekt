<?php

declare(strict_types=1);

namespace App\Module\Game\Presenters;

use Nette;
use App\Model\characterFacade;
use App\Model\UserFacade;
use Nette\Application\UI\Form;


final class GamePresenter extends BasePresenter
{
    use RequireLoggedUser;

    public function renderPostava(){
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
				$this->template->headId = $this->template->headId + 1;
			}else{
				$this->template->headId = $this->template->headId - 1;
			}

			break;
		case 'eyes':
			if($action == 1){
				$this->template->eyesId = $this->template->eyesId + 1;
			}else{
				$this->template->eyesId = $this->template->eyesId - 1;
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

	public function createComponentAvatarForm() : Form
	{
		$form = new Form;
		$form->addInteger('race', 'race: ');
		$form->addInteger('body', 'body: ');
		$form->addInteger('head', 'head: ');
		$form->addInteger('eyes', 'eyes: ');
		$form->addInteger('hair', 'hair: ');
		$form->addInteger('mouth', 'mouth: ');
		$form->addInteger('nose', 'nose: ');
		$form->addSubmit('send', 'Uložit')
			->setHtmlAttribute('class', 'btn btn-primary');
		$form->onSuccess[] = [$this, 'avatarFormSucceeded'];
		return $form;
	}
	public function avatarFormSucceeded(Form $form, \stdClass $data)
	{
		$this->userFacade->updateStat($data);
	}
}