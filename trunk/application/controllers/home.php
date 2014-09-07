<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property Mysmarty $mysmarty
*/
 
class Home extends CI_Controller
{
    /**
     * constructor
     */
    public function __construct()
    {
        parent::__construct();        
    }
     
    /**
     * Default function that will be executed unless another method specified
     */
    public function index()
    {  
        //$smarty = new Smarty();
        // basic assignment for passing data to template file
        //$smarty->assign('title', 'Test Title');
        //$smarty->assign('description', 'Test Description');
        // show the template
        //$smarty->display(APPPATH.'/views/templates/index.tpl');
       // $this->smarty->view('index');
        $this->smarty->assign("title","Testing Smarty");
        $this->smarty->assign("description",
            "This is the testing page for integrating Smarty and CodeIgniter.");
        $this->smarty->view('index');
    }
}
?>