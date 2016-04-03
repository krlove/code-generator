# Code generator

Code generator is a PHP tool that provides an interface for generating code. Currently only PHP class generation is supported.

## Installation
Require the package using composer `composer require krlove/code-generator --dev`. Code generator is usually intended to be installed only in dev environment. Installation in prod environment is not recommended.

## Usage example
```php
<?php

use Krlove\CodeGenerator\Model\ArgumentModel;
use Krlove\CodeGenerator\Model\ClassModel;
use Krlove\CodeGenerator\Model\ConstantModel;
use Krlove\CodeGenerator\Model\ClassNameModel;
use Krlove\CodeGenerator\Model\DocBlockModel;
use Krlove\CodeGenerator\Model\MethodModel;
use Krlove\CodeGenerator\Model\NamespaceModel;
use Krlove\CodeGenerator\Model\PropertyModel;
use Krlove\CodeGenerator\Model\UseTraitModel;
use Krlove\CodeGenerator\Model\UseClassModel;
use Krlove\CodeGenerator\Model\VirtualMethodModel;
use Krlove\CodeGenerator\Model\VirtualPropertyModel;

require 'vendor/autoload.php';

$phpClass = new ClassModel();
$phpClass->setNamespace(new NamespaceModel('NamespaceOfTheClass'));

$name = new ClassNameModel('TestClass', 'BaseTestClass');
$name->addImplements('\\NamespaceOne\\InterfaceOne');
$phpClass->addUses(new UseClassModel('NamespaceTwo'));
$name->addImplements('InterfaceTwo');

$phpClass->setName($name);

$phpClass->addTrait(new UseTraitModel('TraitOne'));
$phpClass->addTrait(new UseTraitModel('TraitTwo'));

$phpClass->addConstant(new ConstantModel('CONST_ONE', 'value'));
$phpClass->addConstant(new ConstantModel('CONST_TWO', 1));

$phpClass->addProperty(new PropertyModel('propertyOne'));
$phpClass->addProperty(new PropertyModel('propertyTwo', 'protected'));
$privateProperty = new PropertyModel('propertyThree', 'private', 'defaultValue');
$privateProperty->setDocBlock(new DocBlockModel('@var string'));
$phpClass->addProperty($privateProperty);

$phpClass->addProperty(new VirtualPropertyModel('virtualPropertyOne', 'int'));
$phpClass->addProperty(new VirtualPropertyModel('virtualPropertyTwo', 'mixed'));

$phpClass->addMethod(new MethodModel('methodOne'));
$phpClass->addMethod(new MethodModel('methodTwo', 'protected'));
$privateMethod = new MethodModel('methodThree', 'private');
$privateMethod->addArgument(new ArgumentModel('arg1'));
$privateMethod->addArgument(new ArgumentModel('arg2', 'array', 'array()'));
$privateMethod->setBody('return \'result\';');
$privateMethod->setDocBlock(new DocBlockModel('@var mixed arg1', '@var array arg2', '@return string'));
$phpClass->addMethod($privateMethod);

$phpClass->addMethod(new VirtualMethodModel('virtualMethodOne'));
$virtualMethodTwo = new VirtualMethodModel('virtualMethodTwo', 'array');
$virtualMethodTwo->addArgument(new ArgumentModel('arg1', 'array'));
$phpClass->addMethod($virtualMethodTwo);

echo $phpClass->render();
```

Output

```php
<?php

namespace NamespaceOfTheClass;

use NamespaceTwo;

/**
 * @property int $virtualPropertyOne
 * @property mixed $virtualPropertyTwo
 * @method void virtualMethodOne()
 * @method array virtualMethodTwo(array $arg1)
 */
class TestClass extends BaseTestClass implements \NamespaceOne\InterfaceOne, InterfaceTwo
{
    use TraitOne;
    use TraitTwo;

    const CONST_ONE = 'value';
    const CONST_TWO = ;

    public $propertyOne;

    protected $propertyTwo;

    /**
     * @var string
     */
    private $propertyThree = 'defaultValue';

    public function methodOne()
    {
    }

    protected function methodTwo()
    {
    }

    /**
     * @var mixed arg1
     * @var array arg2
     * @return string
     */
    private function methodThree($arg1, array $arg2)
    {
        return 'result';
    }
}
```
