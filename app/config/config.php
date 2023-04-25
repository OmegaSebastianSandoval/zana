<?php
define('DEFAULT_TITLE', 'Hotel Boutique Zana');// titulo general para toda la pagina

$config = array(); //

$config ['production']= array();
$config ['production']['db'] = array();
$config ['production']['db']['host'] ='localhost';
$config ['production']['db']['name'] ='mundoave_nuevocorparques';
$config ['production']['db']['user'] ='mundoave_nuevocorparques';
$config ['production']['db']['password'] ='Admin.2008';
$config ['production']['db']['port'] ='3306';
$config ['production']['db']['engine'] ='mysql';

$config ['staging']= array();
$config ['staging']['db'] = array();
$config ['staging']['db']['host'] ='localhost';
$config ['staging']['db']['name'] ='omegasol_corparques';
$config ['staging']['db']['user'] ='omegasol_corparques';
$config ['staging']['db']['password'] ='Admin.2008';
$config ['staging']['db']['port'] ='3306';
$config ['staging']['db']['engine'] ='mysql';

$config ['development']= array();
$config ['development']['db'] = array();
$config ['development']['db']['host'] ='localhost';
$config ['development']['db']['name'] ='zana';
$config ['development']['db']['user'] ='root';
$config ['development']['db']['password'] = '';
$config ['development']['db']['port'] ='3306';
$config ['development']['db']['engine'] ='mysql';

