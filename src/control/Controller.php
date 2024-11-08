<?php


class Controller {
  
  private View $view;
  
  private $animalsTab = array(
	'medor' => array('Médor', 'chien'),
	'felix' => array('Félix', 'chat'),
	'denver' => array('Denver', 'dinosaure'),
);
  
  public function __construct(View $view) {
    $this->view = $view;

  }

  public function getView() {
     return $this->view;
  }
  
  public function showInformation($id) {
	foreach ($this->animalsTab as $key => $val) {
           if($id === $key){
	      $this->view->prepareAnimalPage($val[0], $val[1]); 
           }
        }
        if ( empty($this->view->getTitle()) ){
        	echo "animal inconnu";
        }
        else{
        
        $this->view->render();
        }
	

  }

  
}
  
