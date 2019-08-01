<?php


namespace MyApp\Model\FormMapper;


use Imagick;
use MyApp\Model\DomainObjects\Product;
use MyApp\Model\Editor\EditorFactory;
use MyApp\Model\Helper\Form\ImageFields;
use MyApp\Model\Helper\Form\ProductField;
use MyApp\Model\Helper\Form\UserField;
use MyApp\Model\Http\Request;
use MyApp\Model\Http\Session;

class UploadProductFormMapper
{
    /** @var Request  */
    private $request;
    private $session;
    public function __construct(Request $request,Session $session)
    {
        $this->request=$request;
        $this->session=$session;
    }
    public function createProductFromUploadForm():?Product
    {
        if(!$this->request->getPost() || !isset($this->session->getSession()[UserField::getId()]))
        {
            return null;
        }
        $id=$this->session->getSession()[UserField::getId()];

        //$savedFile=$this->saveImage($_FILES[ImageFields::getImageTag()][ImageFields::getImageTemporaryLocation()]);
        return new Product( $id,
            $this->request->getPost()[ProductField::getImageTitleField()],
            $this->request->getPost()[ProductField::getImageDescriptionField()],
            $this->request->getPost()[ProductField::getCameraSpecsField()],
            new \DateTime($this->request->getPost()[ProductField::getCaptureDate()]),
            sprintf("%s.%s", uniqid(), 'jpg'),
            $this->request->getPost()[ProductField::getTagField()]);
    }

}