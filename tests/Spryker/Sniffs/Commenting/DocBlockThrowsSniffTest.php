<?php

namespace CodeSnifferTest\Spryker\Sniffs\Commenting;

use CodeSnifferTest\TestCase;
use Spryker\Sniffs\Commenting\DocBlockThrowsSniff;

class DocBlockThrowsSniffTest extends TestCase
{
    /**
     * @return void
     */
    public function testDocBlockThrowsSniffer(): void
    {
        $this->assertSnifferFindsFixableErrors(new DocBlockThrowsSniff(), 2);
    }

    /**
     * @return void
     */
    public function testDocBlockThrowsFixer(): void
    {
        $this->assertSnifferCanFixErrors(new DocBlockThrowsSniff(), 2);
    }
}
