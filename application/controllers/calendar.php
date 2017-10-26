<?php defined('BASEPATH') OR exit('No direct script access allowed');

class calendar extends CI_Controller {

    public function get_events()
    {
        $this->load->model('calendario_model');
        // Our Start and End Dates
        $start = $this->input->get("start");
        $end = $this->input->get("end");
        
        $startdt = new DateTime('now'); // setup a local datetime
        $startdt->setTimestamp($start); // Set the date based on timestamp
        $start_format = $startdt->format('Y-m-d H:i:s');
   
        $enddt = new DateTime('now'); // setup a local datetime
        $enddt->setTimestamp($end); // Set the date based on timestamp
        $end_format = $enddt->format('Y-m-d H:i:s');
        
        $events = $this->calendario_model->get_events($start_format, $end_format);
        $data_events = array();
   
        foreach($events->result() as $r) {
   
            $data_events[] = array(
                "id" => $r->ID,
                "title" => $r->nombre,
                //"description" => $r->description,
                "end" => $r->fin,
                "start" => $r->inicio,
                "color"=>$r->color
            );
        }
   
        echo json_encode(array("events" => $data_events));
        exit();
    }
}