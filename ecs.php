<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer;
use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\IsNullFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocToCommentFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitStrictFixer;
use PhpCsFixer\Fixer\Semicolon\MultilineWhitespaceBeforeSemicolonsFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\CodingStandard\Fixer\Spacing\MethodChainingNewlineFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): void {

    $ecsConfig->paths([
        __DIR__ . '/src',
    ]);

    $ecsConfig->sets([SetList::ARRAY]);
    $ecsConfig->sets([SetList::COMMON]);
    $ecsConfig->sets([SetList::CLEAN_CODE]);
    $ecsConfig->sets([SetList::PSR_12]);
    $ecsConfig->sets([SetList::STRICT]);
    $ecsConfig->sets([SetList::SYMPLIFY]);
    $ecsConfig->sets([SetList::NAMESPACES]);
    $ecsConfig->sets([SetList::NAMESPACES]);
    $ecsConfig->sets([SetList::PHPUNIT]);
    $ecsConfig->sets([SetList::DOCBLOCK]);
    $ecsConfig->sets([SetList::CONTROL_STRUCTURES]);
    $ecsConfig->sets([SetList::COMMENTS]);
    $ecsConfig->sets([SetList::CLEAN_CODE]);


    $ecsConfig->rule(BlankLineBeforeStatementFixer::class);
    $ecsConfig->rule(OrderedClassElementsFixer::class);

    $ecsConfig->ruleWithConfiguration(NativeFunctionInvocationFixer::class,
        [
            'include' => ['@all'],
            'strict' => false
        ]
    );
    $ecsConfig->ruleWithConfiguration(ArraySyntaxFixer::class,
        [
            'syntax' => 'short'
        ]
    );
    $ecsConfig->ruleWithConfiguration(BinaryOperatorSpacesFixer::class,
        [
            'default' => 'align'
        ]
    );
    $ecsConfig->ruleWithConfiguration(ConcatSpaceFixer::class,
        [
            'spacing' => 'one'
        ]
    );

    $ecsConfig->rule(NoUnusedImportsFixer::class);
};
