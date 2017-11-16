<?php

namespace Toinou\SummernoteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Toinou\SummernoteBundle\Entity\SummernoteImage;

class DefaultController extends Controller
{
	public function uploadAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		
		if(!$request->isXmlHttpRequest()) {
			throw $this->createNotFoundException('This method has to be called by ajax');
		}

		try {
			$file = $request->files->get('summernote_image');
			$fileInfo = $this->get('toinou_summernote.file_upload')->upload($file);

			$image = new SummernoteImage();
			$image->setName($fileInfo['fileName']);
			$em->persist($image);
			$em->flush();

			return new JsonResponse(array('success'=>true,'url'=>$fileInfo['webPath']));
		} catch(\Exception $e) {
			$logger = $this->get('logger');
			$logger->error('Error occured during the image upload : '.$e->getMessage());

			return new JsonResponse(array('success'=>false,'message'=>'Error occurred during the image upload.'));
		}
	}
}