<?php

class DashboardController extends Controller {

    public function index() {

        $data['title'] = "Dashboard";

        $this->viewWithLayout('dashboard/index', $data);
    }
}
