<?php

namespace Ikadoc\KCFinderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class ProxyController extends Controller
{
	public function proxyAction($file)
	{
		$pathinfo = pathinfo($file);
		$path = $pathinfo['dirname'];
		$fileName = $pathinfo['basename'];
		if ('.' == $path) {
			$path = $this->getParameter('ikadoc_kc_finder_path');
		} else {
			$path = rtrim($this->getParameter('ikadoc_kc_finder_path'),'/') . '/' . $path;
		}

		if (in_array($pathinfo['extension'], array('png','gif','jpg'))) {
			$response = new BinaryFileResponse($path . '/' . $pathinfo['basename']);
			return $response;
		}

		$config = $this->getParameter('ikadoc_kc_finder_config');
		if (is_array($config)) {
			if (!array_key_exists('KCFINDER',$_SESSION) || is_null($_SESSION['KCFINDER'])) {
				$_SESSION['KCFINDER'] = array();
			}
			foreach($config as $configName => $configElement) {
				$_SESSION['KCFINDER'][$configName] = $configElement;
			}
		}

		$previousscriptFileName = $_SERVER['SCRIPT_FILENAME'];
		$previousCwd = getcwd();
		chdir($path);
		$_SERVER['SCRIPT_FILENAME'] = $path . '/' . $fileName;

		require $pathinfo['basename'];

		$_SERVER['SCRIPT_FILENAME'] = $previousscriptFileName;
		chdir($previousCwd);

		ob_end_flush();

		return new Response();
	}
}
