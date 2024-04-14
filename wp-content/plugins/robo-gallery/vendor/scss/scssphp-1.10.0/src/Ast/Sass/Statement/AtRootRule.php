<?php

/**
 * SCSSPHP
 *
 * @copyright 2012-2020 Leaf Corcoran
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 * @link http://scssphp.github.io/scssphp
 */

namespace ScssPhpRBE\ScssPhp\Ast\Sass\Statement;

use ScssPhpRBE\ScssPhp\Ast\Sass\Interpolation;
use ScssPhpRBE\ScssPhp\Ast\Sass\Statement;
use ScssPhpRBE\ScssPhp\SourceSpan\FileSpan;
use ScssPhpRBE\ScssPhp\Visitor\StatementVisitor;

/**
 * A `@at-root` rule.
 *
 * This moves it contents "up" the tree through parent nodes.
 *
 * @extends ParentStatement<Statement[]>
 *
 * @internal
 */
final class AtRootRule extends ParentStatement
{
    /**
     * @var Interpolation|null
     * @readonly
     */
    private $query;

    /**
     * @var FileSpan
     * @readonly
     */
    private $span;

    /**
     * @param Statement[] $children
     */
    public function __construct(array $children, FileSpan $span, ?Interpolation $query = null)
    {
        $this->query = $query;
        $this->span = $span;
        parent::__construct($children);
    }

    /**
     * The query specifying which statements this should move its contents through.
     */
    public function getQuery(): ?Interpolation
    {
        return $this->query;
    }

    public function getSpan(): FileSpan
    {
        return $this->span;
    }

    public function accepts(StatementVisitor $visitor)
    {
        return $visitor->visitAtRootRule($this);
    }
}
