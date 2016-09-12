<?php
/**
 * @author jgn
 * @date 04/07/2016
 * @description For ...
 */

namespace Awakit\MediaBundle\Twig\TokenParser;




use Awakit\MediaBundle\Twig\Node\PathNode;

class PathTokenParser extends \Twig_TokenParser
{
    protected $extensionName;

    /**
     * @param string $extensionName
     */
    public function __construct($extensionName)
    {
        $this->extensionName = $extensionName;
    }

    /**
     * {@inheritdoc}
     */
    public function parse(\Twig_Token $token)
    {
        $media = $this->parser->getExpressionParser()->parseExpression();

        $this->parser->getStream()->next();

        $format = $this->parser->getExpressionParser()->parseExpression();

        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);

        return new PathNode($this->extensionName, $media, $format, $token->getLine(), $this->getTag());
    }

    /**
     * {@inheritdoc}
     */
    public function getTag()
    {
        return 'path';
    }
}