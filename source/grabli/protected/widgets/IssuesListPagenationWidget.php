<?php
/**
 * Created by PhpStorm.
 * User: Ilja
 * Date: 15.06.14
 * Time: 11:59
 */
class IssuesListPagenationWidget extends CLinkPager {

    public $viewPath = '';

    public function run() {
        return $this->render('IssuesListPagenationWidget');
    }



    public function render($view, $data = null, $return = false)
    {
        $data['url_data'] = $_GET;
        unset ($data['url_data']['page']);

        return parent::render($view, $data, $return);
    }


} 