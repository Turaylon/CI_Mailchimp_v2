<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Super-simple, minimum abstraction MailChimp API v2 wrapper
 *
 * @author Drew McLellan <drew.mclellan@gmail.com> modified by Ben Bowler <ben.bowler@vice.com> and Michele Somma (Turaylon) <djdrake88@gmail.com>
 * @version 1.0
 */

/**
 * api_key
 * api_endpoint
 */

$config['api_key'] = 'your_api_key_here';
$config['api_endpoint'] = 'endpoint'; //something like us1,us2,us3,uk1 etc.
$config['api_datacentre'] =  'https://<dc>.api.mailchimp.com/2.0'; // without '/' at the end
$config['verify_ssl'] = FALSE;


