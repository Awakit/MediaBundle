<?php

namespace Awakit\MediaBundle\Provider;

use Awakit\MediaBundle\Entity\Media;

/**
 * description 
 * @author Donjohn
 */
class ApplicationProvider extends BaseProvider {
    
    public $allowedTypes=array('x-shockwave-flash');

    public function extractMetaData(Media $oMedia)
    {
        // TODO: Implement extractMetaData() method.
    }


}
