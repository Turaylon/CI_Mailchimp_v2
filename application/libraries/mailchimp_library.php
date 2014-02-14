<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Super-simple, minimum abstraction MailChimp API v2 wrapper
 *
 * Requires curl (I know, right?)
 * This probably has more comments than code.
 *
 * @author Drew McLellan <drew.mclellan@gmail.com> modified by Ben Bowler <ben.bowler@vice.com> and Michele Somma (Turaylon) <djdrake88@gmail.com>
 * @version 1.0
 */
class Mailchimp_library
{
	private $api_key;
	private $api_endpoint;
    private $datacentre ;
    private $verify_ssl = FALSE;


	/**
	 * Create a new instance
	 */
	function __construct()
	{
        $this->ci =& get_instance();
        $this->ci->load->config('mailchimp');

		$this->api_key = $this->ci->config->item('api_key');
		$this->api_endpoint = $this->ci->config->item('api_endpoint');
		$this->datacentre = $this->ci->config->item('api_datacentre');
		$this->verify_ssl = $this->ci->config->item('verify_ssl');

        $this->datacentre = str_replace('<dc>',$this->api_endpoint , $this->datacentre);
	}




	/**
	 * Call an API method. Every request needs the API key, so that is added automatically -- you don't need to pass it in.
	 * @param  string $method The API method to call, e.g. 'lists/list'
	 * @param  array  $args   An array of arguments to pass to the method. Will be json-encoded for you.
	 * @return array          Associative array of json decoded API response.
	 */
	public function call($method, $args=array())
	{
		return $this->_raw_request($method, $args);
	}




	/**
	 * Performs the underlying HTTP request. Not very exciting
	 * @param  string $method The API method to be called
	 * @param  array  $args   Assoc array of parameters to be passed
	 * @return array          Assoc array of decoded result
	 */
	private function _raw_request($method, $args=array())
	{
		$args['apikey'] = $this->api_key;

		$url = $this->datacentre.'/'.$method.'.json';


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->verify_ssl);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($args));
		$result = curl_exec($ch);
		curl_close($ch);

		return $result ? json_decode($result, true) : false;
	}

}
