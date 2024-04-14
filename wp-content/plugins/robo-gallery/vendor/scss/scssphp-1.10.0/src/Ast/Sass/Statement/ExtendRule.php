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
 * An `@extend` rule.
 *
 * This gives one selector all the styling of another.
 *
 * @internal
 */
final class ExtendRule implements Statement
{
    /**
     * @var Interpolation
     * @readonly
     */
    private $selector;

    /**
     * @var FileSpan
     * @readonly
     */
    private $span;

    /**
     * @var bool
     * @readonly
     */
    private $optional;

    public function __construct(Interpolation $selector, FileSpan $span, bool $optional = false)
    {
        $this->selector = $selector;
        $this->span = $span;
        $this->optional = $optional;
    }

    public function getSelector(): Interpolation
    {
        return $this->selector;
    }

    /**
     * Whether this is an optional extension.
     *
     * If an extension isn't optional, it will emit an error if it doesn't match
     * any selectors.
     */
    public function isOptional(): bool
    {
        return $this->optional;
    }

    public function getSpan(): FileSpan
    {
        return $this->span;
    }

    public function accepts(StatementVisitor $visitor)
    {
        return $visitor->visitExtendRule($this);
    }
}
