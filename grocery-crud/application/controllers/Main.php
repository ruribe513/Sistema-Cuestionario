<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        /* ------------------ */

        $this->load->library('grocery_CRUD');

    }

    public function index()
  	{
  		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
  	}

    public function proyects()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('proyects');
        $crud->set_subject('Proyecto');
        //$crud->columns('Nombre Proyecto','Cantidad Personas','Tecnologias','Conocimientos Requeridos');
        $crud->columns('codigo_proyecto','nombre_proyecto','cantidad_personas','metodologia','duracion_proyecto','tecnologias','dificultad_proyecto','conocimientos_requeridos');
        $crud->fields('nombre_proyecto','cantidad_personas','metodologia','duracion_proyecto','tecnologias','dificultad_proyecto','conocimientos_requeridos');
        $crud->set_theme('datatables');
        $output = $crud->render();

        $this->_example_output($output);
    }

    function _example_output($output = null)

    {
        $this->load->view('our_template.php',$output);
    }
}
