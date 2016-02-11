<?php
// Home / Dashboard 
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push(Lang::get('menu.home'), url('/'), ['icon' => 'ace-icon fa fa-home']);
});