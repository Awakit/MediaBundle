<?php

namespace Awakit\MediaBundle\Provider;

use Awakit\MediaBundle\Entity\Media;
use Gaufrette\Adapter\Local;
use SensioLabs\Security\Exception\RuntimeException;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * description 
 * @author Donjohn
 */
class FileProvider extends BaseProvider {

    /**
     * @var \Gaufrette\Filesystem
     */
    protected $filesystem;

    protected $rootFolder;
    protected $uploadFolder;


    public function __construct($rootFolder, $uploadFolder)
    {

        $this->filesystem = new \Gaufrette\Filesystem(new Local($rootFolder, true, '0775'));
        $this->rootFolder = $rootFolder;
        $this->uploadFolder = $uploadFolder;
    }

    public function extractMetaData(Media $media)
    {
        //todo extractMetaData from a file ?
    }

    public function render( \Twig_Environment $twig, Media $media, $options = array() ) {
        $options['mediaPath'] = $this->getPath($media);
        return parent::render($twig, $media, $options);
    }


    public function getPath(Media $oMedia)
    {
        $firstLevel=100000;
        $secondLevel=1000;

        $rep_first_level = (int) ($oMedia->getId() / $firstLevel);
        $rep_second_level = (int) (($oMedia->getId() - ($rep_first_level * $firstLevel)) / $secondLevel);

        return sprintf('%s/%04s/%02s/%s', $this->uploadFolder, $rep_first_level + 1, $rep_second_level + 1, $oMedia->getFilename() );
    }

    /**
     * @inheritdoc
     */
    public function postPersist(Media $oMedia)
    {
        if ($oMedia->getBinaryContent() === null) return false;

        return $this->filesystem->write($this->getPath($oMedia), file_get_contents($oMedia->getBinaryContent()->getRealPath()));

    }

    /**
     * @inheritdoc
     */
    public function postUpdate(Media $oMedia)
    {
        if ($oMedia->getOldMedia() instanceof Media) $this->filesystem->delete($this->getPath($oMedia->getOldMedia()));
        return $this->postPersist($oMedia);
    }

    /**
     * @inheritdoc
     */
    public function postLoad(Media $oMedia)
    {
        return true;
    }

    public function postRemove(Media $oMedia)
    {
        return $this->filesystem->delete($this->getPath($oMedia));
    }

    public function addEditForm(FormBuilderInterface $builder)
    {
        $builder->add('binaryContent', FileType::class, array('required' => false));
    }

    public function addCreateForm(FormBuilderInterface $builder)
    {
        $builder->add('binaryContent', FileType::class);
    }

    public function reverseTransform(Media $oMedia)
    {
        if ($oMedia->getBinaryContent() instanceof UploadedFile)
            $fileName = $oMedia->getBinaryContent()->getClientOriginalName();
        elseif ($oMedia->getBinaryContent() instanceof File)
            $fileName = $oMedia->getBinaryContent()->getBasename();

        if (empty($fileName)) throw new \RuntimeException('invalid file');

        $this->extractMetaData($oMedia);
        $oMedia->setName($oMedia->getName() ? : $fileName); //to keep oldname
        $oMedia->addMetadata('filename', $fileName);
        $oMedia->setFilename(sha1($oMedia->getName() . rand(11111, 99999)) . '.' . $oMedia->getBinaryContent()->guessExtension());

    }


}
